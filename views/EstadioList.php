<?php

namespace PHPMaker2023\project11;

// Page object
$EstadioList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { estadio: currentTable } });
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
            ["id_estadio", [fields.id_estadio.visible && fields.id_estadio.required ? ew.Validators.required(fields.id_estadio.caption) : null], fields.id_estadio.isInvalid],
            ["id_torneo", [fields.id_torneo.visible && fields.id_torneo.required ? ew.Validators.required(fields.id_torneo.caption) : null], fields.id_torneo.isInvalid],
            ["nombre_estadio", [fields.nombre_estadio.visible && fields.nombre_estadio.required ? ew.Validators.required(fields.nombre_estadio.caption) : null], fields.nombre_estadio.isInvalid],
            ["foto_estadio", [fields.foto_estadio.visible && fields.foto_estadio.required ? ew.Validators.fileRequired(fields.foto_estadio.caption) : null], fields.foto_estadio.isInvalid],
            ["crea_dato", [fields.crea_dato.visible && fields.crea_dato.required ? ew.Validators.required(fields.crea_dato.caption) : null], fields.crea_dato.isInvalid],
            ["modifica_dato", [fields.modifica_dato.visible && fields.modifica_dato.required ? ew.Validators.required(fields.modifica_dato.caption) : null], fields.modifica_dato.isInvalid]
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
            "id_torneo": <?= $Page->id_torneo->toClientList($Page) ?>,
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
<form name="festadiosrch" id="festadiosrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="festadiosrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { estadio: currentTable } });
var currentForm;
var festadiosrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("festadiosrch")
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
<input type="hidden" name="t" value="estadio">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="festadiosrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="festadiosrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="festadiosrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="festadiosrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="estadio">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_estadio" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_estadiolist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->id_estadio->Visible) { // id_estadio ?>
        <th data-name="id_estadio" class="<?= $Page->id_estadio->headerCellClass() ?>"><div id="elh_estadio_id_estadio" class="estadio_id_estadio"><?= $Page->renderFieldHeader($Page->id_estadio) ?></div></th>
<?php } ?>
<?php if ($Page->id_torneo->Visible) { // id_torneo ?>
        <th data-name="id_torneo" class="<?= $Page->id_torneo->headerCellClass() ?>"><div id="elh_estadio_id_torneo" class="estadio_id_torneo"><?= $Page->renderFieldHeader($Page->id_torneo) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_estadio->Visible) { // nombre_estadio ?>
        <th data-name="nombre_estadio" class="<?= $Page->nombre_estadio->headerCellClass() ?>"><div id="elh_estadio_nombre_estadio" class="estadio_nombre_estadio"><?= $Page->renderFieldHeader($Page->nombre_estadio) ?></div></th>
<?php } ?>
<?php if ($Page->foto_estadio->Visible) { // foto_estadio ?>
        <th data-name="foto_estadio" class="<?= $Page->foto_estadio->headerCellClass() ?>"><div id="elh_estadio_foto_estadio" class="estadio_foto_estadio"><?= $Page->renderFieldHeader($Page->foto_estadio) ?></div></th>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <th data-name="crea_dato" class="<?= $Page->crea_dato->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_estadio_crea_dato" class="estadio_crea_dato"><?= $Page->renderFieldHeader($Page->crea_dato) ?></div></th>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <th data-name="modifica_dato" class="<?= $Page->modifica_dato->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_estadio_modifica_dato" class="estadio_modifica_dato"><?= $Page->renderFieldHeader($Page->modifica_dato) ?></div></th>
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
    <?php if ($Page->id_estadio->Visible) { // id_estadio ?>
        <td data-name="id_estadio"<?= $Page->id_estadio->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_id_estadio" class="el_estadio_id_estadio">
<span<?= $Page->id_estadio->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_estadio->getDisplayValue($Page->id_estadio->EditValue))) ?>"></span>
<input type="hidden" data-table="estadio" data-field="x_id_estadio" data-hidden="1" name="x<?= $Page->RowIndex ?>_id_estadio" id="x<?= $Page->RowIndex ?>_id_estadio" value="<?= HtmlEncode($Page->id_estadio->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_id_estadio" class="el_estadio_id_estadio">
<span<?= $Page->id_estadio->viewAttributes() ?>>
<?= $Page->id_estadio->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="estadio" data-field="x_id_estadio" data-hidden="1" name="x<?= $Page->RowIndex ?>_id_estadio" id="x<?= $Page->RowIndex ?>_id_estadio" value="<?= HtmlEncode($Page->id_estadio->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->id_torneo->Visible) { // id_torneo ?>
        <td data-name="id_torneo"<?= $Page->id_torneo->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_id_torneo" class="el_estadio_id_torneo">
    <select
        id="x<?= $Page->RowIndex ?>_id_torneo"
        name="x<?= $Page->RowIndex ?>_id_torneo"
        class="form-select ew-select<?= $Page->id_torneo->isInvalidClass() ?>"
        data-select2-id="<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_id_torneo"
        data-table="estadio"
        data-field="x_id_torneo"
        data-value-separator="<?= $Page->id_torneo->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_torneo->getPlaceHolder()) ?>"
        <?= $Page->id_torneo->editAttributes() ?>>
        <?= $Page->id_torneo->selectOptionListHtml("x{$Page->RowIndex}_id_torneo") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->id_torneo->getErrorMessage() ?></div>
