<?php

namespace PHPMaker2022\project1;

// Page object
$EquipoAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipo: currentTable } });
var currentForm, currentPageID;
var fequipoadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fequipoadd = new ew.Form("fequipoadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fequipoadd;

    // Add fields
    var fields = currentTable.fields;
    fequipoadd.addFields([
        ["NOM_EQUIPO_CORTO", [fields.NOM_EQUIPO_CORTO.visible && fields.NOM_EQUIPO_CORTO.required ? ew.Validators.required(fields.NOM_EQUIPO_CORTO.caption) : null], fields.NOM_EQUIPO_CORTO.isInvalid],
        ["NOM_EQUIPO_LARGO", [fields.NOM_EQUIPO_LARGO.visible && fields.NOM_EQUIPO_LARGO.required ? ew.Validators.required(fields.NOM_EQUIPO_LARGO.caption) : null], fields.NOM_EQUIPO_LARGO.isInvalid],
        ["PAIS_EQUIPO", [fields.PAIS_EQUIPO.visible && fields.PAIS_EQUIPO.required ? ew.Validators.required(fields.PAIS_EQUIPO.caption) : null], fields.PAIS_EQUIPO.isInvalid],
        ["REGION_EQUIPO", [fields.REGION_EQUIPO.visible && fields.REGION_EQUIPO.required ? ew.Validators.required(fields.REGION_EQUIPO.caption) : null], fields.REGION_EQUIPO.isInvalid],
        ["DETALLE_EQUIPO", [fields.DETALLE_EQUIPO.visible && fields.DETALLE_EQUIPO.required ? ew.Validators.required(fields.DETALLE_EQUIPO.caption) : null], fields.DETALLE_EQUIPO.isInvalid],
        ["NOM_ESTADIO", [fields.NOM_ESTADIO.visible && fields.NOM_ESTADIO.required ? ew.Validators.required(fields.NOM_ESTADIO.caption) : null], fields.NOM_ESTADIO.isInvalid]
    ]);

    // Form_CustomValidate
    fequipoadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fequipoadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fequipoadd");
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
<form name="fequipoadd" id="fequipoadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="equipo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NOM_EQUIPO_CORTO->Visible) { // NOM_EQUIPO_CORTO ?>
    <div id="r_NOM_EQUIPO_CORTO"<?= $Page->NOM_EQUIPO_CORTO->rowAttributes() ?>>
        <label id="elh_equipo_NOM_EQUIPO_CORTO" for="x_NOM_EQUIPO_CORTO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_EQUIPO_CORTO->caption() ?><?= $Page->NOM_EQUIPO_CORTO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_EQUIPO_CORTO->cellAttributes() ?>>
<span id="el_equipo_NOM_EQUIPO_CORTO">
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_CORTO" name="x_NOM_EQUIPO_CORTO" id="x_NOM_EQUIPO_CORTO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_CORTO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_CORTO->editAttributes() ?> aria-describedby="x_NOM_EQUIPO_CORTO_help"><?= $Page->NOM_EQUIPO_CORTO->EditValue ?></textarea>
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
<textarea data-table="equipo" data-field="x_NOM_EQUIPO_LARGO" name="x_NOM_EQUIPO_LARGO" id="x_NOM_EQUIPO_LARGO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NOM_EQUIPO_LARGO->getPlaceHolder()) ?>"<?= $Page->NOM_EQUIPO_LARGO->editAttributes() ?> aria-describedby="x_NOM_EQUIPO_LARGO_help"><?= $Page->NOM_EQUIPO_LARGO->EditValue ?></textarea>
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
<textarea data-table="equipo" data-field="x_PAIS_EQUIPO" name="x_PAIS_EQUIPO" id="x_PAIS_EQUIPO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->PAIS_EQUIPO->getPlaceHolder()) ?>"<?= $Page->PAIS_EQUIPO->editAttributes() ?> aria-describedby="x_PAIS_EQUIPO_help"><?= $Page->PAIS_EQUIPO->EditValue ?></textarea>
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
<textarea data-table="equipo" data-field="x_REGION_EQUIPO" name="x_REGION_EQUIPO" id="x_REGION_EQUIPO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->REGION_EQUIPO->getPlaceHolder()) ?>"<?= $Page->REGION_EQUIPO->editAttributes() ?> aria-describedby="x_REGION_EQUIPO_help"><?= $Page->REGION_EQUIPO->EditValue ?></textarea>
<?= $Page->REGION_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->REGION_EQUIPO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DETALLE_EQUIPO->Visible) { // DETALLE_EQUIPO ?>
    <div id="r_DETALLE_EQUIPO"<?= $Page->DETALLE_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipo_DETALLE_EQUIPO" for="x_DETALLE_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DETALLE_EQUIPO->caption() ?><?= $Page->DETALLE_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->DETALLE_EQUIPO->cellAttributes() ?>>
<span id="el_equipo_DETALLE_EQUIPO">
<textarea data-table="equipo" data-field="x_DETALLE_EQUIPO" name="x_DETALLE_EQUIPO" id="x_DETALLE_EQUIPO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->DETALLE_EQUIPO->getPlaceHolder()) ?>"<?= $Page->DETALLE_EQUIPO->editAttributes() ?> aria-describedby="x_DETALLE_EQUIPO_help"><?= $Page->DETALLE_EQUIPO->EditValue ?></textarea>
<?= $Page->DETALLE_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DETALLE_EQUIPO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NOM_ESTADIO->Visible) { // NOM_ESTADIO ?>
    <div id="r_NOM_ESTADIO"<?= $Page->NOM_ESTADIO->rowAttributes() ?>>
        <label id="elh_equipo_NOM_ESTADIO" for="x_NOM_ESTADIO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NOM_ESTADIO->caption() ?><?= $Page->NOM_ESTADIO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NOM_ESTADIO->cellAttributes() ?>>
<span id="el_equipo_NOM_ESTADIO">
<textarea data-table="equipo" data-field="x_NOM_ESTADIO" name="x_NOM_ESTADIO" id="x_NOM_ESTADIO" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->NOM_ESTADIO->getPlaceHolder()) ?>"<?= $Page->NOM_ESTADIO->editAttributes() ?> aria-describedby="x_NOM_ESTADIO_help"><?= $Page->NOM_ESTADIO->EditValue ?></textarea>
<?= $Page->NOM_ESTADIO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NOM_ESTADIO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
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
