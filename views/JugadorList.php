<?php

namespace PHPMaker2023\project11;

// Page object
$JugadorList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jugador: currentTable } });
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
            ["id_jugador", [fields.id_jugador.visible && fields.id_jugador.required ? ew.Validators.required(fields.id_jugador.caption) : null], fields.id_jugador.isInvalid],
            ["nombre_jugador", [fields.nombre_jugador.visible && fields.nombre_jugador.required ? ew.Validators.required(fields.nombre_jugador.caption) : null], fields.nombre_jugador.isInvalid],
            ["votos_jugador", [fields.votos_jugador.visible && fields.votos_jugador.required ? ew.Validators.required(fields.votos_jugador.caption) : null], fields.votos_jugador.isInvalid],
            ["imagen_jugador", [fields.imagen_jugador.visible && fields.imagen_jugador.required ? ew.Validators.fileRequired(fields.imagen_jugador.caption) : null], fields.imagen_jugador.isInvalid],
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
<form name="fjugadorsrch" id="fjugadorsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fjugadorsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jugador: currentTable } });
var currentForm;
var fjugadorsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fjugadorsrch")
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
<input type="hidden" name="t" value="jugador">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fjugadorsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fjugadorsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fjugadorsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fjugadorsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="jugador">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_jugador" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isAdd() || $Page->isCopy() || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_jugadorlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->id_jugador->Visible) { // id_jugador ?>
        <th data-name="id_jugador" class="<?= $Page->id_jugador->headerCellClass() ?>"><div id="elh_jugador_id_jugador" class="jugador_id_jugador"><?= $Page->renderFieldHeader($Page->id_jugador) ?></div></th>