<?= $Page->id_torneo->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_id_torneo") ?>
<script>
loadjs.ready("<?= $Page->FormName ?>", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_id_torneo", selectId: "<?= $Page->FormName ?>_x<?= $Page->RowIndex ?>_id_torneo" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (<?= $Page->FormName ?>.lists.id_torneo?.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_id_torneo", form: "<?= $Page->FormName ?>" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_id_torneo", form: "<?= $Page->FormName ?>", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.estadio.fields.id_torneo.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_id_torneo" class="el_estadio_id_torneo">
<span<?= $Page->id_torneo->viewAttributes() ?>>
<?= $Page->id_torneo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->nombre_estadio->Visible) { // nombre_estadio ?>
        <td data-name="nombre_estadio"<?= $Page->nombre_estadio->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_nombre_estadio" class="el_estadio_nombre_estadio">
<textarea data-table="estadio" data-field="x_nombre_estadio" name="x<?= $Page->RowIndex ?>_nombre_estadio" id="x<?= $Page->RowIndex ?>_nombre_estadio" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->nombre_estadio->getPlaceHolder()) ?>"<?= $Page->nombre_estadio->editAttributes() ?>><?= $Page->nombre_estadio->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->nombre_estadio->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_nombre_estadio" class="el_estadio_nombre_estadio">
<span<?= $Page->nombre_estadio->viewAttributes() ?>>
<?= $Page->nombre_estadio->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->foto_estadio->Visible) { // foto_estadio ?>
        <td data-name="foto_estadio"<?= $Page->foto_estadio->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_foto_estadio" class="el_estadio_foto_estadio">
<div id="fd_x<?= $Page->RowIndex ?>_foto_estadio" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Page->RowIndex ?>_foto_estadio"
        name="x<?= $Page->RowIndex ?>_foto_estadio"
        class="form-control ew-file-input"
        title="<?= $Page->foto_estadio->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="estadio"
        data-field="x_foto_estadio"
        data-size="1024"
        data-accept-file-types="<?= $Page->foto_estadio->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->foto_estadio->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->foto_estadio->ImageCropper ? 0 : 1 ?>"
        <?= ($Page->foto_estadio->ReadOnly || $Page->foto_estadio->Disabled) ? " disabled" : "" ?>
        <?= $Page->foto_estadio->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Page->foto_estadio->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Page->RowIndex ?>_foto_estadio" id= "fn_x<?= $Page->RowIndex ?>_foto_estadio" value="<?= $Page->foto_estadio->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Page->RowIndex ?>_foto_estadio" id= "fa_x<?= $Page->RowIndex ?>_foto_estadio" value="<?= (Post("fa_x<?= $Page->RowIndex ?>_foto_estadio") == "0") ? "0" : "1" ?>">
<table id="ft_x<?= $Page->RowIndex ?>_foto_estadio" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_foto_estadio" class="el_estadio_foto_estadio">
<span>
<?= GetFileViewTag($Page->foto_estadio, $Page->foto_estadio->getViewValue(), false) ?>
</span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <td data-name="crea_dato"<?= $Page->crea_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_crea_dato" class="el_estadio_crea_dato">
<input type="hidden" data-table="estadio" data-field="x_crea_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_crea_dato" id="x<?= $Page->RowIndex ?>_crea_dato" value="<?= HtmlEncode($Page->crea_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_crea_dato" class="el_estadio_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <td data-name="modifica_dato"<?= $Page->modifica_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_estadio_modifica_dato" class="el_estadio_modifica_dato">
<input type="hidden" data-table="estadio" data-field="x_modifica_dato" data-hidden="1" name="x<?= $Page->RowIndex ?>_modifica_dato" id="x<?= $Page->RowIndex ?>_modifica_dato" value="<?= HtmlEncode($Page->modifica_dato->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_estadio_modifica_dato" class="el_estadio_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<?= $Page->modifica_dato->getViewValue() ?></span>
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
    ew.addEventHandlers("estadio");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
