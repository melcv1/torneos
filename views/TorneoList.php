<?php

namespace PHPMaker2023\project11;

// Page object
$TorneoList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { torneo: currentTable } });
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
            ["ID_TORNEO", [fields.ID_TORNEO.visible && fields.ID_TORNEO.required ? ew.Validators.required(fields.ID_TORNEO.caption) : null], fields.ID_TORNEO.isInvalid],
            ["NOM_TORNEO_CORTO", [fields.NOM_TORNEO_CORTO.visible && fields.NOM_TORNEO_CORTO.required ? ew.Validators.required(fields.NOM_TORNEO_CORTO.caption) : null], fields.NOM_TORNEO_CORTO.isInvalid],
            ["NOM_TORNEO_LARGO", [fields.NOM_TORNEO_LARGO.visible && fields.NOM_TORNEO_LARGO.required ? ew.Validators.required(fields.NOM_TORNEO_LARGO.caption) : null], fields.NOM_TORNEO_LARGO.isInvalid],
            ["PAIS_TORNEO", [fields.PAIS_TORNEO.visible && fields.PAIS_TORNEO.required ? ew.Validators.required(fields.PAIS_TORNEO.caption) : null], fields.PAIS_TORNEO.isInvalid],
            ["REGION_TORNEO", [fields.REGION_TORNEO.visible && fields.REGION_TORNEO.required ? ew.Validators.required(fields.REGION_TORNEO.caption) : null], fields.REGION_TORNEO.isInvalid],
            ["DETALLE_TORNEO", [fields.DETALLE_TORNEO.visible && fields.DETALLE_TORNEO.required ? ew.Validators.required(fields.DETALLE_TORNEO.caption) : null], fields.DETALLE_TORNEO.isInvalid],
            ["LOGO_TORNEO", [fields.LOGO_TORNEO.visible && fields.LOGO_TORNEO.required ? ew.Validators.fileRequired(fields.LOGO_TORNEO.caption) : null], fields.LOGO_TORNEO.isInvalid],
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
<form name="ftorneosrch" id="ftorneosrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="ftorneosrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { torneo: currentTable } });
var currentForm;
var ftorneosrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("ftorneosrch")
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
<input type="hidden" name="t" value="torneo">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftorneosrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftorneosrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftorneosrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftorneosrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="torneo">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_torneo" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_torneolist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->ID_TORNEO->Visible) { // ID_TORNEO ?>
        <th data-name="ID_TORNEO" class="<?= $Page->ID_TORNEO->headerCellClass() ?>"><div id="elh_torneo_ID_TORNEO" class="torneo_ID_TORNEO"><?= $Page->renderFieldHeader($Page->ID_TORNEO) ?></div></th>
