<?php

namespace PHPMaker2023\project11;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for equipotorneo
 */
class Equipotorneo extends DbTable
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
    public $ID_EQUIPO_TORNEO;
    public $ID_TORNEO;
    public $ID_EQUIPO;
    public $PARTIDOS_JUGADOS;
    public $PARTIDOS_GANADOS;
    public $PARTIDOS_EMPATADOS;
    public $PARTIDOS_PERDIDOS;
    public $GF;
    public $GC;
    public $GD;
    public $GRUPO;
    public $POSICION_EQUIPO_TORENO;
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
        $this->TableVar = "equipotorneo";
        $this->TableName = 'equipotorneo';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "`equipotorneo`";
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

        // ID_EQUIPO_TORNEO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->ID_EQUIPO_TORNEO = new DbField(
            $this, // Table
            'x_ID_EQUIPO_TORNEO', // Variable name
            'ID_EQUIPO_TORNEO', // Name
            '`ID_EQUIPO_TORNEO`', // Expression
            '`ID_EQUIPO_TORNEO`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`ID_EQUIPO_TORNEO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->ID_EQUIPO_TORNEO->InputTextType = "text";
        $this->ID_EQUIPO_TORNEO->IsAutoIncrement = true; // Autoincrement field
        $this->ID_EQUIPO_TORNEO->IsPrimaryKey = true; // Primary key field
        $this->ID_EQUIPO_TORNEO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID_EQUIPO_TORNEO->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['ID_EQUIPO_TORNEO'] = &$this->ID_EQUIPO_TORNEO;

        // ID_TORNEO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->ID_TORNEO = new DbField(
            $this, // Table
            'x_ID_TORNEO', // Variable name
            'ID_TORNEO', // Name
            '`ID_TORNEO`', // Expression
            '`ID_TORNEO`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`ID_TORNEO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->ID_TORNEO->InputTextType = "text";
        $this->ID_TORNEO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ID_TORNEO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->ID_TORNEO->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->ID_TORNEO->Lookup = new Lookup('ID_TORNEO', 'torneo', true, 'ID_TORNEO', ["NOM_TORNEO_CORTO","","",""], '', '', [], [], [], [], [], [], '', '', "`NOM_TORNEO_CORTO`");
                break;
            default:
                $this->ID_TORNEO->Lookup = new Lookup('ID_TORNEO', 'torneo', true, 'ID_TORNEO', ["NOM_TORNEO_CORTO","","",""], '', '', [], [], [], [], [], [], '', '', "`NOM_TORNEO_CORTO`");
                break;
        }
        $this->ID_TORNEO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID_TORNEO->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['ID_TORNEO'] = &$this->ID_TORNEO;

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
            '`EV__ID_EQUIPO`', // Virtual expression
            true, // Is virtual
            true, // Force selection
            true, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->ID_EQUIPO->InputTextType = "text";
        $this->ID_EQUIPO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ID_EQUIPO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->ID_EQUIPO->Lookup = new Lookup('ID_EQUIPO', 'equipo', false, 'ID_EQUIPO', ["NOM_EQUIPO_LARGO","","",""], '', '', [], [], [], [], [], [], '', '', "`NOM_EQUIPO_LARGO`");
                break;
            default:
                $this->ID_EQUIPO->Lookup = new Lookup('ID_EQUIPO', 'equipo', false, 'ID_EQUIPO', ["NOM_EQUIPO_LARGO","","",""], '', '', [], [], [], [], [], [], '', '', "`NOM_EQUIPO_LARGO`");
                break;
        }
        $this->ID_EQUIPO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID_EQUIPO->SearchOperators = ["=", "<>", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['ID_EQUIPO'] = &$this->ID_EQUIPO;

        // PARTIDOS_JUGADOS $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->PARTIDOS_JUGADOS = new DbField(
            $this, // Table
            'x_PARTIDOS_JUGADOS', // Variable name
            'PARTIDOS_JUGADOS', // Name
            '`PARTIDOS_JUGADOS`', // Expression
            '`PARTIDOS_JUGADOS`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PARTIDOS_JUGADOS`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->PARTIDOS_JUGADOS->addMethod("getDefault", fn() => 0);
        $this->PARTIDOS_JUGADOS->InputTextType = "text";
        $this->PARTIDOS_JUGADOS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PARTIDOS_JUGADOS->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['PARTIDOS_JUGADOS'] = &$this->PARTIDOS_JUGADOS;

        // PARTIDOS_GANADOS $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->PARTIDOS_GANADOS = new DbField(
            $this, // Table
            'x_PARTIDOS_GANADOS', // Variable name
            'PARTIDOS_GANADOS', // Name
            '`PARTIDOS_GANADOS`', // Expression
            '`PARTIDOS_GANADOS`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PARTIDOS_GANADOS`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->PARTIDOS_GANADOS->addMethod("getDefault", fn() => 0);
        $this->PARTIDOS_GANADOS->InputTextType = "text";
        $this->PARTIDOS_GANADOS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PARTIDOS_GANADOS->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['PARTIDOS_GANADOS'] = &$this->PARTIDOS_GANADOS;

        // PARTIDOS_EMPATADOS $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->PARTIDOS_EMPATADOS = new DbField(
            $this, // Table
            'x_PARTIDOS_EMPATADOS', // Variable name
            'PARTIDOS_EMPATADOS', // Name
            '`PARTIDOS_EMPATADOS`', // Expression
            '`PARTIDOS_EMPATADOS`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PARTIDOS_EMPATADOS`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->PARTIDOS_EMPATADOS->addMethod("getDefault", fn() => 0);
        $this->PARTIDOS_EMPATADOS->InputTextType = "text";
        $this->PARTIDOS_EMPATADOS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PARTIDOS_EMPATADOS->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['PARTIDOS_EMPATADOS'] = &$this->PARTIDOS_EMPATADOS;

        // PARTIDOS_PERDIDOS $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->PARTIDOS_PERDIDOS = new DbField(
            $this, // Table
            'x_PARTIDOS_PERDIDOS', // Variable name
            'PARTIDOS_PERDIDOS', // Name
            '`PARTIDOS_PERDIDOS`', // Expression
            '`PARTIDOS_PERDIDOS`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`PARTIDOS_PERDIDOS`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->PARTIDOS_PERDIDOS->addMethod("getDefault", fn() => 0);
        $this->PARTIDOS_PERDIDOS->InputTextType = "text";
        $this->PARTIDOS_PERDIDOS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PARTIDOS_PERDIDOS->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['PARTIDOS_PERDIDOS'] = &$this->PARTIDOS_PERDIDOS;

        // GF $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->GF = new DbField(
            $this, // Table
            'x_GF', // Variable name
            'GF', // Name
            '`GF`', // Expression
            '`GF`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`GF`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->GF->addMethod("getDefault", fn() => 0);
        $this->GF->InputTextType = "text";
        $this->GF->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GF->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['GF'] = &$this->GF;

        // GC $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->GC = new DbField(
            $this, // Table
            'x_GC', // Variable name
            'GC', // Name
            '`GC`', // Expression
            '`GC`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`GC`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->GC->addMethod("getDefault", fn() => 0);
        $this->GC->InputTextType = "text";
        $this->GC->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GC->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['GC'] = &$this->GC;

        // GD $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->GD = new DbField(
            $this, // Table
            'x_GD', // Variable name
            'GD', // Name
            '`GD`', // Expression
            '`GD`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`GD`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->GD->addMethod("getDefault", fn() => 0);
        $this->GD->InputTextType = "text";
        $this->GD->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GD->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['GD'] = &$this->GD;

        // GRUPO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->GRUPO = new DbField(
            $this, // Table
            'x_GRUPO', // Variable name
            'GRUPO', // Name
            '`GRUPO`', // Expression
            '`GRUPO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`GRUPO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->GRUPO->InputTextType = "text";
        $this->GRUPO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->GRUPO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->GRUPO->Lookup = new Lookup('GRUPO', 'equipotorneo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->GRUPO->Lookup = new Lookup('GRUPO', 'equipotorneo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->GRUPO->OptionCount = 8;
        $this->GRUPO->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['GRUPO'] = &$this->GRUPO;

        // POSICION_EQUIPO_TORENO $tbl, $fldvar, $fldname, $fldexp, $fldbsexp, $fldtype, $fldsize, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual, $forceselect, $fldvirtualsrch, $fldviewtag = "", $fldhtmltag
        $this->POSICION_EQUIPO_TORENO = new DbField(
            $this, // Table
            'x_POSICION_EQUIPO_TORENO', // Variable name
            'POSICION_EQUIPO_TORENO', // Name
            '`POSICION_EQUIPO_TORENO`', // Expression
            '`POSICION_EQUIPO_TORENO`', // Basic search expression
            201, // Type
            256, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`POSICION_EQUIPO_TORENO`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->POSICION_EQUIPO_TORENO->InputTextType = "text";
        $this->POSICION_EQUIPO_TORENO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->POSICION_EQUIPO_TORENO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->POSICION_EQUIPO_TORENO->Lookup = new Lookup('POSICION_EQUIPO_TORENO', 'equipotorneo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->POSICION_EQUIPO_TORENO->Lookup = new Lookup('POSICION_EQUIPO_TORENO', 'equipotorneo', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->POSICION_EQUIPO_TORENO->OptionCount = 5;
        $this->POSICION_EQUIPO_TORENO->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['POSICION_EQUIPO_TORENO'] = &$this->POSICION_EQUIPO_TORENO;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`equipotorneo`";
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
        $from = "(SELECT *, (SELECT `NOM_EQUIPO_LARGO` FROM `equipo` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`ID_EQUIPO` = `equipotorneo`.`ID_EQUIPO` LIMIT 1) AS `EV__ID_EQUIPO` FROM `equipotorneo`)";
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
        if (
            $this->ID_EQUIPO->AdvancedSearch->SearchValue != "" ||
            $this->ID_EQUIPO->AdvancedSearch->SearchValue2 != "" ||
            ContainsString($where, " " . $this->ID_EQUIPO->VirtualExpression . " ")
        ) {
            return true;
        }
        if (ContainsString($orderBy, " " . $this->ID_EQUIPO->VirtualExpression . " ")) {
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
            $this->ID_EQUIPO_TORNEO->setDbValue($conn->lastInsertId());
            $rs['ID_EQUIPO_TORNEO'] = $this->ID_EQUIPO_TORNEO->DbValue;
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
            if (!isset($rs['ID_EQUIPO_TORNEO']) && !EmptyValue($this->ID_EQUIPO_TORNEO->CurrentValue)) {
                $rs['ID_EQUIPO_TORNEO'] = $this->ID_EQUIPO_TORNEO->CurrentValue;
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
            if (array_key_exists('ID_EQUIPO_TORNEO', $rs)) {
                AddFilter($where, QuotedName('ID_EQUIPO_TORNEO', $this->Dbid) . '=' . QuotedValue($rs['ID_EQUIPO_TORNEO'], $this->ID_EQUIPO_TORNEO->DataType, $this->Dbid));
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
        $this->ID_EQUIPO_TORNEO->DbValue = $row['ID_EQUIPO_TORNEO'];
        $this->ID_TORNEO->DbValue = $row['ID_TORNEO'];
        $this->ID_EQUIPO->DbValue = $row['ID_EQUIPO'];
        $this->PARTIDOS_JUGADOS->DbValue = $row['PARTIDOS_JUGADOS'];
        $this->PARTIDOS_GANADOS->DbValue = $row['PARTIDOS_GANADOS'];
        $this->PARTIDOS_EMPATADOS->DbValue = $row['PARTIDOS_EMPATADOS'];
        $this->PARTIDOS_PERDIDOS->DbValue = $row['PARTIDOS_PERDIDOS'];
        $this->GF->DbValue = $row['GF'];
        $this->GC->DbValue = $row['GC'];
        $this->GD->DbValue = $row['GD'];
        $this->GRUPO->DbValue = $row['GRUPO'];
        $this->POSICION_EQUIPO_TORENO->DbValue = $row['POSICION_EQUIPO_TORENO'];
        $this->crea_dato->DbValue = $row['crea_dato'];
        $this->modifica_dato->DbValue = $row['modifica_dato'];
        $this->usuario_dato->DbValue = $row['usuario_dato'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`ID_EQUIPO_TORNEO` = @ID_EQUIPO_TORNEO@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID_EQUIPO_TORNEO->CurrentValue : $this->ID_EQUIPO_TORNEO->OldValue;
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
                $this->ID_EQUIPO_TORNEO->CurrentValue = $keys[0];
            } else {
                $this->ID_EQUIPO_TORNEO->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID_EQUIPO_TORNEO', $row) ? $row['ID_EQUIPO_TORNEO'] : null;
        } else {
            $val = !EmptyValue($this->ID_EQUIPO_TORNEO->OldValue) && !$current ? $this->ID_EQUIPO_TORNEO->OldValue : $this->ID_EQUIPO_TORNEO->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID_EQUIPO_TORNEO@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("equipotorneolist");
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
        if ($pageName == "equipotorneoview") {
            return $Language->phrase("View");
        } elseif ($pageName == "equipotorneoedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "equipotorneoadd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "EquipotorneoView";
            case Config("API_ADD_ACTION"):
                return "EquipotorneoAdd";
            case Config("API_EDIT_ACTION"):
                return "EquipotorneoEdit";
            case Config("API_DELETE_ACTION"):
                return "EquipotorneoDelete";
            case Config("API_LIST_ACTION"):
                return "EquipotorneoList";
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
        return "equipotorneolist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("equipotorneoview", $parm);
        } else {
            $url = $this->keyUrl("equipotorneoview", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "equipotorneoadd?" . $parm;
        } else {
            $url = "equipotorneoadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("equipotorneoedit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("equipotorneolist", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("equipotorneoadd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("equipotorneolist", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("equipotorneodelete");
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
        $json .= "\"ID_EQUIPO_TORNEO\":" . JsonEncode($this->ID_EQUIPO_TORNEO->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID_EQUIPO_TORNEO->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->ID_EQUIPO_TORNEO->CurrentValue);
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
            if (($keyValue = Param("ID_EQUIPO_TORNEO") ?? Route("ID_EQUIPO_TORNEO")) !== null) {
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
                $this->ID_EQUIPO_TORNEO->CurrentValue = $key;
            } else {
                $this->ID_EQUIPO_TORNEO->OldValue = $key;
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
        $this->ID_EQUIPO_TORNEO->setDbValue($row['ID_EQUIPO_TORNEO']);
        $this->ID_TORNEO->setDbValue($row['ID_TORNEO']);
        $this->ID_EQUIPO->setDbValue($row['ID_EQUIPO']);
        $this->PARTIDOS_JUGADOS->setDbValue($row['PARTIDOS_JUGADOS']);
        $this->PARTIDOS_GANADOS->setDbValue($row['PARTIDOS_GANADOS']);
        $this->PARTIDOS_EMPATADOS->setDbValue($row['PARTIDOS_EMPATADOS']);
        $this->PARTIDOS_PERDIDOS->setDbValue($row['PARTIDOS_PERDIDOS']);
        $this->GF->setDbValue($row['GF']);
        $this->GC->setDbValue($row['GC']);
        $this->GD->setDbValue($row['GD']);
        $this->GRUPO->setDbValue($row['GRUPO']);
        $this->POSICION_EQUIPO_TORENO->setDbValue($row['POSICION_EQUIPO_TORENO']);
        $this->crea_dato->setDbValue($row['crea_dato']);
        $this->modifica_dato->setDbValue($row['modifica_dato']);
        $this->usuario_dato->setDbValue($row['usuario_dato']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "EquipotorneoList";
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

        // ID_EQUIPO_TORNEO

        // ID_TORNEO

        // ID_EQUIPO

        // PARTIDOS_JUGADOS

        // PARTIDOS_GANADOS

        // PARTIDOS_EMPATADOS

        // PARTIDOS_PERDIDOS

        // GF

        // GC

        // GD

        // GRUPO

        // POSICION_EQUIPO_TORENO

        // crea_dato

        // modifica_dato

        // usuario_dato

        // ID_EQUIPO_TORNEO
        $this->ID_EQUIPO_TORNEO->ViewValue = $this->ID_EQUIPO_TORNEO->CurrentValue;

        // ID_TORNEO
        $curVal = strval($this->ID_TORNEO->CurrentValue);
        if ($curVal != "") {
            $this->ID_TORNEO->ViewValue = $this->ID_TORNEO->lookupCacheOption($curVal);
            if ($this->ID_TORNEO->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter("`ID_TORNEO`", "=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->ID_TORNEO->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->ID_TORNEO->Lookup->renderViewRow($rswrk[0]);
                    $this->ID_TORNEO->ViewValue = $this->ID_TORNEO->displayValue($arwrk);
                } else {
                    $this->ID_TORNEO->ViewValue = FormatNumber($this->ID_TORNEO->CurrentValue, $this->ID_TORNEO->formatPattern());
                }
            }
        } else {
            $this->ID_TORNEO->ViewValue = null;
        }

        // ID_EQUIPO
        if ($this->ID_EQUIPO->VirtualValue != "") {
            $this->ID_EQUIPO->ViewValue = $this->ID_EQUIPO->VirtualValue;
        } else {
            $curVal = strval($this->ID_EQUIPO->CurrentValue);
            if ($curVal != "") {
                $this->ID_EQUIPO->ViewValue = $this->ID_EQUIPO->lookupCacheOption($curVal);
                if ($this->ID_EQUIPO->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`ID_EQUIPO`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->ID_EQUIPO->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ID_EQUIPO->Lookup->renderViewRow($rswrk[0]);
                        $this->ID_EQUIPO->ViewValue = $this->ID_EQUIPO->displayValue($arwrk);
                    } else {
                        $this->ID_EQUIPO->ViewValue = FormatNumber($this->ID_EQUIPO->CurrentValue, $this->ID_EQUIPO->formatPattern());
                    }
                }
            } else {
                $this->ID_EQUIPO->ViewValue = null;
            }
        }

        // PARTIDOS_JUGADOS
        $this->PARTIDOS_JUGADOS->ViewValue = $this->PARTIDOS_JUGADOS->CurrentValue;
        $this->PARTIDOS_JUGADOS->ViewValue = FormatNumber($this->PARTIDOS_JUGADOS->ViewValue, $this->PARTIDOS_JUGADOS->formatPattern());

        // PARTIDOS_GANADOS
        $this->PARTIDOS_GANADOS->ViewValue = $this->PARTIDOS_GANADOS->CurrentValue;
        $this->PARTIDOS_GANADOS->ViewValue = FormatNumber($this->PARTIDOS_GANADOS->ViewValue, $this->PARTIDOS_GANADOS->formatPattern());

        // PARTIDOS_EMPATADOS
        $this->PARTIDOS_EMPATADOS->ViewValue = $this->PARTIDOS_EMPATADOS->CurrentValue;
        $this->PARTIDOS_EMPATADOS->ViewValue = FormatNumber($this->PARTIDOS_EMPATADOS->ViewValue, $this->PARTIDOS_EMPATADOS->formatPattern());

        // PARTIDOS_PERDIDOS
        $this->PARTIDOS_PERDIDOS->ViewValue = $this->PARTIDOS_PERDIDOS->CurrentValue;
        $this->PARTIDOS_PERDIDOS->ViewValue = FormatNumber($this->PARTIDOS_PERDIDOS->ViewValue, $this->PARTIDOS_PERDIDOS->formatPattern());

        // GF
        $this->GF->ViewValue = $this->GF->CurrentValue;
        $this->GF->ViewValue = FormatNumber($this->GF->ViewValue, $this->GF->formatPattern());

        // GC
        $this->GC->ViewValue = $this->GC->CurrentValue;
        $this->GC->ViewValue = FormatNumber($this->GC->ViewValue, $this->GC->formatPattern());

        // GD
        $this->GD->ViewValue = $this->GD->CurrentValue;
        $this->GD->ViewValue = FormatNumber($this->GD->ViewValue, $this->GD->formatPattern());

        // GRUPO
        if (strval($this->GRUPO->CurrentValue) != "") {
            $this->GRUPO->ViewValue = $this->GRUPO->optionCaption($this->GRUPO->CurrentValue);
        } else {
            $this->GRUPO->ViewValue = null;
        }

        // POSICION_EQUIPO_TORENO
        if (strval($this->POSICION_EQUIPO_TORENO->CurrentValue) != "") {
            $this->POSICION_EQUIPO_TORENO->ViewValue = $this->POSICION_EQUIPO_TORENO->optionCaption($this->POSICION_EQUIPO_TORENO->CurrentValue);
        } else {
            $this->POSICION_EQUIPO_TORENO->ViewValue = null;
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

        // ID_EQUIPO_TORNEO
        $this->ID_EQUIPO_TORNEO->HrefValue = "";
        $this->ID_EQUIPO_TORNEO->TooltipValue = "";

        // ID_TORNEO
        $this->ID_TORNEO->HrefValue = "";
        $this->ID_TORNEO->TooltipValue = "";

        // ID_EQUIPO
        $this->ID_EQUIPO->HrefValue = "";
        $this->ID_EQUIPO->TooltipValue = "";

        // PARTIDOS_JUGADOS
        $this->PARTIDOS_JUGADOS->HrefValue = "";
        $this->PARTIDOS_JUGADOS->TooltipValue = "";

        // PARTIDOS_GANADOS
        $this->PARTIDOS_GANADOS->HrefValue = "";
        $this->PARTIDOS_GANADOS->TooltipValue = "";

        // PARTIDOS_EMPATADOS
        $this->PARTIDOS_EMPATADOS->HrefValue = "";
        $this->PARTIDOS_EMPATADOS->TooltipValue = "";

        // PARTIDOS_PERDIDOS
        $this->PARTIDOS_PERDIDOS->HrefValue = "";
        $this->PARTIDOS_PERDIDOS->TooltipValue = "";

        // GF
        $this->GF->HrefValue = "";
        $this->GF->TooltipValue = "";

        // GC
        $this->GC->HrefValue = "";
        $this->GC->TooltipValue = "";

        // GD
        $this->GD->HrefValue = "";
        $this->GD->TooltipValue = "";

        // GRUPO
        $this->GRUPO->HrefValue = "";
        $this->GRUPO->TooltipValue = "";

        // POSICION_EQUIPO_TORENO
        $this->POSICION_EQUIPO_TORENO->HrefValue = "";
        $this->POSICION_EQUIPO_TORENO->TooltipValue = "";

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

        // ID_EQUIPO_TORNEO
        $this->ID_EQUIPO_TORNEO->setupEditAttributes();
        $this->ID_EQUIPO_TORNEO->EditValue = $this->ID_EQUIPO_TORNEO->CurrentValue;

        // ID_TORNEO
        $this->ID_TORNEO->setupEditAttributes();
        $curVal = trim(strval($this->ID_TORNEO->CurrentValue));
        if ($curVal != "") {
            $this->ID_TORNEO->ViewValue = $this->ID_TORNEO->lookupCacheOption($curVal);
        } else {
            $this->ID_TORNEO->ViewValue = $this->ID_TORNEO->Lookup !== null && is_array($this->ID_TORNEO->lookupOptions()) ? $curVal : null;
        }
        if ($this->ID_TORNEO->ViewValue !== null) { // Load from cache
            $this->ID_TORNEO->EditValue = array_values($this->ID_TORNEO->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $sqlWrk = $this->ID_TORNEO->Lookup->getSql(true, $filterWrk, '', $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->ID_TORNEO->EditValue = $arwrk;
        }
        $this->ID_TORNEO->PlaceHolder = RemoveHtml($this->ID_TORNEO->caption());

        // ID_EQUIPO
        $this->ID_EQUIPO->setupEditAttributes();
        $this->ID_EQUIPO->PlaceHolder = RemoveHtml($this->ID_EQUIPO->caption());

        // PARTIDOS_JUGADOS
        $this->PARTIDOS_JUGADOS->setupEditAttributes();
        $this->PARTIDOS_JUGADOS->EditValue = $this->PARTIDOS_JUGADOS->CurrentValue;
        $this->PARTIDOS_JUGADOS->PlaceHolder = RemoveHtml($this->PARTIDOS_JUGADOS->caption());
        if (strval($this->PARTIDOS_JUGADOS->EditValue) != "" && is_numeric($this->PARTIDOS_JUGADOS->EditValue)) {
            $this->PARTIDOS_JUGADOS->EditValue = FormatNumber($this->PARTIDOS_JUGADOS->EditValue, null);
        }

        // PARTIDOS_GANADOS
        $this->PARTIDOS_GANADOS->setupEditAttributes();
        $this->PARTIDOS_GANADOS->EditValue = $this->PARTIDOS_GANADOS->CurrentValue;
        $this->PARTIDOS_GANADOS->PlaceHolder = RemoveHtml($this->PARTIDOS_GANADOS->caption());
        if (strval($this->PARTIDOS_GANADOS->EditValue) != "" && is_numeric($this->PARTIDOS_GANADOS->EditValue)) {
            $this->PARTIDOS_GANADOS->EditValue = FormatNumber($this->PARTIDOS_GANADOS->EditValue, null);
        }

        // PARTIDOS_EMPATADOS
        $this->PARTIDOS_EMPATADOS->setupEditAttributes();
        $this->PARTIDOS_EMPATADOS->EditValue = $this->PARTIDOS_EMPATADOS->CurrentValue;
        $this->PARTIDOS_EMPATADOS->PlaceHolder = RemoveHtml($this->PARTIDOS_EMPATADOS->caption());
        if (strval($this->PARTIDOS_EMPATADOS->EditValue) != "" && is_numeric($this->PARTIDOS_EMPATADOS->EditValue)) {
            $this->PARTIDOS_EMPATADOS->EditValue = FormatNumber($this->PARTIDOS_EMPATADOS->EditValue, null);
        }

        // PARTIDOS_PERDIDOS
        $this->PARTIDOS_PERDIDOS->setupEditAttributes();
        $this->PARTIDOS_PERDIDOS->EditValue = $this->PARTIDOS_PERDIDOS->CurrentValue;
        $this->PARTIDOS_PERDIDOS->PlaceHolder = RemoveHtml($this->PARTIDOS_PERDIDOS->caption());
        if (strval($this->PARTIDOS_PERDIDOS->EditValue) != "" && is_numeric($this->PARTIDOS_PERDIDOS->EditValue)) {
            $this->PARTIDOS_PERDIDOS->EditValue = FormatNumber($this->PARTIDOS_PERDIDOS->EditValue, null);
        }

        // GF
        $this->GF->setupEditAttributes();
        $this->GF->EditValue = $this->GF->CurrentValue;
        $this->GF->PlaceHolder = RemoveHtml($this->GF->caption());
        if (strval($this->GF->EditValue) != "" && is_numeric($this->GF->EditValue)) {
            $this->GF->EditValue = FormatNumber($this->GF->EditValue, null);
        }

        // GC
        $this->GC->setupEditAttributes();
        $this->GC->EditValue = $this->GC->CurrentValue;
        $this->GC->PlaceHolder = RemoveHtml($this->GC->caption());
        if (strval($this->GC->EditValue) != "" && is_numeric($this->GC->EditValue)) {
            $this->GC->EditValue = FormatNumber($this->GC->EditValue, null);
        }

        // GD
        $this->GD->setupEditAttributes();
        $this->GD->EditValue = $this->GD->CurrentValue;
        $this->GD->PlaceHolder = RemoveHtml($this->GD->caption());
        if (strval($this->GD->EditValue) != "" && is_numeric($this->GD->EditValue)) {
            $this->GD->EditValue = FormatNumber($this->GD->EditValue, null);
        }

        // GRUPO
        $this->GRUPO->setupEditAttributes();
        $this->GRUPO->EditValue = $this->GRUPO->options(true);
        $this->GRUPO->PlaceHolder = RemoveHtml($this->GRUPO->caption());

        // POSICION_EQUIPO_TORENO
        $this->POSICION_EQUIPO_TORENO->setupEditAttributes();
        $this->POSICION_EQUIPO_TORENO->EditValue = $this->POSICION_EQUIPO_TORENO->options(true);
        $this->POSICION_EQUIPO_TORENO->PlaceHolder = RemoveHtml($this->POSICION_EQUIPO_TORENO->caption());

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
                    $doc->exportCaption($this->ID_EQUIPO_TORNEO);
                    $doc->exportCaption($this->ID_TORNEO);
                    $doc->exportCaption($this->ID_EQUIPO);
                    $doc->exportCaption($this->PARTIDOS_JUGADOS);
                    $doc->exportCaption($this->PARTIDOS_GANADOS);
                    $doc->exportCaption($this->PARTIDOS_EMPATADOS);
                    $doc->exportCaption($this->PARTIDOS_PERDIDOS);
                    $doc->exportCaption($this->GF);
                    $doc->exportCaption($this->GC);
                    $doc->exportCaption($this->GD);
                    $doc->exportCaption($this->GRUPO);
                    $doc->exportCaption($this->POSICION_EQUIPO_TORENO);
                    $doc->exportCaption($this->crea_dato);
                    $doc->exportCaption($this->modifica_dato);
                    $doc->exportCaption($this->usuario_dato);
                } else {
                    $doc->exportCaption($this->ID_EQUIPO_TORNEO);
                    $doc->exportCaption($this->ID_TORNEO);
                    $doc->exportCaption($this->ID_EQUIPO);
                    $doc->exportCaption($this->PARTIDOS_JUGADOS);
                    $doc->exportCaption($this->PARTIDOS_GANADOS);
                    $doc->exportCaption($this->PARTIDOS_EMPATADOS);
                    $doc->exportCaption($this->PARTIDOS_PERDIDOS);
                    $doc->exportCaption($this->GF);
                    $doc->exportCaption($this->GC);
                    $doc->exportCaption($this->GD);
                    $doc->exportCaption($this->crea_dato);
                    $doc->exportCaption($this->modifica_dato);
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
                        $doc->exportField($this->ID_EQUIPO_TORNEO);
                        $doc->exportField($this->ID_TORNEO);
                        $doc->exportField($this->ID_EQUIPO);
                        $doc->exportField($this->PARTIDOS_JUGADOS);
                        $doc->exportField($this->PARTIDOS_GANADOS);
                        $doc->exportField($this->PARTIDOS_EMPATADOS);
                        $doc->exportField($this->PARTIDOS_PERDIDOS);
                        $doc->exportField($this->GF);
                        $doc->exportField($this->GC);
                        $doc->exportField($this->GD);
                        $doc->exportField($this->GRUPO);
                        $doc->exportField($this->POSICION_EQUIPO_TORENO);
                        $doc->exportField($this->crea_dato);
                        $doc->exportField($this->modifica_dato);
                        $doc->exportField($this->usuario_dato);
                    } else {
                        $doc->exportField($this->ID_EQUIPO_TORNEO);
                        $doc->exportField($this->ID_TORNEO);
                        $doc->exportField($this->ID_EQUIPO);
                        $doc->exportField($this->PARTIDOS_JUGADOS);
                        $doc->exportField($this->PARTIDOS_GANADOS);
                        $doc->exportField($this->PARTIDOS_EMPATADOS);
                        $doc->exportField($this->PARTIDOS_PERDIDOS);
                        $doc->exportField($this->GF);
                        $doc->exportField($this->GC);
                        $doc->exportField($this->GD);
                        $doc->exportField($this->crea_dato);
                        $doc->exportField($this->modifica_dato);
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

        // No binary fields
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
