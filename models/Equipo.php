<?php

namespace PHPMaker2023\project11;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for equipo
 */
class Equipo extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $ID_EQUIPO;
    public $NOM_EQUIPO_CORTO;
    public $NOM_EQUIPO_LARGO;
    public $PAIS_EQUIPO;
    public $REGION_EQUIPO;
    public $DETALLE_EQUIPO;
    public $ESCUDO_EQUIPO;
    public $NOM_ESTADIO;
    public $crea_dato;
    public $modifica_dato;
    public $usuario_dato;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("language");
        $this->TableVar = "equipo";
        $this->TableName = 'equipo';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "`equipo`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // ID_EQUIPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->ID_EQUIPO = new DbField(
            $this, // Table
            'x_ID_EQUIPO', // Variable name
            'ID_EQUIPO', // Name
            '`ID_EQUIPO`', // Expression
            '`ID_EQUIPO`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`ID_EQUIPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->ID_EQUIPO->InputTextType = "text";
        $this->ID_EQUIPO->IsAutoIncrement = true; // Autoincrement field
        $this->ID_EQUIPO->IsPrimaryKey = true; // Primary key field
        $this->ID_EQUIPO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID_EQUIPO->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['ID_EQUIPO'] = &$this->ID_EQUIPO;

        // NOM_EQUIPO_CORTO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->NOM_EQUIPO_CORTO = new DbField(
            $this, // Table
            'x_NOM_EQUIPO_CORTO', // Variable name
            'NOM_EQUIPO_CORTO', // Name
            '`NOM_EQUIPO_CORTO`', // Expression
            '`NOM_EQUIPO_CORTO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`NOM_EQUIPO_CORTO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->NOM_EQUIPO_CORTO->InputTextType = "text";
        $this->NOM_EQUIPO_CORTO->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['NOM_EQUIPO_CORTO'] = &$this->NOM_EQUIPO_CORTO;

        // NOM_EQUIPO_LARGO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->NOM_EQUIPO_LARGO = new DbField(
            $this, // Table
            'x_NOM_EQUIPO_LARGO', // Variable name
            'NOM_EQUIPO_LARGO', // Name
            '`NOM_EQUIPO_LARGO`', // Expression
            '`NOM_EQUIPO_LARGO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`NOM_EQUIPO_LARGO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->NOM_EQUIPO_LARGO->InputTextType = "text";
        $this->NOM_EQUIPO_LARGO->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['NOM_EQUIPO_LARGO'] = &$this->NOM_EQUIPO_LARGO;

        // PAIS_EQUIPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->PAIS_EQUIPO = new DbField(
            $this, // Table
            'x_PAIS_EQUIPO', // Variable name
            'PAIS_EQUIPO', // Name
            '`PAIS_EQUIPO`', // Expression
            '`PAIS_EQUIPO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PAIS_EQUIPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->PAIS_EQUIPO->InputTextType = "text";
        $this->PAIS_EQUIPO->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['PAIS_EQUIPO'] = &$this->PAIS_EQUIPO;

        // REGION_EQUIPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->REGION_EQUIPO = new DbField(
            $this, // Table
            'x_REGION_EQUIPO', // Variable name
            'REGION_EQUIPO', // Name
            '`REGION_EQUIPO`', // Expression
            '`REGION_EQUIPO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`REGION_EQUIPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->REGION_EQUIPO->InputTextType = "text";
        $this->REGION_EQUIPO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->REGION_EQUIPO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->REGION_EQUIPO->Lookup = new Lookup('REGION_EQUIPO', 'equipo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->REGION_EQUIPO->Lookup = new Lookup('REGION_EQUIPO', 'equipo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->REGION_EQUIPO->OptionCount = 6;
        $this->REGION_EQUIPO->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['REGION_EQUIPO'] = &$this->REGION_EQUIPO;

        // DETALLE_EQUIPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->DETALLE_EQUIPO = new DbField(
            $this, // Table
            'x_DETALLE_EQUIPO', // Variable name
            'DETALLE_EQUIPO', // Name
            '`DETALLE_EQUIPO`', // Expression
            '`DETALLE_EQUIPO`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`DETALLE_EQUIPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->DETALLE_EQUIPO->InputTextType = "text";
        $this->DETALLE_EQUIPO->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['DETALLE_EQUIPO'] = &$this->DETALLE_EQUIPO;

        // ESCUDO_EQUIPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->ESCUDO_EQUIPO = new DbField(
            $this, // Table
            'x_ESCUDO_EQUIPO', // Variable name
            'ESCUDO_EQUIPO', // Name
            '`ESCUDO_EQUIPO`', // Expression
            '`ESCUDO_EQUIPO`', // Basic search expression
            201, // Type
            1024, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`ESCUDO_EQUIPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'IMAGE', // View Tag
            'FILE' // Edit Tag
        );
        $this->ESCUDO_EQUIPO->InputTextType = "text";
        $this->ESCUDO_EQUIPO->SearchOperators = ["=", "<>", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['ESCUDO_EQUIPO'] = &$this->ESCUDO_EQUIPO;

        // NOM_ESTADIO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->NOM_ESTADIO = new DbField(
            $this, // Table
            'x_NOM_ESTADIO', // Variable name
            'NOM_ESTADIO', // Name
            '`NOM_ESTADIO`', // Expression
            '`NOM_ESTADIO`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`EV__NOM_ESTADIO`', // Virtual expression
            true, // Is virtual
            true, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->NOM_ESTADIO->InputTextType = "text";
        $this->NOM_ESTADIO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NOM_ESTADIO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->NOM_ESTADIO->Lookup = new Lookup('NOM_ESTADIO', 'estadio', false, 'id_estadio', ["nombre_estadio","","",""], '', '', [], [], [], [], [], [], '', '', "`nombre_estadio`");
                break;
            default:
                $this->NOM_ESTADIO->Lookup = new Lookup('NOM_ESTADIO', 'estadio', false, 'id_estadio', ["nombre_estadio","","",""], '', '', [], [], [], [], [], [], '', '', "`nombre_estadio`");
                break;
        }
        $this->NOM_ESTADIO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NOM_ESTADIO->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['NOM_ESTADIO'] = &$this->NOM_ESTADIO;

        // crea_dato $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->crea_dato = new DbField(
            $this, // Table
            'x_crea_dato', // Variable name
            'crea_dato', // Name
            '`crea_dato`', // Expression
            CastDateFieldForLike("`crea_dato`", 15, "DB"), // Basic search expression
            135, // Type
            19, // Size
            15, // Date/Time format
            false, // Is upload field
            '`crea_dato`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'HIDDEN' // Edit Tag
        );
        $this->crea_dato->InputTextType = "text";
        $this->crea_dato->DefaultErrorMessage = str_replace("%s", DateFormat(15), $Language->phrase("IncorrectDate"));
        $this->crea_dato->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['crea_dato'] = &$this->crea_dato;

        // modifica_dato $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->modifica_dato = new DbField(
            $this, // Table
            'x_modifica_dato', // Variable name
            'modifica_dato', // Name
            '`modifica_dato`', // Expression
            CastDateFieldForLike("`modifica_dato`", 15, "DB"), // Basic search expression
            135, // Type
            19, // Size
            15, // Date/Time format
            false, // Is upload field
            '`modifica_dato`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'HIDDEN' // Edit Tag
        );
        $this->modifica_dato->InputTextType = "text";
        $this->modifica_dato->DefaultErrorMessage = str_replace("%s", DateFormat(15), $Language->phrase("IncorrectDate"));
        $this->modifica_dato->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['modifica_dato'] = &$this->modifica_dato;

        // usuario_dato $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->usuario_dato = new DbField(
            $this, // Table
            'x_usuario_dato', // Variable name
            'usuario_dato', // Name
            '`usuario_dato`', // Expression
            '`usuario_dato`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`usuario_dato`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'HIDDEN' // Edit Tag
        );
        $this->usuario_dato->addMethod("getAutoUpdateValue", fn() => CurrentUserName());
        $this->usuario_dato->addMethod("getDefault", fn() => "admin");
        $this->usuario_dato->InputTextType = "text";
        $this->usuario_dato->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['usuario_dato'] = &$this->usuario_dato;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
            $sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortFieldList . " " . $curSort : "";
            $this->setSessionOrderByList($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->useVirtualFields() ? $this->getSessionOrderByList() : $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Session ORDER BY for List page
    public function getSessionOrderByList()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST"));
    }

    public function setSessionOrderByList($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`equipo`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlSelectList() // Select for List page
    {
        if ($this->SqlSelectList) {
            return $this->SqlSelectList;
        }
        $from = "(SELECT *, (SELECT `nombre_estadio` FROM `estadio` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`id_estadio` = `equipo`.`NOM_ESTADIO` LIMIT 1) AS `EV__NOM_ESTADIO` FROM `equipo`)";
        return $from . " `TMP_TABLE`";
    }

    public function sqlSelectList() // For backward compatibility
    {
        return $this->getSqlSelectList();
    }

    public function setSqlSelectList($v)
    {
        $this->SqlSelectList = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        if ($this->useVirtualFields()) {
            $select = "*";
            $from = $this->getSqlSelectList();
            $sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
        } else {
            $select = $this->getSqlSelect();
            $from = $this->getSqlFrom();
            $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        }
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Check if virtual fields is used in SQL
    protected function useVirtualFields()
    {
        $where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
        $orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
        if ($where != "") {
            $where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
        }
        if ($orderBy != "") {
            $orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
        }
        if ($this->BasicSearch->getKeyword() != "") {
            return true;
        }
        if (ContainsString($orderBy, " " . $this->NOM_ESTADIO->VirtualExpression . " ")) {
            return true;
        }
        return false;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        if ($this->useVirtualFields()) {
            $sql = $this->buildSelectSql("*", $this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        } else {
            $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        }
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $success = $this->insertSql($rs)->execute();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($success) {
            // Get insert id if necessary
            $this->ID_EQUIPO->setDbValue($conn->lastInsertId());
            $rs['ID_EQUIPO'] = $this->ID_EQUIPO->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->execute();
            $success = ($success > 0) ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['ID_EQUIPO']) && !EmptyValue($this->ID_EQUIPO->CurrentValue)) {
                $rs['ID_EQUIPO'] = $this->ID_EQUIPO->CurrentValue;
            }
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('ID_EQUIPO', $rs)) {
                AddFilter($where, QuotedName('ID_EQUIPO', $this->Dbid) . '=' . QuotedValue($rs['ID_EQUIPO'], $this->ID_EQUIPO->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->execute();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->ID_EQUIPO->DbValue = $row['ID_EQUIPO'];
        $this->NOM_EQUIPO_CORTO->DbValue = $row['NOM_EQUIPO_CORTO'];
        $this->NOM_EQUIPO_LARGO->DbValue = $row['NOM_EQUIPO_LARGO'];
        $this->PAIS_EQUIPO->DbValue = $row['PAIS_EQUIPO'];
        $this->REGION_EQUIPO->DbValue = $row['REGION_EQUIPO'];
        $this->DETALLE_EQUIPO->DbValue = $row['DETALLE_EQUIPO'];
        $this->ESCUDO_EQUIPO->Upload->DbValue = $row['ESCUDO_EQUIPO'];
        $this->NOM_ESTADIO->DbValue = $row['NOM_ESTADIO'];
        $this->crea_dato->DbValue = $row['crea_dato'];
        $this->modifica_dato->DbValue = $row['modifica_dato'];
        $this->usuario_dato->DbValue = $row['usuario_dato'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['ESCUDO_EQUIPO']) ? [] : [$row['ESCUDO_EQUIPO']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->ESCUDO_EQUIPO->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->ESCUDO_EQUIPO->oldPhysicalUploadPath() . $oldFile);
            }
        }
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`ID_EQUIPO` = @ID_EQUIPO@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID_EQUIPO->CurrentValue : $this->ID_EQUIPO->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->ID_EQUIPO->CurrentValue = $keys[0];
            } else {
                $this->ID_EQUIPO->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID_EQUIPO', $row) ? $row['ID_EQUIPO'] : null;
        } else {
            $val = !EmptyValue($this->ID_EQUIPO->OldValue) && !$current ? $this->ID_EQUIPO->OldValue : $this->ID_EQUIPO->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID_EQUIPO@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("equipolist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "equipoview") {
            return $Language->phrase("View");
        } elseif ($pageName == "equipoedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "equipoadd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "EquipoView";
            case Config("API_ADD_ACTION"):
                return "EquipoAdd";
            case Config("API_EDIT_ACTION"):
                return "EquipoEdit";
            case Config("API_DELETE_ACTION"):
                return "EquipoDelete";
            case Config("API_LIST_ACTION"):
                return "EquipoList";
            default:
                return "";
        }
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "equipolist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("equipoview", $parm);
        } else {
            $url = $this->keyUrl("equipoview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "equipoadd?" . $parm;
        } else {
            $url = "equipoadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("equipoedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("equipolist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("equipoadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("equipolist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("equipodelete");
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"ID_EQUIPO\":" . JsonEncode($this->ID_EQUIPO->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID_EQUIPO->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->ID_EQUIPO->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language, $Page;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;dashboard=true";
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("ID_EQUIPO") ?? Route("ID_EQUIPO")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->ID_EQUIPO->CurrentValue = $key;
            } else {
                $this->ID_EQUIPO->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->ID_EQUIPO->setDbValue($row['ID_EQUIPO']);
        $this->NOM_EQUIPO_CORTO->setDbValue($row['NOM_EQUIPO_CORTO']);
        $this->NOM_EQUIPO_LARGO->setDbValue($row['NOM_EQUIPO_LARGO']);
        $this->PAIS_EQUIPO->setDbValue($row['PAIS_EQUIPO']);
        $this->REGION_EQUIPO->setDbValue($row['REGION_EQUIPO']);
        $this->DETALLE_EQUIPO->setDbValue($row['DETALLE_EQUIPO']);
        $this->ESCUDO_EQUIPO->Upload->DbValue = $row['ESCUDO_EQUIPO'];
        $this->NOM_ESTADIO->setDbValue($row['NOM_ESTADIO']);
        $this->crea_dato->setDbValue($row['crea_dato']);
        $this->modifica_dato->setDbValue($row['modifica_dato']);
        $this->usuario_dato->setDbValue($row['usuario_dato']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "EquipoList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ID_EQUIPO

        // NOM_EQUIPO_CORTO

        // NOM_EQUIPO_LARGO

        // PAIS_EQUIPO

        // REGION_EQUIPO

        // DETALLE_EQUIPO

        // ESCUDO_EQUIPO

        // NOM_ESTADIO

        // crea_dato

        // modifica_dato

        // usuario_dato

        // ID_EQUIPO
        $this->ID_EQUIPO->ViewValue = $this->ID_EQUIPO->CurrentValue;

        // NOM_EQUIPO_CORTO
        $this->NOM_EQUIPO_CORTO->ViewValue = $this->NOM_EQUIPO_CORTO->CurrentValue;

        // NOM_EQUIPO_LARGO
        $this->NOM_EQUIPO_LARGO->ViewValue = $this->NOM_EQUIPO_LARGO->CurrentValue;

        // PAIS_EQUIPO
        $this->PAIS_EQUIPO->ViewValue = $this->PAIS_EQUIPO->CurrentValue;

        // REGION_EQUIPO
        if (strval($this->REGION_EQUIPO->CurrentValue) != "") {
            $this->REGION_EQUIPO->ViewValue = $this->REGION_EQUIPO->optionCaption($this->REGION_EQUIPO->CurrentValue);
        } else {
            $this->REGION_EQUIPO->ViewValue = null;
        }

        // DETALLE_EQUIPO
        $this->DETALLE_EQUIPO->ViewValue = $this->DETALLE_EQUIPO->CurrentValue;

        // ESCUDO_EQUIPO
        if (!EmptyValue($this->ESCUDO_EQUIPO->Upload->DbValue)) {
            $this->ESCUDO_EQUIPO->ImageWidth = 50;
            $this->ESCUDO_EQUIPO->ImageHeight = 0;
            $this->ESCUDO_EQUIPO->ImageAlt = $this->ESCUDO_EQUIPO->alt();
            $this->ESCUDO_EQUIPO->ImageCssClass = "ew-image";
            $this->ESCUDO_EQUIPO->ViewValue = $this->ESCUDO_EQUIPO->Upload->DbValue;
        } else {
            $this->ESCUDO_EQUIPO->ViewValue = "";
        }

        // NOM_ESTADIO
        if ($this->NOM_ESTADIO->VirtualValue != "") {
            $this->NOM_ESTADIO->ViewValue = $this->NOM_ESTADIO->VirtualValue;
        } else {
            $curVal = strval($this->NOM_ESTADIO->CurrentValue);
            if ($curVal != "") {
                $this->NOM_ESTADIO->ViewValue = $this->NOM_ESTADIO->lookupCacheOption($curVal);
                if ($this->NOM_ESTADIO->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id_estadio`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->NOM_ESTADIO->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->NOM_ESTADIO->Lookup->renderViewRow($rswrk[0]);
                        $this->NOM_ESTADIO->ViewValue = $this->NOM_ESTADIO->displayValue($arwrk);
                    } else {
                        $this->NOM_ESTADIO->ViewValue = FormatNumber($this->NOM_ESTADIO->CurrentValue, $this->NOM_ESTADIO->formatPattern());
                    }
                }
            } else {
                $this->NOM_ESTADIO->ViewValue = null;
            }
        }

        // crea_dato
        $this->crea_dato->ViewValue = $this->crea_dato->CurrentValue;
        $this->crea_dato->ViewValue = FormatDateTime($this->crea_dato->ViewValue, $this->crea_dato->formatPattern());
        $this->crea_dato->CssClass = "fst-italic";
        $this->crea_dato->CellCssStyle .= "text-align: right;";

        // modifica_dato
        $this->modifica_dato->ViewValue = $this->modifica_dato->CurrentValue;
        $this->modifica_dato->ViewValue = FormatDateTime($this->modifica_dato->ViewValue, $this->modifica_dato->formatPattern());
        $this->modifica_dato->CssClass = "fst-italic";
        $this->modifica_dato->CellCssStyle .= "text-align: right;";

        // usuario_dato
        $this->usuario_dato->ViewValue = $this->usuario_dato->CurrentValue;

        // ID_EQUIPO
        $this->ID_EQUIPO->HrefValue = "";
        $this->ID_EQUIPO->TooltipValue = "";

        // NOM_EQUIPO_CORTO
        $this->NOM_EQUIPO_CORTO->HrefValue = "";
        $this->NOM_EQUIPO_CORTO->TooltipValue = "";

        // NOM_EQUIPO_LARGO
        $this->NOM_EQUIPO_LARGO->HrefValue = "";
        $this->NOM_EQUIPO_LARGO->TooltipValue = "";

        // PAIS_EQUIPO
        $this->PAIS_EQUIPO->HrefValue = "";
        $this->PAIS_EQUIPO->TooltipValue = "";

        // REGION_EQUIPO
        $this->REGION_EQUIPO->HrefValue = "";
        $this->REGION_EQUIPO->TooltipValue = "";

        // DETALLE_EQUIPO
        $this->DETALLE_EQUIPO->HrefValue = "";
        $this->DETALLE_EQUIPO->TooltipValue = "";

        // ESCUDO_EQUIPO
        if (!EmptyValue($this->ESCUDO_EQUIPO->Upload->DbValue)) {
            $this->ESCUDO_EQUIPO->HrefValue = GetFileUploadUrl($this->ESCUDO_EQUIPO, $this->ESCUDO_EQUIPO->htmlDecode($this->ESCUDO_EQUIPO->Upload->DbValue)); // Add prefix/suffix
            $this->ESCUDO_EQUIPO->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->ESCUDO_EQUIPO->HrefValue = FullUrl($this->ESCUDO_EQUIPO->HrefValue, "href");
            }
        } else {
            $this->ESCUDO_EQUIPO->HrefValue = "";
        }
        $this->ESCUDO_EQUIPO->ExportHrefValue = $this->ESCUDO_EQUIPO->UploadPath . $this->ESCUDO_EQUIPO->Upload->DbValue;
        $this->ESCUDO_EQUIPO->TooltipValue = "";
        if ($this->ESCUDO_EQUIPO->UseColorbox) {
            if (EmptyValue($this->ESCUDO_EQUIPO->TooltipValue)) {
                $this->ESCUDO_EQUIPO->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->ESCUDO_EQUIPO->LinkAttrs["data-rel"] = "equipo_x_ESCUDO_EQUIPO";
            $this->ESCUDO_EQUIPO->LinkAttrs->appendClass("ew-lightbox");
        }

        // NOM_ESTADIO
        $this->NOM_ESTADIO->HrefValue = "";
        $this->NOM_ESTADIO->TooltipValue = "";

        // crea_dato
        $this->crea_dato->HrefValue = "";
        $this->crea_dato->TooltipValue = "";

        // modifica_dato
        $this->modifica_dato->HrefValue = "";
        $this->modifica_dato->TooltipValue = "";

        // usuario_dato
        $this->usuario_dato->HrefValue = "";
        $this->usuario_dato->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // ID_EQUIPO
        $this->ID_EQUIPO->setupEditAttributes();
        $this->ID_EQUIPO->EditValue = $this->ID_EQUIPO->CurrentValue;

        // NOM_EQUIPO_CORTO
        $this->NOM_EQUIPO_CORTO->setupEditAttributes();
        $this->NOM_EQUIPO_CORTO->EditValue = $this->NOM_EQUIPO_CORTO->CurrentValue;
        $this->NOM_EQUIPO_CORTO->PlaceHolder = RemoveHtml($this->NOM_EQUIPO_CORTO->caption());

        // NOM_EQUIPO_LARGO
        $this->NOM_EQUIPO_LARGO->setupEditAttributes();
        $this->NOM_EQUIPO_LARGO->EditValue = $this->NOM_EQUIPO_LARGO->CurrentValue;
        $this->NOM_EQUIPO_LARGO->PlaceHolder = RemoveHtml($this->NOM_EQUIPO_LARGO->caption());

        // PAIS_EQUIPO
        $this->PAIS_EQUIPO->setupEditAttributes();
        $this->PAIS_EQUIPO->EditValue = $this->PAIS_EQUIPO->CurrentValue;
        $this->PAIS_EQUIPO->PlaceHolder = RemoveHtml($this->PAIS_EQUIPO->caption());

        // REGION_EQUIPO
        $this->REGION_EQUIPO->setupEditAttributes();
        $this->REGION_EQUIPO->EditValue = $this->REGION_EQUIPO->options(true);
        $this->REGION_EQUIPO->PlaceHolder = RemoveHtml($this->REGION_EQUIPO->caption());

        // DETALLE_EQUIPO
        $this->DETALLE_EQUIPO->setupEditAttributes();
        $this->DETALLE_EQUIPO->EditValue = $this->DETALLE_EQUIPO->CurrentValue;
        $this->DETALLE_EQUIPO->PlaceHolder = RemoveHtml($this->DETALLE_EQUIPO->caption());

        // ESCUDO_EQUIPO
        $this->ESCUDO_EQUIPO->setupEditAttributes();
        if (!EmptyValue($this->ESCUDO_EQUIPO->Upload->DbValue)) {
            $this->ESCUDO_EQUIPO->ImageWidth = 50;
            $this->ESCUDO_EQUIPO->ImageHeight = 0;
            $this->ESCUDO_EQUIPO->ImageAlt = $this->ESCUDO_EQUIPO->alt();
            $this->ESCUDO_EQUIPO->ImageCssClass = "ew-image";
            $this->ESCUDO_EQUIPO->EditValue = $this->ESCUDO_EQUIPO->Upload->DbValue;
        } else {
            $this->ESCUDO_EQUIPO->EditValue = "";
        }
        if (!EmptyValue($this->ESCUDO_EQUIPO->CurrentValue)) {
            $this->ESCUDO_EQUIPO->Upload->FileName = $this->ESCUDO_EQUIPO->CurrentValue;
        }

        // NOM_ESTADIO
        $this->NOM_ESTADIO->setupEditAttributes();
        $this->NOM_ESTADIO->PlaceHolder = RemoveHtml($this->NOM_ESTADIO->caption());

        // crea_dato
        $this->crea_dato->setupEditAttributes();
        $this->crea_dato->CurrentValue = FormatDateTime($this->crea_dato->CurrentValue, $this->crea_dato->formatPattern());

        // modifica_dato
        $this->modifica_dato->setupEditAttributes();
        $this->modifica_dato->CurrentValue = FormatDateTime($this->modifica_dato->CurrentValue, $this->modifica_dato->formatPattern());

        // usuario_dato

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->ID_EQUIPO);
                    $doc->exportCaption($this->NOM_EQUIPO_CORTO);
                    $doc->exportCaption($this->NOM_EQUIPO_LARGO);
                    $doc->exportCaption($this->PAIS_EQUIPO);
                    $doc->exportCaption($this->REGION_EQUIPO);
                    $doc->exportCaption($this->DETALLE_EQUIPO);
                    $doc->exportCaption($this->ESCUDO_EQUIPO);
                    $doc->exportCaption($this->NOM_ESTADIO);
                    $doc->exportCaption($this->crea_dato);
                    $doc->exportCaption($this->modifica_dato);
                    $doc->exportCaption($this->usuario_dato);
                } else {
                    $doc->exportCaption($this->ID_EQUIPO);
                    $doc->exportCaption($this->NOM_EQUIPO_CORTO);
                    $doc->exportCaption($this->NOM_EQUIPO_LARGO);
                    $doc->exportCaption($this->PAIS_EQUIPO);
                    $doc->exportCaption($this->REGION_EQUIPO);
                    $doc->exportCaption($this->DETALLE_EQUIPO);
                    $doc->exportCaption($this->ESCUDO_EQUIPO);
                    $doc->exportCaption($this->NOM_ESTADIO);
                    $doc->exportCaption($this->crea_dato);
                    $doc->exportCaption($this->modifica_dato);
                    $doc->exportCaption($this->usuario_dato);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->ID_EQUIPO);
                        $doc->exportField($this->NOM_EQUIPO_CORTO);
                        $doc->exportField($this->NOM_EQUIPO_LARGO);
                        $doc->exportField($this->PAIS_EQUIPO);
                        $doc->exportField($this->REGION_EQUIPO);
                        $doc->exportField($this->DETALLE_EQUIPO);
                        $doc->exportField($this->ESCUDO_EQUIPO);
                        $doc->exportField($this->NOM_ESTADIO);
                        $doc->exportField($this->crea_dato);
                        $doc->exportField($this->modifica_dato);
                        $doc->exportField($this->usuario_dato);
                    } else {
                        $doc->exportField($this->ID_EQUIPO);
                        $doc->exportField($this->NOM_EQUIPO_CORTO);
                        $doc->exportField($this->NOM_EQUIPO_LARGO);
                        $doc->exportField($this->PAIS_EQUIPO);
                        $doc->exportField($this->REGION_EQUIPO);
                        $doc->exportField($this->DETALLE_EQUIPO);
                        $doc->exportField($this->ESCUDO_EQUIPO);
                        $doc->exportField($this->NOM_ESTADIO);
                        $doc->exportField($this->crea_dato);
                        $doc->exportField($this->modifica_dato);
                        $doc->exportField($this->usuario_dato);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'ESCUDO_EQUIPO') {
            $fldName = "ESCUDO_EQUIPO";
            $fileNameFld = "ESCUDO_EQUIPO";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->ID_EQUIPO->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                                        $ext = strtolower($pathinfo["extension"] ?? "");
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    if ($fld->hasMethod("getUploadPath")) { // Check field level upload path
                        $fld->UploadPath = $fld->getUploadPath();
                    }
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