<?php } ?>
<?php if ($Page->NOM_TORNEO_CORTO->Visible) { // NOM_TORNEO_CORTO ?>
        <th data-name="NOM_TORNEO_CORTO" class="<?= $Page->NOM_TORNEO_CORTO->headerCellClass() ?>"><div id="elh_torneo_NOM_TORNEO_CORTO" class="torneo_NOM_TORNEO_CORTO"><?= $Page->renderFieldHeader($Page->NOM_TORNEO_CORTO) ?></div></th>
<?php } ?>
<?php if ($Page->NOM_TORNEO_LARGO->Visible) { // NOM_TORNEO_LARGO ?>
        <th data-name="NOM_TORNEO_LARGO" class="<?= $Page->NOM_TORNEO_LARGO->headerCellClass() ?>"><div id="elh_torneo_NOM_TORNEO_LARGO" class="torneo_NOM_TORNEO_LARGO"><?= $Page->renderFieldHeader($Page->NOM_TORNEO_LARGO) ?></div></th>
<?php } ?>
<?php if ($Page->PAIS_TORNEO->Visible) { // PAIS_TORNEO ?>
        <th data-name="PAIS_TORNEO" class="<?= $Page->PAIS_TORNEO->headerCellClass() ?>"><div id="elh_torneo_PAIS_TORNEO" class="torneo_PAIS_TORNEO"><?= $Page->renderFieldHeader($Page->PAIS_TORNEO) ?></div></th>
<?php } ?>
<?php if ($Page->REGION_TORNEO->Visible) { // REGION_TORNEO ?>
        <th data-name="REGION_TORNEO" class="<?= $Page->REGION_TORNEO->headerCellClass() ?>"><div id="elh_torneo_REGION_TORNEO" class="torneo_REGION_TORNEO"><?= $Page->renderFieldHeader($Page->REGION_TORNEO) ?></div></th>
<?php } ?>
<?php if ($Page->DETALLE_TORNEO->Visible) { // DETALLE_TORNEO ?>
        <th data-name="DETALLE_TORNEO" class="<?= $Page->DETALLE_TORNEO->headerCellClass() ?>"><div id="elh_torneo_DETALLE_TORNEO" class="torneo_DETALLE_TORNEO"><?= $Page->renderFieldHeader($Page->DETALLE_TORNEO) ?></div></th>
<?php } ?>
<?php if ($Page->LOGO_TORNEO->Visible) { // LOGO_TORNEO ?>
        <th data-name="LOGO_TORNEO" class="<?= $Page->LOGO_TORNEO->headerCellClass() ?>"><div id="elh_torneo_LOGO_TORNEO" class="torneo_LOGO_TORNEO"><?= $Page->renderFieldHeader($Page->LOGO_TORNEO) ?></div></th>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <th data-name="crea_dato" class="<?= $Page->crea_dato->headerCellClass() ?>"><div id="elh_torneo_crea_dato" class="torneo_crea_dato"><?= $Page->renderFieldHeader($Page->crea_dato) ?></div></th>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <th data-name="modifica_dato" class="<?= $Page->modifica_dato->headerCellClass() ?>"><div id="elh_torneo_modifica_dato" class="torneo_modifica_dato"><?= $Page->renderFieldHeader($Page->modifica_dato) ?></div></th>
<?php } ?>
<?php if ($Page->usuario_dato->Visible) { // usuario_dato ?>
        <th data-name="usuario_dato" class="<?= $Page->usuario_dato->headerCellClass() ?>"><div id="elh_torneo_usuario_dato" class="torneo_usuario_dato"><?= $Page->renderFieldHeader($Page->usuario_dato) ?></div></th>
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
    <?php if ($Page->ID_TORNEO->Visible) { // ID_TORNEO ?>
        <td data-name="ID_TORNEO"<?= $Page->ID_TORNEO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_ID_TORNEO" class="el_torneo_ID_TORNEO">
<span<?= $Page->ID_TORNEO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID_TORNEO->getDisplayValue($Page->ID_TORNEO->EditValue))) ?>"></span>
<input type="hidden" data-table="torneo" data-field="x_ID_TORNEO" data-hidden="1" name="x<?= $Page->RowIndex ?>_ID_TORNEO" id="x<?= $Page->RowIndex ?>_ID_TORNEO" value="<?= HtmlEncode($Page->ID_TORNEO->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_ID_TORNEO" class="el_torneo_ID_TORNEO">
<span<?= $Page->ID_TORNEO->viewAttributes() ?>>
<?= $Page->ID_TORNEO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="torneo" data-field="x_ID_TORNEO" data-hidden="1" name="x<?= $Page->RowIndex ?>_ID_TORNEO" id="x<?= $Page->RowIndex ?>_ID_TORNEO" value="<?= HtmlEncode($Page->ID_TORNEO->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->NOM_TORNEO_CORTO->Visible) { // NOM_TORNEO_CORTO ?>
        <td data-name="NOM_TORNEO_CORTO"<?= $Page->NOM_TORNEO_CORTO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_NOM_TORNEO_CORTO" class="el_torneo_NOM_TORNEO_CORTO">
