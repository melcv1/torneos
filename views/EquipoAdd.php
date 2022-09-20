<?php

namespace PHPMaker2023\project11;

// Page object
$EquipoAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipo: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fequipoadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fequipoadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["NOM_EQUIPO_CORTO", [fields.NOM_EQUIPO_CORTO.visible && fields.NOM_EQUIPO_CORTO.required ? ew.Validators.required(fields.NOM_EQUIPO_CORTO.caption) : null], fields.NOM_EQUIPO_CORTO.isInvalid],
            ["NOM_EQUIPO_LARGO", [fields.NOM_EQUIPO_LARGO.visible && fields.NOM_EQUIPO_LARGO.required ? ew.Validators.required(fields.NOM_EQUIPO_LARGO.caption) : null], fields.NOM_EQUIPO_LARGO.isInvalid],
            ["PAIS_EQUIPO", [fields.PAIS_EQUIPO.visible && fields.PAIS_EQUIPO.required ? ew.Validators.required(fields.PAIS_EQUIPO.caption) : null], fields.PAIS_EQUIPO.isInvalid],
            ["REGION_EQUIPO", [fields.REGION_EQUIPO.visible && fields.REGION_EQUIPO.required ? ew.Validators.required(fields.REGION_EQUIPO.caption) : null], fields.REGION_EQUIPO.isInvalid],
            ["DETALLE_EQUIPO", [fields.DETALLE_EQUIPO.visible && fields.DETALLE_EQUIPO.required ? ew.Validators.required(fields.DETALLE_EQUIPO.caption) : null], fields.DETALLE_EQUIPO.isInvalid],
            ["ESCUDO_EQUIPO", [fields.ESCUDO_EQUIPO.visible && fields.ESCUDO_EQUIPO.required ? ew.Validators.fileRequired(fields.ESCUDO_EQUIPO.caption) : null], fields.ESCUDO_EQUIPO.isInvalid],
            ["NOM_ESTADIO", [fields.NOM_ESTADIO.visible && fields.NOM_ESTADIO.required ? ew.Validators.required(fields.NOM_ESTADIO.caption) : null], fields.NOM_ESTADIO.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fequipoadd" id="fequipoadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="equipo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NOM_EQUIPO_CORTO->Visible) { // NOM_EQUIPO_CORTO ?>
    <div id="r_NOM_EQUIPO_CORTO"<?= $Page->NOM_EQUIPO_CORTO->rowAttributes() ?>>
        <label id="elh_equipo_NOM_EQUIPO_CORTO" for="x_NOM_EQUIPO_CORTO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_EQUIPO_CORTO->caption() ?><?= $Page->NOM_EQUIPO_CORTO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_EQUIPO_CORTO->cellAttributes() ?>>
<span id="el_equipo_NOM_EQUIPO_CORTO">
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_CORTO" name="x_NOM_EQUIPO_CORTO" id="x_NOM_EQUIPO_CORTO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_CORTO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_CORTO->editAttributes() ?> aria-describedby="x_NOM_EQUIPO_CORTO_help"><?= $Page->NOM_EQUIPO_CORTO->EditValue ?></textarea>
<?= $Page->NOM_EQUIPO_CORTO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_EQUIPO_CORTO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NOM_EQUIPO_LARGO->Visible) { // NOM_EQUIPO_LARGO ?>
    <div id="r_NOM_EQUIPO_LARGO"<?= $Page->NOM_EQUIPO_LARGO->rowAttributes() ?>>
        <label id="elh_equipo_NOM_EQUIPO_LARGO" for="x_NOM_EQUIPO_LARGO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_EQUIPO_LARGO->caption() ?><?= $Page->NOM_EQUIPO_LARGO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_EQUIPO_LARGO->cellAttributes() ?>>
<span id="el_equipo_NOM_EQUIPO_LARGO">
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_LARGO" name="x_NOM_EQUIPO_LARGO" id="x_NOM_EQUIPO_LARGO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_LARGO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_LARGO->editAttributes() ?> aria-describedby="x_NOM_EQUIPO_LARGO_help"><?= $Page->NOM_EQUIPO_LARGO->EditValue ?></textarea>
<?= $Page->NOM_EQUIPO_LARGO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_EQUIPO_LARGO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAIS_EQUIPO->Visible) { // PAIS_EQUIPO ?>
    <div id="r_PAIS_EQUIPO"<?= $Page->PAIS_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipo_PAIS_EQUIPO" for="x_PAIS_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAIS_EQUIPO->caption() ?><?= $Page->PAIS_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PAIS_EQUIPO->cellAttributes() ?>>
<span id="el_equipo_PAIS_EQUIPO">
<textarea data-table="equipo" data-field="x_PAIS_EQUIPO" name="x_PAIS_EQUIPO" id="x_PAIS_EQUIPO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->PAIS_EQUIPO->getPlaceHolder()) ?>"<?= $Page->PAIS_EQUIPO->editAttributes() ?> aria-describedby="x_PAIS_EQUIPO_help"><?= $Page->PAIS_EQUIPO->EditValue ?></textarea>
<?= $Page->PAIS_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAIS_EQUIPO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REGION_EQUIPO->Visible) { // REGION_EQUIPO ?>
    <div id="r_REGION_EQUIPO"<?= $Page->REGION_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipo_REGION_EQUIPO" for="x_REGION_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REGION_EQUIPO->caption() ?><?= $Page->REGION_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->REGION_EQUIPO->cellAttributes() ?>>
<span id="el_equipo_REGION_EQUIPO">
    <select
        id="x_REGION_EQUIPO"
        name="x_REGION_EQUIPO"
        class="form-select ew-select<?= $Page->REGION_EQUIPO->isInvalidClass() ?>"
        data-select2-id="fequipoadd_x_REGION_EQUIPO"
        data-table="equipo"
        data-field="x_REGION_EQUIPO"
        data-value-separator="<?= $Page->REGION_EQUIPO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->REGION_EQUIPO->getPlaceHolder()) ?>"
        <?= $Page->REGION_EQUIPO->editAttributes() ?>>
        <?= $Page->REGION_EQUIPO->selectOptionListHtml("x_REGION_EQUIPO") ?>
    </select>
    <?= $Page->REGION_EQUIPO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->REGION_EQUIPO->getErrorMessage() ?></div>
<script>
loadjs.ready("fequipoadd", function() {
    var options = { name: "x_REGION_EQUIPO", selectId: "fequipoadd_x_REGION_EQUIPO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipoadd.lists.REGION_EQUIPO?.lookupOptions.length) {
        options.data = { id: "x_REGION_EQUIPO", form: "fequipoadd" };
    } else {
        options.ajax = { id: "x_REGION_EQUIPO", form: "fequipoadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipo.fields.REGION_EQUIPO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DETALLE_EQUIPO->Visible) { // DETALLE_EQUIPO ?>
    <div id="r_DETALLE_EQUIPO"<?= $Page->DETALLE_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipo_DETALLE_EQUIPO" for="x_DETALLE_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DETALLE_EQUIPO->caption() ?><?= $Page->DETALLE_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DETALLE_EQUIPO->cellAttributes() ?>>
<span id="el_equipo_DETALLE_EQUIPO">
<textarea data-table="equipo" data-field="x_DETALLE_EQUIPO" name="x_DETALLE_EQUIPO" id="x_DETALLE_EQUIPO" cols="35" rows="2" placeholder="<?= HtmlEncode($Page->DETALLE_EQUIPO->getPlaceHolder()) ?>"<?= $Page->DETALLE_EQUIPO->editAttributes() ?> aria-describedby="x_DETALLE_EQUIPO_help"><?= $Page->DETALLE_EQUIPO->EditValue ?></textarea>
<?= $Page->DETALLE_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DETALLE_EQUIPO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ESCUDO_EQUIPO->Visible) { // ESCUDO_EQUIPO ?>
    <div id="r_ESCUDO_EQUIPO"<?= $Page->ESCUDO_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipo_ESCUDO_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ESCUDO_EQUIPO->caption() ?><?= $Page->ESCUDO_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ESCUDO_EQUIPO->cellAttributes() ?>>
<span id="el_equipo_ESCUDO_EQUIPO">
<div id="fd_x_ESCUDO_EQUIPO" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_ESCUDO_EQUIPO"
        name="x_ESCUDO_EQUIPO"
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
        aria-describedby="x_ESCUDO_EQUIPO_help"
        <?= ($Page->ESCUDO_EQUIPO->ReadOnly || $Page->ESCUDO_EQUIPO->Disabled) ? " disabled" : "" ?>
        <?= $Page->ESCUDO_EQUIPO->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->ESCUDO_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ESCUDO_EQUIPO->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_ESCUDO_EQUIPO" id= "fn_x_ESCUDO_EQUIPO" value="<?= $Page->ESCUDO_EQUIPO->Upload->FileName ?>">
<input type="hidden" name="fa_x_ESCUDO_EQUIPO" id= "fa_x_ESCUDO_EQUIPO" value="0">
<table id="ft_x_ESCUDO_EQUIPO" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NOM_ESTADIO->Visible) { // NOM_ESTADIO ?>
    <div id="r_NOM_ESTADIO"<?= $Page->NOM_ESTADIO->rowAttributes() ?>>
        <label id="elh_equipo_NOM_ESTADIO" for="x_NOM_ESTADIO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_ESTADIO->caption() ?><?= $Page->NOM_ESTADIO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_ESTADIO->cellAttributes() ?>>
<span id="el_equipo_NOM_ESTADIO">
<div class="input-group flex-nowrap">
    <select
        id="x_NOM_ESTADIO"
        name="x_NOM_ESTADIO"
        class="form-select ew-select<?= $Page->NOM_ESTADIO->isInvalidClass() ?>"
        data-select2-id="fequipoadd_x_NOM_ESTADIO"
        data-table="equipo"
        data-field="x_NOM_ESTADIO"
        data-value-separator="<?= $Page->NOM_ESTADIO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->NOM_ESTADIO->getPlaceHolder()) ?>"
        <?= $Page->NOM_ESTADIO->editAttributes() ?>>
        <?= $Page->NOM_ESTADIO->selectOptionListHtml("x_NOM_ESTADIO") ?>
    </select>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_NOM_ESTADIO" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->NOM_ESTADIO->caption() ?>" data-title="<?= $Page->NOM_ESTADIO->caption() ?>" data-ew-action="add-option" data-el="x_NOM_ESTADIO" data-url="<?= GetUrl("estadioaddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
</div>
<?= $Page->NOM_ESTADIO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_ESTADIO->getErrorMessage() ?></div>
<?= $Page->NOM_ESTADIO->Lookup->getParamTag($Page, "p_x_NOM_ESTADIO") ?>
<script>
loadjs.ready("fequipoadd", function() {
    var options = { name: "x_NOM_ESTADIO", selectId: "fequipoadd_x_NOM_ESTADIO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipoadd.lists.NOM_ESTADIO?.lookupOptions.length) {
        options.data = { id: "x_NOM_ESTADIO", form: "fequipoadd" };
    } else {
        options.ajax = { id: "x_NOM_ESTADIO", form: "fequipoadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipo.fields.NOM_ESTADIO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fequipoadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fequipoadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
