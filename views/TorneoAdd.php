<?php

namespace PHPMaker2023\project11;

// Page object
$TorneoAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { torneo: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var ftorneoadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftorneoadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["NOM_TORNEO_CORTO", [fields.NOM_TORNEO_CORTO.visible && fields.NOM_TORNEO_CORTO.required ? ew.Validators.required(fields.NOM_TORNEO_CORTO.caption) : null], fields.NOM_TORNEO_CORTO.isInvalid],
            ["NOM_TORNEO_LARGO", [fields.NOM_TORNEO_LARGO.visible && fields.NOM_TORNEO_LARGO.required ? ew.Validators.required(fields.NOM_TORNEO_LARGO.caption) : null], fields.NOM_TORNEO_LARGO.isInvalid],
            ["PAIS_TORNEO", [fields.PAIS_TORNEO.visible && fields.PAIS_TORNEO.required ? ew.Validators.required(fields.PAIS_TORNEO.caption) : null], fields.PAIS_TORNEO.isInvalid],
            ["REGION_TORNEO", [fields.REGION_TORNEO.visible && fields.REGION_TORNEO.required ? ew.Validators.required(fields.REGION_TORNEO.caption) : null], fields.REGION_TORNEO.isInvalid],
            ["DETALLE_TORNEO", [fields.DETALLE_TORNEO.visible && fields.DETALLE_TORNEO.required ? ew.Validators.required(fields.DETALLE_TORNEO.caption) : null], fields.DETALLE_TORNEO.isInvalid],
            ["LOGO_TORNEO", [fields.LOGO_TORNEO.visible && fields.LOGO_TORNEO.required ? ew.Validators.fileRequired(fields.LOGO_TORNEO.caption) : null], fields.LOGO_TORNEO.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftorneoadd" id="ftorneoadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="torneo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NOM_TORNEO_CORTO->Visible) { // NOM_TORNEO_CORTO ?>
    <div id="r_NOM_TORNEO_CORTO"<?= $Page->NOM_TORNEO_CORTO->rowAttributes() ?>>
        <label id="elh_torneo_NOM_TORNEO_CORTO" for="x_NOM_TORNEO_CORTO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_TORNEO_CORTO->caption() ?><?= $Page->NOM_TORNEO_CORTO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_TORNEO_CORTO->cellAttributes() ?>>
<span id="el_torneo_NOM_TORNEO_CORTO">
<textarea data-table="torneo" data-field="x_NOM_TORNEO_CORTO" name="x_NOM_TORNEO_CORTO" id="x_NOM_TORNEO_CORTO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NOM_TORNEO_CORTO->getPlaceHolder()) ?>"<?= $Page->NOM_TORNEO_CORTO->editAttributes() ?> aria-describedby="x_NOM_TORNEO_CORTO_help"><?= $Page->NOM_TORNEO_CORTO->EditValue ?></textarea>
<?= $Page->NOM_TORNEO_CORTO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_TORNEO_CORTO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NOM_TORNEO_LARGO->Visible) { // NOM_TORNEO_LARGO ?>
    <div id="r_NOM_TORNEO_LARGO"<?= $Page->NOM_TORNEO_LARGO->rowAttributes() ?>>
        <label id="elh_torneo_NOM_TORNEO_LARGO" for="x_NOM_TORNEO_LARGO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_TORNEO_LARGO->caption() ?><?= $Page->NOM_TORNEO_LARGO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_TORNEO_LARGO->cellAttributes() ?>>
<span id="el_torneo_NOM_TORNEO_LARGO">
<textarea data-table="torneo" data-field="x_NOM_TORNEO_LARGO" name="x_NOM_TORNEO_LARGO" id="x_NOM_TORNEO_LARGO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->NOM_TORNEO_LARGO->getPlaceHolder()) ?>"<?= $Page->NOM_TORNEO_LARGO->editAttributes() ?> aria-describedby="x_NOM_TORNEO_LARGO_help"><?= $Page->NOM_TORNEO_LARGO->EditValue ?></textarea>
<?= $Page->NOM_TORNEO_LARGO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_TORNEO_LARGO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAIS_TORNEO->Visible) { // PAIS_TORNEO ?>
    <div id="r_PAIS_TORNEO"<?= $Page->PAIS_TORNEO->rowAttributes() ?>>
        <label id="elh_torneo_PAIS_TORNEO" for="x_PAIS_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAIS_TORNEO->caption() ?><?= $Page->PAIS_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PAIS_TORNEO->cellAttributes() ?>>
<span id="el_torneo_PAIS_TORNEO">
<textarea data-table="torneo" data-field="x_PAIS_TORNEO" name="x_PAIS_TORNEO" id="x_PAIS_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->PAIS_TORNEO->getPlaceHolder()) ?>"<?= $Page->PAIS_TORNEO->editAttributes() ?> aria-describedby="x_PAIS_TORNEO_help"><?= $Page->PAIS_TORNEO->EditValue ?></textarea>
<?= $Page->PAIS_TORNEO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAIS_TORNEO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REGION_TORNEO->Visible) { // REGION_TORNEO ?>
    <div id="r_REGION_TORNEO"<?= $Page->REGION_TORNEO->rowAttributes() ?>>
        <label id="elh_torneo_REGION_TORNEO" for="x_REGION_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REGION_TORNEO->caption() ?><?= $Page->REGION_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->REGION_TORNEO->cellAttributes() ?>>
<span id="el_torneo_REGION_TORNEO">
<textarea data-table="torneo" data-field="x_REGION_TORNEO" name="x_REGION_TORNEO" id="x_REGION_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->REGION_TORNEO->getPlaceHolder()) ?>"<?= $Page->REGION_TORNEO->editAttributes() ?> aria-describedby="x_REGION_TORNEO_help"><?= $Page->REGION_TORNEO->EditValue ?></textarea>
<?= $Page->REGION_TORNEO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->REGION_TORNEO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DETALLE_TORNEO->Visible) { // DETALLE_TORNEO ?>
    <div id="r_DETALLE_TORNEO"<?= $Page->DETALLE_TORNEO->rowAttributes() ?>>
        <label id="elh_torneo_DETALLE_TORNEO" for="x_DETALLE_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DETALLE_TORNEO->caption() ?><?= $Page->DETALLE_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DETALLE_TORNEO->cellAttributes() ?>>
<span id="el_torneo_DETALLE_TORNEO">
<textarea data-table="torneo" data-field="x_DETALLE_TORNEO" name="x_DETALLE_TORNEO" id="x_DETALLE_TORNEO" cols="35" rows="1" placeholder="<?= HtmlEncode($Page->DETALLE_TORNEO->getPlaceHolder()) ?>"<?= $Page->DETALLE_TORNEO->editAttributes() ?> aria-describedby="x_DETALLE_TORNEO_help"><?= $Page->DETALLE_TORNEO->EditValue ?></textarea>
<?= $Page->DETALLE_TORNEO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DETALLE_TORNEO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LOGO_TORNEO->Visible) { // LOGO_TORNEO ?>
    <div id="r_LOGO_TORNEO"<?= $Page->LOGO_TORNEO->rowAttributes() ?>>
        <label id="elh_torneo_LOGO_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LOGO_TORNEO->caption() ?><?= $Page->LOGO_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->LOGO_TORNEO->cellAttributes() ?>>
<span id="el_torneo_LOGO_TORNEO">
<div id="fd_x_LOGO_TORNEO" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_LOGO_TORNEO"
        name="x_LOGO_TORNEO"
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
        aria-describedby="x_LOGO_TORNEO_help"
        <?= ($Page->LOGO_TORNEO->ReadOnly || $Page->LOGO_TORNEO->Disabled) ? " disabled" : "" ?>
        <?= $Page->LOGO_TORNEO->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->LOGO_TORNEO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LOGO_TORNEO->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_LOGO_TORNEO" id= "fn_x_LOGO_TORNEO" value="<?= $Page->LOGO_TORNEO->Upload->FileName ?>">
<input type="hidden" name="fa_x_LOGO_TORNEO" id= "fa_x_LOGO_TORNEO" value="0">
<table id="ft_x_LOGO_TORNEO" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftorneoadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftorneoadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("torneo");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