<textarea data-table="torneo" data-field="x_NOM_TORNEO_CORTO" name="x<?= $Page->RowIndex ?>_NOM_TORNEO_CORTO" id="x<?= $Page->RowIndex ?>_NOM_TORNEO_CORTO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NOM_TORNEO_CORTO->getPlaceHolder()) ?>"<?= $Page->NOM_TORNEO_CORTO->editAttributes() ?>><?= $Page->NOM_TORNEO_CORTO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->NOM_TORNEO_CORTO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_NOM_TORNEO_CORTO" class="el_torneo_NOM_TORNEO_CORTO">
<span<?= $Page->NOM_TORNEO_CORTO->viewAttributes() ?>>
<?= $Page->NOM_TORNEO_CORTO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->NOM_TORNEO_LARGO->Visible) { // NOM_TORNEO_LARGO ?>
        <td data-name="NOM_TORNEO_LARGO"<?= $Page->NOM_TORNEO_LARGO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_NOM_TORNEO_LARGO" class="el_torneo_NOM_TORNEO_LARGO">
<textarea data-table="torneo" data-field="x_NOM_TORNEO_LARGO" name="x<?= $Page->RowIndex ?>_NOM_TORNEO_LARGO" id="x<?= $Page->RowIndex ?>_NOM_TORNEO_LARGO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_TORNEO_LARGO->getPlaceHolder()) ?>"<?= $Page->NOM_TORNEO_LARGO->editAttributes() ?>><?= $Page->NOM_TORNEO_LARGO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->NOM_TORNEO_LARGO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_NOM_TORNEO_LARGO" class="el_torneo_NOM_TORNEO_LARGO">
<span<?= $Page->NOM_TORNEO_LARGO->viewAttributes() ?>>
<?= $Page->NOM_TORNEO_LARGO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->PAIS_TORNEO->Visible) { // PAIS_TORNEO ?>
        <td data-name="PAIS_TORNEO"<?= $Page->PAIS_TORNEO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_PAIS_TORNEO" class="el_torneo_PAIS_TORNEO">
<textarea data-table="torneo" data-field="x_PAIS_TORNEO" name="x<?= $Page->RowIndex ?>_PAIS_TORNEO" id="x<?= $Page->RowIndex ?>_PAIS_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->PAIS_TORNEO->getPlaceHolder()) ?>"<?= $Page->PAIS_TORNEO->editAttributes() ?>><?= $Page->PAIS_TORNEO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->PAIS_TORNEO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_PAIS_TORNEO" class="el_torneo_PAIS_TORNEO">
<span<?= $Page->PAIS_TORNEO->viewAttributes() ?>>
<?= $Page->PAIS_TORNEO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->REGION_TORNEO->Visible) { // REGION_TORNEO ?>
        <td data-name="REGION_TORNEO"<?= $Page->REGION_TORNEO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_REGION_TORNEO" class="el_torneo_REGION_TORNEO">
<textarea data-table="torneo" data-field="x_REGION_TORNEO" name="x<?= $Page->RowIndex ?>_REGION_TORNEO" id="x<?= $Page->RowIndex ?>_REGION_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->REGION_TORNEO->getPlaceHolder()) ?>"<?= $Page->REGION_TORNEO->editAttributes() ?>><?= $Page->REGION_TORNEO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->REGION_TORNEO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_REGION_TORNEO" class="el_torneo_REGION_TORNEO">
<span<?= $Page->REGION_TORNEO->viewAttributes() ?>>
<?= $Page->REGION_TORNEO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->DETALLE_TORNEO->Visible) { // DETALLE_TORNEO ?>
        <td data-name="DETALLE_TORNEO"<?= $Page->DETALLE_TORNEO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_DETALLE_TORNEO" class="el_torneo_DETALLE_TORNEO">
<textarea data-table="torneo" data-field="x_DETALLE_TORNEO" name="x<?= $Page->RowIndex ?>_DETALLE_TORNEO" id="x<?= $Page->RowIndex ?>_DETALLE_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->DETALLE_TORNEO->getPlaceHolder()) ?>"<?= $Page->DETALLE_TORNEO->editAttributes() ?>><?= $Page->DETALLE_TORNEO->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->DETALLE_TORNEO->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_DETALLE_TORNEO" class="el_torneo_DETALLE_TORNEO">
<span<?= $Page->DETALLE_TORNEO->viewAttributes() ?>>
<?= $Page->DETALLE_TORNEO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->LOGO_TORNEO->Visible) { // LOGO_TORNEO ?>
        <td data-name="LOGO_TORNEO"<?= $Page->LOGO_TORNEO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_LOGO_TORNEO" class="el_torneo_LOGO_TORNEO">
<div id="fd_x<?= $Page->RowIndex ?>_LOGO_TORNEO" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Page->RowIndex ?>_LOGO_TORNEO"
        name="x<?= $Page->RowIndex ?>_LOGO_TORNEO"
        class="form-control ew-file-input"
        title="<?= $Page->LOGO_TORNEO->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="torneo"
        data-field="x_LOGO_TORNEO"
        data-size="1024"
        data-accept-file-types="<?= $Page->LOGO_TORNEO->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->LOGO_TORNEO->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->LOGO_TORNEO->ImageCropper ? 0 : 1 ?>"
        <?= ($Page->LOGO_TORNEO->ReadOnly || $Page->LOGO_TORNEO->Disabled) ? " disabled" : "" ?>
        <?= $Page->LOGO_TORNEO->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Page->LOGO_TORNEO->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Page->RowIndex ?>_LOGO_TORNEO" id= "fn_x<?= $Page->RowIndex ?>_LOGO_TORNEO" value="<?= $Page->LOGO_TORNEO->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Page->RowIndex ?>_LOGO_TORNEO" id= "fa_x<?= $Page->RowIndex ?>_LOGO_TORNEO" value="<?= (Post("fa_x<?= $Page->RowIndex ?>_LOGO_TORNEO") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Page->RowIndex ?>_LOGO_TORNEO" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_LOGO_TORNEO" class="el_torneo_LOGO_TORNEO">
<span>
<?= GetFileViewTag($Page->LOGO_TORNEO, $Page->LOGO_TORNEO->getViewValue(), false) ?>
</span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <td data-name="crea_dato"<?= $Page->crea_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_crea_dato" class="el_torneo_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->crea_dato->getDisplayValue($Page->crea_dato->EditValue))) ?>"></span>
<input type="hidden" data-table="torneo" data-field="x_crea_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_crea_dato" id="x<?= $Page->RowIndex ?>_crea_dato" value="<?= HtmlEncode($Page->crea_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_crea_dato" class="el_torneo_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <td data-name="modifica_dato"<?= $Page->modifica_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_torneo_modifica_dato" class="el_torneo_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->modifica_dato->getDisplayValue($Page->modifica_dato->EditValue))) ?>"></span>
<input type="hidden" data-table="torneo" data-field="x_modifica_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_modifica_dato" id="x<?= $Page->RowIndex ?>_modifica_dato" value="<?= HtmlEncode($Page->modifica_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_torneo_modifica_dato" class="el_torneo_modifica_dato">
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
<span id="el<?= $Page->RowCount ?>_torneo_usuario_dato" class="el_torneo_usuario_dato">
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
    ew.addEventHandlers("torneo");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
