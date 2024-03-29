<?php

namespace PHPMaker2023\project11;

// Page object
$EquipoList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipo: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["ID_EQUIPO", [fields.ID_EQUIPO.visible && fields.ID_EQUIPO.required ? ew.Validators.required(fields.ID_EQUIPO.caption) : null], fields.ID_EQUIPO.isInvalid],
            ["NOM_EQUIPO_CORTO", [fields.NOM_EQUIPO_CORTO.visible && fields.NOM_EQUIPO_CORTO.required ? ew.Validators.required(fields.NOM_EQUIPO_CORTO.caption) : null], fields.NOM_EQUIPO_CORTO.isInvalid],
            ["NOM_EQUIPO_LARGO", [fields.NOM_EQUIPO_LARGO.visible && fields.NOM_EQUIPO_LARGO.required ? ew.Validators.required(fields.NOM_EQUIPO_LARGO.caption) : null], fields.NOM_EQUIPO_LARGO.isInvalid],
            ["PAIS_EQUIPO", [fields.PAIS_EQUIPO.visible && fields.PAIS_EQUIPO.required ? ew.Validators.required(fields.PAIS_EQUIPO.caption) : null], fields.PAIS_EQUIPO.isInvalid],
            ["REGION_EQUIPO", [fields.REGION_EQUIPO.visible && fields.REGION_EQUIPO.required ? ew.Validators.required(fields.REGION_EQUIPO.caption) : null], fields.REGION_EQUIPO.isInvalid],
            ["DETALLE_EQUIPO", [fields.DETALLE_EQUIPO.visible && fields.DETALLE_EQUIPO.required ? ew.Validators.required(fields.DETALLE_EQUIPO.caption) : null], fields.DETALLE_EQUIPO.isInvalid],
            ["ESCUDO_EQUIPO", [fields.ESCUDO_EQUIPO.visible && fields.ESCUDO_EQUIPO.required ? ew.Validators.fileRequired(fields.ESCUDO_EQUIPO.caption) : null], fields.ESCUDO_EQUIPO.isInvalid],
            ["NOM_ESTADIO", [fields.NOM_ESTADIO.visible && fields.NOM_ESTADIO.required ? ew.Validators.required(fields.NOM_ESTADIO.caption) : null], fields.NOM_ESTADIO.isInvalid],
            ["crea_dato", [fields.crea_dato.visible && fields.crea_dato.required ? ew.Validators.required(fields.crea_dato.caption) : null], fields.crea_dato.isInvalid],
            ["modifica_dato", [fields.modifica_dato.visible && fields.modifica_dato.required ? ew.Validators.required(fields.modifica_dato.caption) : null], fields.modifica_dato.isInvalid],
            ["usuario_dato", [fields.usuario_dato.visible && fields.usuario_dato.required ? ew.Validators.required(fields.usuario_dato.caption) : null], fields.usuario_dato.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "REGION_EQUIPO": <?= $Page->REGION_EQUIPO->toClientList($Page) ?>,
            "NOM_ESTADIO": <?= $Page->NOM_ESTADIO->toClientList($Page) ?>,
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<form name="fequiposrch" id="fequiposrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fequiposrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipo: currentTable } });
var currentForm;
var fequiposrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fequiposrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="equipo">
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fequiposrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fequiposrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fequiposrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fequiposrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="equipo">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_equipo" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_equipolist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->ID_EQUIPO->Visible) { // ID_EQUIPO ?>
        <th data-name="ID_EQUIPO" class="<?= $Page->ID_EQUIPO->headerCellClass() ?>"><div id="elh_equipo_ID_EQUIPO" class="equipo_ID_EQUIPO"><?= $Page->renderFieldHeader($Page->ID_EQUIPO) ?></div></th>
<?php } ?>
<?php if ($Page->NOM_EQUIPO_CORTO->Visible) { // NOM_EQUIPO_CORTO ?>
        <th data-name="NOM_EQUIPO_CORTO" class="<?= $Page->NOM_EQUIPO_CORTO->headerCellClass() ?>"><div id="elh_equipo_NOM_EQUIPO_CORTO" class="equipo_NOM_EQUIPO_CORTO"><?= $Page->renderFieldHeader($Page->NOM_EQUIPO_CORTO) ?></div></th>
<?php } ?>
<?php if ($Page->NOM_EQUIPO_LARGO->Visible) { // NOM_EQUIPO_LARGO ?>
        <th data-name="NOM_EQUIPO_LARGO" class="<?= $Page->NOM_EQUIPO_LARGO->headerCellClass() ?>"><div id="elh_equipo_NOM_EQUIPO_LARGO" class="equipo_NOM_EQUIPO_LARGO"><?= $Page->renderFieldHeader($Page->NOM_EQUIPO_LARGO) ?></div></th>
<?php } ?>
<?php if ($Page->PAIS_EQUIPO->Visible) { // PAIS_EQUIPO ?>
        <th data-name="PAIS_EQUIPO" class="<?= $Page->PAIS_EQUIPO->headerCellClass() ?>"><div id="elh_equipo_PAIS_EQUIPO" class="equipo_PAIS_EQUIPO"><?= $Page->renderFieldHeader($Page->PAIS_EQUIPO) ?></div></th>
<?php } ?>
<?php if ($Page->REGION_EQUIPO->Visible) { // REGION_EQUIPO ?>
        <th data-name="REGION_EQUIPO" class="<?= $Page->REGION_EQUIPO->headerCellClass() ?>"><div id="elh_equipo_REGION_EQUIPO" class="equipo_REGION_EQUIPO"><?= $Page->renderFieldHeader($Page->REGION_EQUIPO) ?></div></th>
<?php } ?>
<?php if ($Page->DETALLE_EQUIPO->Visible) { // DETALLE_EQUIPO ?>
        <th data-name="DETALLE_EQUIPO" class="<?= $Page->DETALLE_EQUIPO->headerCellClass() ?>"><div id="elh_equipo_DETALLE_EQUIPO" class="equipo_DETALLE_EQUIPO"><?= $Page->renderFieldHeader($Page->DETALLE_EQUIPO) ?></div></th>
<?php } ?>
<?php if ($Page->ESCUDO_EQUIPO->Visible) { // ESCUDO_EQUIPO ?>
        <th data-name="ESCUDO_EQUIPO" class="<?= $Page->ESCUDO_EQUIPO->headerCellClass() ?>"><div id="elh_equipo_ESCUDO_EQUIPO" class="equipo_ESCUDO_EQUIPO"><?= $Page->renderFieldHeader($Page->ESCUDO_EQUIPO) ?></div></th>
<?php } ?>
<?php if ($Page->NOM_ESTADIO->Visible) { // NOM_ESTADIO ?>
        <th data-name="NOM_ESTADIO" class="<?= $Page->NOM_ESTADIO->headerCellClass() ?>"><div id="elh_equipo_NOM_ESTADIO" class="equipo_NOM_ESTADIO"><?= $Page->renderFieldHeader($Page->NOM_ESTADIO) ?></div></th>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <th data-name="crea_dato" class="<?= $Page->crea_dato->headerCellClass() ?>"><div id="elh_equipo_crea_dato" class="equipo_crea_dato"><?= $Page->renderFieldHeader($Page->crea_dato) ?></div></th>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <th data-name="modifica_dato" class="<?= $Page->modifica_dato->headerCellClass() ?>"><div id="elh_equipo_modifica_dato" class="equipo_modifica_dato"><?= $Page->renderFieldHeader($Page->modifica_dato) ?></div></th>
<?php } ?>
<?php if ($Page->usuario_dato->Visible) { // usuario_dato ?>
        <th data-name="usuario_dato" class="<?= $Page->usuario_dato->headerCellClass() ?>"><div id="elh_equipo_usuario_dato" class="equipo_usuario_dato"><?= $Page->renderFieldHeader($Page->usuario_dato) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->ID_EQUIPO->Visible) { // ID_EQUIPO ?>
        <td data-name="ID_EQUIPO"<?= $Page->ID_EQUIPO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_ID_EQUIPO" class="el_equipo_ID_EQUIPO">
<span<?= $Page->ID_EQUIPO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID_EQUIPO->getDisplayValue($Page->ID_EQUIPO->EditValue))) ?>"></span>
<input type="hidden" data-table="equipo" data-field="x_ID_EQUIPO" data-hidden="1" name="x<?= $Page->RowIndex ?>_ID_EQUIPO" id="x<?= $Page->RowIndex ?>_ID_EQUIPO" value="<?= HtmlEncode($Page->ID_EQUIPO->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_ID_EQUIPO" class="el_equipo_ID_EQUIPO">
<span<?= $Page->ID_EQUIPO->viewAttributes() ?>>
<?= $Page->ID_EQUIPO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="equipo" data-field="x_ID_EQUIPO" data-hidden="1" name="x<?= $Page->RowIndex ?>_ID_EQUIPO" id="x<?= $Page->RowIndex ?>_ID_EQUIPO" value="<?= HtmlEncode($Page->ID_EQUIPO->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->NOM_EQUIPO_CORTO->Visible) { // NOM_EQUIPO_CORTO ?>
        <td data-name="NOM_EQUIPO_CORTO"<?= $Page->NOM_EQUIPO_CORTO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_EQUIPO_CORTO" class="el_equipo_NOM_EQUIPO_CORTO">
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_CORTO" name="x<?= $Page->RowIndex ?>_NOM_EQUIPO_CORTO" id="x<?= $Page->RowIndex ?>_NOM_EQUIPO_CORTO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_CORTO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_CORTO->editAttributes() ?>><?= $Page->NOM_EQUIPO_CORTO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->NOM_EQUIPO_CORTO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_EQUIPO_CORTO" class="el_equipo_NOM_EQUIPO_CORTO">
<span<?= $Page->NOM_EQUIPO_CORTO->viewAttributes() ?>>
<?= $Page->NOM_EQUIPO_CORTO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->NOM_EQUIPO_LARGO->Visible) { // NOM_EQUIPO_LARGO ?>
        <td data-name="NOM_EQUIPO_LARGO"<?= $Page->NOM_EQUIPO_LARGO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_EQUIPO_LARGO" class="el_equipo_NOM_EQUIPO_LARGO">
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_LARGO" name="x<?= $Page->RowIndex ?>_NOM_EQUIPO_LARGO" id="x<?= $Page->RowIndex ?>_NOM_EQUIPO_LARGO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_LARGO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_LARGO->editAttributes() ?>><?= $Page->NOM_EQUIPO_LARGO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->NOM_EQUIPO_LARGO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_EQUIPO_LARGO" class="el_equipo_NOM_EQUIPO_LARGO">
<span<?= $Page->NOM_EQUIPO_LARGO->viewAttributes() ?>>
<?= $Page->NOM_EQUIPO_LARGO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->PAIS_EQUIPO->Visible) { // PAIS_EQUIPO ?>
        <td data-name="PAIS_EQUIPO"<?= $Page->PAIS_EQUIPO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_PAIS_EQUIPO" class="el_equipo_PAIS_EQUIPO">
<textarea data-table="equipo" data-field="x_PAIS_EQUIPO" name="x<?= $Page->RowIndex ?>_PAIS_EQUIPO" id="x<?= $Page->RowIndex ?>_PAIS_EQUIPO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->PAIS_EQUIPO->getPlaceHolder()) ?>"<?= $Page->PAIS_EQUIPO->editAttributes() ?>><?= $Page->PAIS_EQUIPO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->PAIS_EQUIPO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_PAIS_EQUIPO" class="el_equipo_PAIS_EQUIPO">
<span<?= $Page->PAIS_EQUIPO->viewAttributes() ?>>
<?= $Page->PAIS_EQUIPO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->REGION_EQUIPO->Visible) { // REGION_EQUIPO ?>
        <td data-name="REGION_EQUIPO"<?= $Page->REGION_EQUIPO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_REGION_EQUIPO" class="el_equipo_REGION_EQUIPO">
    <select
        id="x<?= $Page->RowIndex ?>_REGION_EQUIPO"
        name="x<?= $Page->RowIndex ?>_REGION_EQUIPO"
        class="form-select ew-select<?= $Page->REGION_EQUIPO->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_REGION_EQUIPO"
        data-table="equipo"
        data-field="x_REGION_EQUIPO"
        data-value-separator="<?= $Page->REGION_EQUIPO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->REGION_EQUIPO->getPlaceHolder()) ?>"
        <?= $Page->REGION_EQUIPO->editAttributes() ?>>
        <?= $Page->REGION_EQUIPO->selectOptionListHtml("x{$Page->RowIndex}_REGION_EQUIPO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->REGION_EQUIPO->getErrorMessage() ?></div>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_REGION_EQUIPO", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_REGION_EQUIPO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.REGION_EQUIPO?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_REGION_EQUIPO", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_REGION_EQUIPO", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipo.fields.REGION_EQUIPO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_REGION_EQUIPO" class="el_equipo_REGION_EQUIPO">
<span<?= $Page->REGION_EQUIPO->viewAttributes() ?>>
<?= $Page->REGION_EQUIPO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->DETALLE_EQUIPO->Visible) { // DETALLE_EQUIPO ?>
        <td data-name="DETALLE_EQUIPO"<?= $Page->DETALLE_EQUIPO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_DETALLE_EQUIPO" class="el_equipo_DETALLE_EQUIPO">
<textarea data-table="equipo" data-field="x_DETALLE_EQUIPO" name="x<?= $Page->RowIndex ?>_DETALLE_EQUIPO" id="x<?= $Page->RowIndex ?>_DETALLE_EQUIPO" cols="35" rows="2" placeholder="<?= HtmlEncode($Page->DETALLE_EQUIPO->getPlaceHolder()) ?>"<?= $Page->DETALLE_EQUIPO->editAttributes() ?>><?= $Page->DETALLE_EQUIPO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->DETALLE_EQUIPO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_DETALLE_EQUIPO" class="el_equipo_DETALLE_EQUIPO">
<span<?= $Page->DETALLE_EQUIPO->viewAttributes() ?>>
<?= $Page->DETALLE_EQUIPO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->ESCUDO_EQUIPO->Visible) { // ESCUDO_EQUIPO ?>
        <td data-name="ESCUDO_EQUIPO"<?= $Page->ESCUDO_EQUIPO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_ESCUDO_EQUIPO" class="el_equipo_ESCUDO_EQUIPO">
<div id="fd_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO"
        name="x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO"
        class="form-control ew-file-input"
        title="<?= $Page->ESCUDO_EQUIPO->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="equipo"
        data-field="x_ESCUDO_EQUIPO"
        data-size="1024"
        data-accept-file-types="<?= $Page->ESCUDO_EQUIPO->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->ESCUDO_EQUIPO->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->ESCUDO_EQUIPO->ImageCropper ? 0 : 1 ?>"
        <?= ($Page->ESCUDO_EQUIPO->ReadOnly || $Page->ESCUDO_EQUIPO->Disabled) ? " disabled" : "" ?>
        <?= $Page->ESCUDO_EQUIPO->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Page->ESCUDO_EQUIPO->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" id= "fn_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" value="<?= $Page->ESCUDO_EQUIPO->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" id= "fa_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" value="<?= (Post("fa_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Page->RowIndex ?>_ESCUDO_EQUIPO" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_ESCUDO_EQUIPO" class="el_equipo_ESCUDO_EQUIPO">
<span>
<?= GetFileViewTag($Page->ESCUDO_EQUIPO, $Page->ESCUDO_EQUIPO->getViewValue(), false) ?>
</span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->NOM_ESTADIO->Visible) { // NOM_ESTADIO ?>
        <td data-name="NOM_ESTADIO"<?= $Page->NOM_ESTADIO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_ESTADIO" class="el_equipo_NOM_ESTADIO">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Page->RowIndex ?>_NOM_ESTADIO"
        name="x<?= $Page->RowIndex ?>_NOM_ESTADIO"
        class="form-select ew-select<?= $Page->NOM_ESTADIO->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_NOM_ESTADIO"
        data-table="equipo"
        data-field="x_NOM_ESTADIO"
        data-value-separator="<?= $Page->NOM_ESTADIO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->NOM_ESTADIO->getPlaceHolder()) ?>"
        <?= $Page->NOM_ESTADIO->editAttributes() ?>>
        <?= $Page->NOM_ESTADIO->selectOptionListHtml("x{$Page->RowIndex}_NOM_ESTADIO") ?>
    </select>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_NOM_ESTADIO" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->NOM_ESTADIO->caption() ?>" data-title="<?= $Page->NOM_ESTADIO->caption() ?>" data-ew-action="add-option" data-el="x<?= $Page->RowIndex ?>_NOM_ESTADIO" data-url="<?= GetUrl("estadioaddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
</div>
<div class="invalid-feedback"><?= $Page->NOM_ESTADIO->getErrorMessage() ?></div>
<?= $Page->NOM_ESTADIO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_NOM_ESTADIO") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_NOM_ESTADIO", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_NOM_ESTADIO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.NOM_ESTADIO?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_NOM_ESTADIO", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_NOM_ESTADIO", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipo.fields.NOM_ESTADIO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_NOM_ESTADIO" class="el_equipo_NOM_ESTADIO">
<span<?= $Page->NOM_ESTADIO->viewAttributes() ?>>
<?= $Page->NOM_ESTADIO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <td data-name="crea_dato"<?= $Page->crea_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_crea_dato" class="el_equipo_crea_dato">
<input type="hidden" data-table="equipo" data-field="x_crea_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_crea_dato" id="x<?= $Page->RowIndex ?>_crea_dato" value="<?= HtmlEncode($Page->crea_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_crea_dato" class="el_equipo_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <td data-name="modifica_dato"<?= $Page->modifica_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_equipo_modifica_dato" class="el_equipo_modifica_dato">
<input type="hidden" data-table="equipo" data-field="x_modifica_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_modifica_dato" id="x<?= $Page->RowIndex ?>_modifica_dato" value="<?= HtmlEncode($Page->modifica_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_modifica_dato" class="el_equipo_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<?= $Page->modifica_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->usuario_dato->Visible) { // usuario_dato ?>
        <td data-name="usuario_dato"<?= $Page->usuario_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_equipo_usuario_dato" class="el_equipo_usuario_dato">
<span<?= $Page->usuario_dato->viewAttributes() ?>>
<?= $Page->usuario_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Page->RowIndex ?>">
loadjs.ready(["<?= $Page->FormName ?>","load"], () => <?= $Page->FormName ?>.updateLists(<?= $Page->RowIndex ?><?= $Page->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("equipo");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