<?php } ?>
<?php if ($Page->nombre_jugador->Visible) { // nombre_jugador ?>
        <th data-name="nombre_jugador" class="<?= $Page->nombre_jugador->headerCellClass() ?>"><div id="elh_jugador_nombre_jugador" class="jugador_nombre_jugador"><?= $Page->renderFieldHeader($Page->nombre_jugador) ?></div></th>
<?php } ?>
<?php if ($Page->votos_jugador->Visible) { // votos_jugador ?>
        <th data-name="votos_jugador" class="<?= $Page->votos_jugador->headerCellClass() ?>"><div id="elh_jugador_votos_jugador" class="jugador_votos_jugador"><?= $Page->renderFieldHeader($Page->votos_jugador) ?></div></th>
<?php } ?>
<?php if ($Page->imagen_jugador->Visible) { // imagen_jugador ?>
        <th data-name="imagen_jugador" class="<?= $Page->imagen_jugador->headerCellClass() ?>"><div id="elh_jugador_imagen_jugador" class="jugador_imagen_jugador"><?= $Page->renderFieldHeader($Page->imagen_jugador) ?></div></th>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <th data-name="crea_dato" class="<?= $Page->crea_dato->headerCellClass() ?>"><div id="elh_jugador_crea_dato" class="jugador_crea_dato"><?= $Page->renderFieldHeader($Page->crea_dato) ?></div></th>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <th data-name="modifica_dato" class="<?= $Page->modifica_dato->headerCellClass() ?>"><div id="elh_jugador_modifica_dato" class="jugador_modifica_dato"><?= $Page->renderFieldHeader($Page->modifica_dato) ?></div></th>
<?php } ?>
<?php if ($Page->usuario_dato->Visible) { // usuario_dato ?>
        <th data-name="usuario_dato" class="<?= $Page->usuario_dato->headerCellClass() ?>"><div id="elh_jugador_usuario_dato" class="jugador_usuario_dato"><?= $Page->renderFieldHeader($Page->usuario_dato) ?></div></th>
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
    <?php if ($Page->id_jugador->Visible) { // id_jugador ?>
        <td data-name="id_jugador"<?= $Page->id_jugador->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_id_jugador" class="el_jugador_id_jugador"></span>
<input type="hidden" data-table="jugador" data-field="x_id_jugador" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_id_jugador" id="o<?= $Page->RowIndex ?>_id_jugador" value="<?= HtmlEncode($Page->id_jugador->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_id_jugador" class="el_jugador_id_jugador">
<span<?= $Page->id_jugador->viewAttributes() ?>>
<?= $Page->id_jugador->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->nombre_jugador->Visible) { // nombre_jugador ?>
        <td data-name="nombre_jugador"<?= $Page->nombre_jugador->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_nombre_jugador" class="el_jugador_nombre_jugador">
<textarea data-table="jugador" data-field="x_nombre_jugador" name="x<?= $Page->RowIndex ?>_nombre_jugador" id="x<?= $Page->RowIndex ?>_nombre_jugador" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->nombre_jugador->getPlaceHolder()) ?>"<?= $Page->nombre_jugador->editAttributes() ?>><?= $Page->nombre_jugador->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->nombre_jugador->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jugador" data-field="x_nombre_jugador" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_nombre_jugador" id="o<?= $Page->RowIndex ?>_nombre_jugador" value="<?= HtmlEncode($Page->nombre_jugador->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_nombre_jugador" class="el_jugador_nombre_jugador">
<span<?= $Page->nombre_jugador->viewAttributes() ?>>
<?= $Page->nombre_jugador->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->votos_jugador->Visible) { // votos_jugador ?>
        <td data-name="votos_jugador"<?= $Page->votos_jugador->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_votos_jugador" class="el_jugador_votos_jugador">
<textarea data-table="jugador" data-field="x_votos_jugador" name="x<?= $Page->RowIndex ?>_votos_jugador" id="x<?= $Page->RowIndex ?>_votos_jugador" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->votos_jugador->getPlaceHolder()) ?>"<?= $Page->votos_jugador->editAttributes() ?>><?= $Page->votos_jugador->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->votos_jugador->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jugador" data-field="x_votos_jugador" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_votos_jugador" id="o<?= $Page->RowIndex ?>_votos_jugador" value="<?= HtmlEncode($Page->votos_jugador->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_votos_jugador" class="el_jugador_votos_jugador">
<span<?= $Page->votos_jugador->viewAttributes() ?>>
<?= $Page->votos_jugador->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->imagen_jugador->Visible) { // imagen_jugador ?>
        <td data-name="imagen_jugador"<?= $Page->imagen_jugador->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_imagen_jugador" class="el_jugador_imagen_jugador">
<div id="fd_x<?= $Page->RowIndex ?>_imagen_jugador" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x<?= $Page->RowIndex ?>_imagen_jugador"
        name="x<?= $Page->RowIndex ?>_imagen_jugador"
        class="form-control ew-file-input"
        title="<?= $Page->imagen_jugador->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="jugador"
        data-field="x_imagen_jugador"
        data-size="1024"
        data-accept-file-types="<?= $Page->imagen_jugador->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->imagen_jugador->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->imagen_jugador->ImageCropper ? 0 : 1 ?>"
        <?= ($Page->imagen_jugador->ReadOnly || $Page->imagen_jugador->Disabled) ? " disabled" : "" ?>
        <?= $Page->imagen_jugador->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Page->imagen_jugador->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Page->RowIndex ?>_imagen_jugador" id= "fn_x<?= $Page->RowIndex ?>_imagen_jugador" value="<?= $Page->imagen_jugador->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Page->RowIndex ?>_imagen_jugador" id= "fa_x<?= $Page->RowIndex ?>_imagen_jugador" value="0">
<table id="ft_x<?= $Page->RowIndex ?>_imagen_jugador" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="jugador" data-field="x_imagen_jugador" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_imagen_jugador" id="o<?= $Page->RowIndex ?>_imagen_jugador" value="<?= HtmlEncode($Page->imagen_jugador->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_imagen_jugador" class="el_jugador_imagen_jugador">
<span>
<?= GetFileViewTag($Page->imagen_jugador, $Page->imagen_jugador->getViewValue(), false) ?>
</span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <td data-name="crea_dato"<?= $Page->crea_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_crea_dato" class="el_jugador_crea_dato">
<input type="<?= $Page->crea_dato->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_crea_dato" id="x<?= $Page->RowIndex ?>_crea_dato" data-table="jugador" data-field="x_crea_dato" value="<?= $Page->crea_dato->EditValue ?>" placeholder="<?= HtmlEncode($Page->crea_dato->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->crea_dato->formatPattern()) ?>"<?= $Page->crea_dato->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->crea_dato->getErrorMessage() ?></div>
<?php if (!$Page->crea_dato->ReadOnly && !$Page->crea_dato->Disabled && !isset($Page->crea_dato->EditAttrs["readonly"]) && !isset($Page->crea_dato->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_crea_dato", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jugador" data-field="x_crea_dato" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_crea_dato" id="o<?= $Page->RowIndex ?>_crea_dato" value="<?= HtmlEncode($Page->crea_dato->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_crea_dato" class="el_jugador_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <td data-name="modifica_dato"<?= $Page->modifica_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_modifica_dato" class="el_jugador_modifica_dato">
<input type="<?= $Page->modifica_dato->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_modifica_dato" id="x<?= $Page->RowIndex ?>_modifica_dato" data-table="jugador" data-field="x_modifica_dato" value="<?= $Page->modifica_dato->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifica_dato->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->modifica_dato->formatPattern()) ?>"<?= $Page->modifica_dato->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifica_dato->getErrorMessage() ?></div>
<?php if (!$Page->modifica_dato->ReadOnly && !$Page->modifica_dato->Disabled && !isset($Page->modifica_dato->EditAttrs["readonly"]) && !isset($Page->modifica_dato->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["<?= $Page->FormName ?>", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                },
                theme: ew.isDark() ? "dark" : "auto"
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("<?= $Page->FormName ?>", "x<?= $Page->RowIndex ?>_modifica_dato", jQuery.extend(true, {"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="jugador" data-field="x_modifica_dato" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_modifica_dato" id="o<?= $Page->RowIndex ?>_modifica_dato" value="<?= HtmlEncode($Page->modifica_dato->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_modifica_dato" class="el_jugador_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<?= $Page->modifica_dato->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->usuario_dato->Visible) { // usuario_dato ?>
        <td data-name="usuario_dato"<?= $Page->usuario_dato->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_jugador_usuario_dato" class="el_jugador_usuario_dato">
<textarea data-table="jugador" data-field="x_usuario_dato" name="x<?= $Page->RowIndex ?>_usuario_dato" id="x<?= $Page->RowIndex ?>_usuario_dato" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->usuario_dato->getPlaceHolder()) ?>"<?= $Page->usuario_dato->editAttributes() ?>><?= $Page->usuario_dato->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->usuario_dato->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="jugador" data-field="x_usuario_dato" data-hidden="1" data-old name="o<?= $Page->RowIndex ?>_usuario_dato" id="o<?= $Page->RowIndex ?>_usuario_dato" value="<?= HtmlEncode($Page->usuario_dato->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_jugador_usuario_dato" class="el_jugador_usuario_dato">
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
<?php if ($Page->isAdd() || $Page->isCopy()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
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
    ew.addEventHandlers("jugador");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
