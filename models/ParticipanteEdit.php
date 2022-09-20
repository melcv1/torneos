<?php

namespace PHPMaker2023\project11;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ParticipanteEdit extends Participante
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ParticipanteEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "participanteedit";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'participante';
        $this->TableName = 'participante';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (participante)
        if (!isset($GLOBALS["participante"]) || get_class($GLOBALS["participante"]) == PROJECT_NAMESPACE . "participante") {
            $GLOBALS["participante"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'participante');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "participanteview";
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['ID_PARTICIPANTE'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->ID_PARTICIPANTE->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->ID_PARTICIPANTE->setVisibility();
        $this->NOMBRE->setVisibility();
        $this->APELLIDO->setVisibility();
        $this->FECHA_NACIMIENTO->setVisibility();
        $this->CEDULA->setVisibility();
        $this->_EMAIL->setVisibility();
        $this->TELEFONO->setVisibility();
        $this->crea_dato->setVisibility();
        $this->modifica_dato->setVisibility();
        $this->usuario_dato->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("ID_PARTICIPANTE") ?? Key(0) ?? Route(2)) !== null) {
                $this->ID_PARTICIPANTE->setQueryStringValue($keyValue);
                $this->ID_PARTICIPANTE->setOldValue($this->ID_PARTICIPANTE->QueryStringValue);
            } elseif (Post("ID_PARTICIPANTE") !== null) {
                $this->ID_PARTICIPANTE->setFormValue(Post("ID_PARTICIPANTE"));
                $this->ID_PARTICIPANTE->setOldValue($this->ID_PARTICIPANTE->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("ID_PARTICIPANTE") ?? Route("ID_PARTICIPANTE")) !== null) {
                    $this->ID_PARTICIPANTE->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->ID_PARTICIPANTE->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("participantelist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "participantelist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Do not return Json for UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return; 
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'ID_PARTICIPANTE' first before field var 'x_ID_PARTICIPANTE'
        $val = $CurrentForm->hasValue("ID_PARTICIPANTE") ? $CurrentForm->getValue("ID_PARTICIPANTE") : $CurrentForm->getValue("x_ID_PARTICIPANTE");
        if (!$this->ID_PARTICIPANTE->IsDetailKey) {
            $this->ID_PARTICIPANTE->setFormValue($val);
        }

        // Check field name 'NOMBRE' first before field var 'x_NOMBRE'
        $val = $CurrentForm->hasValue("NOMBRE") ? $CurrentForm->getValue("NOMBRE") : $CurrentForm->getValue("x_NOMBRE");
        if (!$this->NOMBRE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NOMBRE->Visible = false; // Disable update for API request
            } else {
                $this->NOMBRE->setFormValue($val);
            }
        }

        // Check field name 'APELLIDO' first before field var 'x_APELLIDO'
        $val = $CurrentForm->hasValue("APELLIDO") ? $CurrentForm->getValue("APELLIDO") : $CurrentForm->getValue("x_APELLIDO");
        if (!$this->APELLIDO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->APELLIDO->Visible = false; // Disable update for API request
            } else {
                $this->APELLIDO->setFormValue($val);
            }
        }

        // Check field name 'FECHA_NACIMIENTO' first before field var 'x_FECHA_NACIMIENTO'
        $val = $CurrentForm->hasValue("FECHA_NACIMIENTO") ? $CurrentForm->getValue("FECHA_NACIMIENTO") : $CurrentForm->getValue("x_FECHA_NACIMIENTO");
        if (!$this->FECHA_NACIMIENTO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FECHA_NACIMIENTO->Visible = false; // Disable update for API request
            } else {
                $this->FECHA_NACIMIENTO->setFormValue($val);
            }
        }

        // Check field name 'CEDULA' first before field var 'x_CEDULA'
        $val = $CurrentForm->hasValue("CEDULA") ? $CurrentForm->getValue("CEDULA") : $CurrentForm->getValue("x_CEDULA");
        if (!$this->CEDULA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CEDULA->Visible = false; // Disable update for API request
            } else {
                $this->CEDULA->setFormValue($val);
            }
        }

        // Check field name 'EMAIL' first before field var 'x__EMAIL'
        $val = $CurrentForm->hasValue("EMAIL") ? $CurrentForm->getValue("EMAIL") : $CurrentForm->getValue("x__EMAIL");
        if (!$this->_EMAIL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_EMAIL->Visible = false; // Disable update for API request
            } else {
                $this->_EMAIL->setFormValue($val);
            }
        }

        // Check field name 'TELEFONO' first before field var 'x_TELEFONO'
        $val = $CurrentForm->hasValue("TELEFONO") ? $CurrentForm->getValue("TELEFONO") : $CurrentForm->getValue("x_TELEFONO");
        if (!$this->TELEFONO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TELEFONO->Visible = false; // Disable update for API request
            } else {
                $this->TELEFONO->setFormValue($val);
            }
        }

        // Check field name 'crea_dato' first before field var 'x_crea_dato'
        $val = $CurrentForm->hasValue("crea_dato") ? $CurrentForm->getValue("crea_dato") : $CurrentForm->getValue("x_crea_dato");
        if (!$this->crea_dato->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->crea_dato->Visible = false; // Disable update for API request
            } else {
                $this->crea_dato->setFormValue($val);
            }
            $this->crea_dato->CurrentValue = UnFormatDateTime($this->crea_dato->CurrentValue, $this->crea_dato->formatPattern());
        }

        // Check field name 'modifica_dato' first before field var 'x_modifica_dato'
        $val = $CurrentForm->hasValue("modifica_dato") ? $CurrentForm->getValue("modifica_dato") : $CurrentForm->getValue("x_modifica_dato");
        if (!$this->modifica_dato->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->modifica_dato->Visible = false; // Disable update for API request
            } else {
                $this->modifica_dato->setFormValue($val);
            }
            $this->modifica_dato->CurrentValue = UnFormatDateTime($this->modifica_dato->CurrentValue, $this->modifica_dato->formatPattern());
        }

        // Check field name 'usuario_dato' first before field var 'x_usuario_dato'
        $val = $CurrentForm->hasValue("usuario_dato") ? $CurrentForm->getValue("usuario_dato") : $CurrentForm->getValue("x_usuario_dato");
        if (!$this->usuario_dato->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->usuario_dato->Visible = false; // Disable update for API request
            } else {
                $this->usuario_dato->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ID_PARTICIPANTE->CurrentValue = $this->ID_PARTICIPANTE->FormValue;
        $this->NOMBRE->CurrentValue = $this->NOMBRE->FormValue;
        $this->APELLIDO->CurrentValue = $this->APELLIDO->FormValue;
        $this->FECHA_NACIMIENTO->CurrentValue = $this->FECHA_NACIMIENTO->FormValue;
        $this->CEDULA->CurrentValue = $this->CEDULA->FormValue;
        $this->_EMAIL->CurrentValue = $this->_EMAIL->FormValue;
        $this->TELEFONO->CurrentValue = $this->TELEFONO->FormValue;
        $this->crea_dato->CurrentValue = $this->crea_dato->FormValue;
        $this->crea_dato->CurrentValue = UnFormatDateTime($this->crea_dato->CurrentValue, $this->crea_dato->formatPattern());
        $this->modifica_dato->CurrentValue = $this->modifica_dato->FormValue;
        $this->modifica_dato->CurrentValue = UnFormatDateTime($this->modifica_dato->CurrentValue, $this->modifica_dato->formatPattern());
        $this->usuario_dato->CurrentValue = $this->usuario_dato->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->ID_PARTICIPANTE->setDbValue($row['ID_PARTICIPANTE']);
        $this->NOMBRE->setDbValue($row['NOMBRE']);
        $this->APELLIDO->setDbValue($row['APELLIDO']);
        $this->FECHA_NACIMIENTO->setDbValue($row['FECHA_NACIMIENTO']);
        $this->CEDULA->setDbValue($row['CEDULA']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->TELEFONO->setDbValue($row['TELEFONO']);
        $this->crea_dato->setDbValue($row['crea_dato']);
        $this->modifica_dato->setDbValue($row['modifica_dato']);
        $this->usuario_dato->setDbValue($row['usuario_dato']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ID_PARTICIPANTE'] = $this->ID_PARTICIPANTE->DefaultValue;
        $row['NOMBRE'] = $this->NOMBRE->DefaultValue;
        $row['APELLIDO'] = $this->APELLIDO->DefaultValue;
        $row['FECHA_NACIMIENTO'] = $this->FECHA_NACIMIENTO->DefaultValue;
        $row['CEDULA'] = $this->CEDULA->DefaultValue;
        $row['EMAIL'] = $this->_EMAIL->DefaultValue;
        $row['TELEFONO'] = $this->TELEFONO->DefaultValue;
        $row['crea_dato'] = $this->crea_dato->DefaultValue;
        $row['modifica_dato'] = $this->modifica_dato->DefaultValue;
        $row['usuario_dato'] = $this->usuario_dato->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ID_PARTICIPANTE
        $this->ID_PARTICIPANTE->RowCssClass = "row";

        // NOMBRE
        $this->NOMBRE->RowCssClass = "row";

        // APELLIDO
        $this->APELLIDO->RowCssClass = "row";

        // FECHA_NACIMIENTO
        $this->FECHA_NACIMIENTO->RowCssClass = "row";

        // CEDULA
        $this->CEDULA->RowCssClass = "row";

        // EMAIL
        $this->_EMAIL->RowCssClass = "row";

        // TELEFONO
        $this->TELEFONO->RowCssClass = "row";

        // crea_dato
        $this->crea_dato->RowCssClass = "row";

        // modifica_dato
        $this->modifica_dato->RowCssClass = "row";

        // usuario_dato
        $this->usuario_dato->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // ID_PARTICIPANTE
            $this->ID_PARTICIPANTE->ViewValue = $this->ID_PARTICIPANTE->CurrentValue;

            // NOMBRE
            $this->NOMBRE->ViewValue = $this->NOMBRE->CurrentValue;

            // APELLIDO
            $this->APELLIDO->ViewValue = $this->APELLIDO->CurrentValue;

            // FECHA_NACIMIENTO
            $this->FECHA_NACIMIENTO->ViewValue = $this->FECHA_NACIMIENTO->CurrentValue;

            // CEDULA
            $this->CEDULA->ViewValue = $this->CEDULA->CurrentValue;

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;

            // TELEFONO
            $this->TELEFONO->ViewValue = $this->TELEFONO->CurrentValue;

            // crea_dato
            $this->crea_dato->ViewValue = $this->crea_dato->CurrentValue;
            $this->crea_dato->ViewValue = FormatDateTime($this->crea_dato->ViewValue, $this->crea_dato->formatPattern());
            $this->crea_dato->CellCssStyle .= "text-align: right;";

            // modifica_dato
            $this->modifica_dato->ViewValue = $this->modifica_dato->CurrentValue;
            $this->modifica_dato->ViewValue = FormatDateTime($this->modifica_dato->ViewValue, $this->modifica_dato->formatPattern());
            $this->modifica_dato->CssClass = "fst-italic";
            $this->modifica_dato->CellCssStyle .= "text-align: right;";

            // usuario_dato
            $this->usuario_dato->ViewValue = $this->usuario_dato->CurrentValue;

            // ID_PARTICIPANTE
            $this->ID_PARTICIPANTE->HrefValue = "";

            // NOMBRE
            $this->NOMBRE->HrefValue = "";

            // APELLIDO
            $this->APELLIDO->HrefValue = "";

            // FECHA_NACIMIENTO
            $this->FECHA_NACIMIENTO->HrefValue = "";

            // CEDULA
            $this->CEDULA->HrefValue = "";

            // EMAIL
            $this->_EMAIL->HrefValue = "";

            // TELEFONO
            $this->TELEFONO->HrefValue = "";

            // crea_dato
            $this->crea_dato->HrefValue = "";
            $this->crea_dato->TooltipValue = "";

            // modifica_dato
            $this->modifica_dato->HrefValue = "";
            $this->modifica_dato->TooltipValue = "";

            // usuario_dato
            $this->usuario_dato->HrefValue = "";
            $this->usuario_dato->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // ID_PARTICIPANTE
            $this->ID_PARTICIPANTE->setupEditAttributes();
            $this->ID_PARTICIPANTE->EditValue = $this->ID_PARTICIPANTE->CurrentValue;

            // NOMBRE
            $this->NOMBRE->setupEditAttributes();
            $this->NOMBRE->EditValue = HtmlEncode($this->NOMBRE->CurrentValue);
            $this->NOMBRE->PlaceHolder = RemoveHtml($this->NOMBRE->caption());

            // APELLIDO
            $this->APELLIDO->setupEditAttributes();
            $this->APELLIDO->EditValue = HtmlEncode($this->APELLIDO->CurrentValue);
            $this->APELLIDO->PlaceHolder = RemoveHtml($this->APELLIDO->caption());

            // FECHA_NACIMIENTO
            $this->FECHA_NACIMIENTO->setupEditAttributes();
            $this->FECHA_NACIMIENTO->EditValue = HtmlEncode($this->FECHA_NACIMIENTO->CurrentValue);
            $this->FECHA_NACIMIENTO->PlaceHolder = RemoveHtml($this->FECHA_NACIMIENTO->caption());

            // CEDULA
            $this->CEDULA->setupEditAttributes();
            if (!$this->CEDULA->Raw) {
                $this->CEDULA->CurrentValue = HtmlDecode($this->CEDULA->CurrentValue);
            }
            $this->CEDULA->EditValue = HtmlEncode($this->CEDULA->CurrentValue);
            $this->CEDULA->PlaceHolder = RemoveHtml($this->CEDULA->caption());

            // EMAIL
            $this->_EMAIL->setupEditAttributes();
            $this->_EMAIL->EditValue = HtmlEncode($this->_EMAIL->CurrentValue);
            $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

            // TELEFONO
            $this->TELEFONO->setupEditAttributes();
            if (!$this->TELEFONO->Raw) {
                $this->TELEFONO->CurrentValue = HtmlDecode($this->TELEFONO->CurrentValue);
            }
            $this->TELEFONO->EditValue = HtmlEncode($this->TELEFONO->CurrentValue);
            $this->TELEFONO->PlaceHolder = RemoveHtml($this->TELEFONO->caption());

            // crea_dato
            $this->crea_dato->setupEditAttributes();
            $this->crea_dato->EditValue = $this->crea_dato->CurrentValue;
            $this->crea_dato->EditValue = FormatDateTime($this->crea_dato->EditValue, $this->crea_dato->formatPattern());
            $this->crea_dato->CellCssStyle .= "text-align: right;";

            // modifica_dato
            $this->modifica_dato->setupEditAttributes();
            $this->modifica_dato->EditValue = $this->modifica_dato->CurrentValue;
            $this->modifica_dato->EditValue = FormatDateTime($this->modifica_dato->EditValue, $this->modifica_dato->formatPattern());
            $this->modifica_dato->CssClass = "fst-italic";
            $this->modifica_dato->CellCssStyle .= "text-align: right;";

            // usuario_dato

            // Edit refer script

            // ID_PARTICIPANTE
            $this->ID_PARTICIPANTE->HrefValue = "";

            // NOMBRE
            $this->NOMBRE->HrefValue = "";

            // APELLIDO
            $this->APELLIDO->HrefValue = "";

            // FECHA_NACIMIENTO
            $this->FECHA_NACIMIENTO->HrefValue = "";

            // CEDULA
            $this->CEDULA->HrefValue = "";

            // EMAIL
            $this->_EMAIL->HrefValue = "";

            // TELEFONO
            $this->TELEFONO->HrefValue = "";

            // crea_dato
            $this->crea_dato->HrefValue = "";
            $this->crea_dato->TooltipValue = "";

            // modifica_dato
            $this->modifica_dato->HrefValue = "";
            $this->modifica_dato->TooltipValue = "";

            // usuario_dato
            $this->usuario_dato->HrefValue = "";
            $this->usuario_dato->TooltipValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->ID_PARTICIPANTE->Required) {
            if (!$this->ID_PARTICIPANTE->IsDetailKey && EmptyValue($this->ID_PARTICIPANTE->FormValue)) {
                $this->ID_PARTICIPANTE->addErrorMessage(str_replace("%s", $this->ID_PARTICIPANTE->caption(), $this->ID_PARTICIPANTE->RequiredErrorMessage));
            }
        }
        if ($this->NOMBRE->Required) {
            if (!$this->NOMBRE->IsDetailKey && EmptyValue($this->NOMBRE->FormValue)) {
                $this->NOMBRE->addErrorMessage(str_replace("%s", $this->NOMBRE->caption(), $this->NOMBRE->RequiredErrorMessage));
            }
        }
        if ($this->APELLIDO->Required) {
            if (!$this->APELLIDO->IsDetailKey && EmptyValue($this->APELLIDO->FormValue)) {
                $this->APELLIDO->addErrorMessage(str_replace("%s", $this->APELLIDO->caption(), $this->APELLIDO->RequiredErrorMessage));
            }
        }
        if ($this->FECHA_NACIMIENTO->Required) {
            if (!$this->FECHA_NACIMIENTO->IsDetailKey && EmptyValue($this->FECHA_NACIMIENTO->FormValue)) {
                $this->FECHA_NACIMIENTO->addErrorMessage(str_replace("%s", $this->FECHA_NACIMIENTO->caption(), $this->FECHA_NACIMIENTO->RequiredErrorMessage));
            }
        }
        if ($this->CEDULA->Required) {
            if (!$this->CEDULA->IsDetailKey && EmptyValue($this->CEDULA->FormValue)) {
                $this->CEDULA->addErrorMessage(str_replace("%s", $this->CEDULA->caption(), $this->CEDULA->RequiredErrorMessage));
            }
        }
        if ($this->_EMAIL->Required) {
            if (!$this->_EMAIL->IsDetailKey && EmptyValue($this->_EMAIL->FormValue)) {
                $this->_EMAIL->addErrorMessage(str_replace("%s", $this->_EMAIL->caption(), $this->_EMAIL->RequiredErrorMessage));
            }
        }
        if ($this->TELEFONO->Required) {
            if (!$this->TELEFONO->IsDetailKey && EmptyValue($this->TELEFONO->FormValue)) {
                $this->TELEFONO->addErrorMessage(str_replace("%s", $this->TELEFONO->caption(), $this->TELEFONO->RequiredErrorMessage));
            }
        }
        if ($this->crea_dato->Required) {
            if (!$this->crea_dato->IsDetailKey && EmptyValue($this->crea_dato->FormValue)) {
                $this->crea_dato->addErrorMessage(str_replace("%s", $this->crea_dato->caption(), $this->crea_dato->RequiredErrorMessage));
            }
        }
        if ($this->modifica_dato->Required) {
            if (!$this->modifica_dato->IsDetailKey && EmptyValue($this->modifica_dato->FormValue)) {
                $this->modifica_dato->addErrorMessage(str_replace("%s", $this->modifica_dato->caption(), $this->modifica_dato->RequiredErrorMessage));
            }
        }
        if ($this->usuario_dato->Required) {
            if (!$this->usuario_dato->IsDetailKey && EmptyValue($this->usuario_dato->FormValue)) {
                $this->usuario_dato->addErrorMessage(str_replace("%s", $this->usuario_dato->caption(), $this->usuario_dato->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // NOMBRE
        $this->NOMBRE->setDbValueDef($rsnew, $this->NOMBRE->CurrentValue, null, $this->NOMBRE->ReadOnly);

        // APELLIDO
        $this->APELLIDO->setDbValueDef($rsnew, $this->APELLIDO->CurrentValue, null, $this->APELLIDO->ReadOnly);

        // FECHA_NACIMIENTO
        $this->FECHA_NACIMIENTO->setDbValueDef($rsnew, $this->FECHA_NACIMIENTO->CurrentValue, null, $this->FECHA_NACIMIENTO->ReadOnly);

        // CEDULA
        $this->CEDULA->setDbValueDef($rsnew, $this->CEDULA->CurrentValue, null, $this->CEDULA->ReadOnly);

        // EMAIL
        $this->_EMAIL->setDbValueDef($rsnew, $this->_EMAIL->CurrentValue, null, $this->_EMAIL->ReadOnly);

        // TELEFONO
        $this->TELEFONO->setDbValueDef($rsnew, $this->TELEFONO->CurrentValue, null, $this->TELEFONO->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("participantelist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function PageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
