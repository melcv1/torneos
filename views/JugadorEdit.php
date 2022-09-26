<?php

namespace PHPMaker2023\project11;

// Page object
$JugadorEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fjugadoredit" id="fjugadoredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jugador: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fjugadoredit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fjugadoredit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id_jugador", [fields.id_jugador.visible && fields.id_jugador.required ? ew.Validators.required(fields.id_jugador.caption) : null], fields.id_jugador.isInvalid],
            ["nombre_jugador", [fields.nombre_jugador.visible && fields.nombre_jugador.required ? ew.Validators.required(fields.nombre_jugador.caption) : null], fields.nombre_jugador.isInvalid],
            ["votos_jugador", [fields.votos_jugador.visible && fields.votos_jugador.required ? ew.Validators.required(fields.votos_jugador.caption) : null], fields.votos_jugador.isInvalid],
            ["imagen_jugador", [fields.imagen_jugador.visible && fields.imagen_jugador.required ? ew.Validators.fileRequired(fields.imagen_jugador.caption) : null], fields.imagen_jugador.isInvalid],
            ["posicion", [fields.posicion.visible && fields.posicion.required ? ew.Validators.required(fields.posicion.caption) : null], fields.posicion.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jugador">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_jugador->Visible) { // id_jugador ?>
    <div id="r_id_jugador"<?= $Page->id_jugador->rowAttributes() ?>>
        <label id="elh_jugador_id_jugador" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_jugador->caption() ?><?= $Page->id_jugador->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id_jugador->cellAttributes() ?>>
<span id="el_jugador_id_jugador">
<span<?= $Page->id_jugador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_jugador->getDisplayValue($Page->id_jugador->EditValue))) ?>"></span>
<input type="hidden" data-table="jugador" data-field="x_id_jugador" data-hidden="1" name="x_id_jugador" id="x_id_jugador" value="<?= HtmlEncode($Page->id_jugador->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nombre_jugador->Visible) { // nombre_jugador ?>
    <div id="r_nombre_jugador"<?= $Page->nombre_jugador->rowAttributes() ?>>
        <label id="elh_jugador_nombre_jugador" for="x_nombre_jugador" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombre_jugador->caption() ?><?= $Page->nombre_jugador->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nombre_jugador->cellAttributes() ?>>
<span id="el_jugador_nombre_jugador">
<textarea data-table="jugador" data-field="x_nombre_jugador" name="x_nombre_jugador" id="x_nombre_jugador" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->nombre_jugador->getPlaceHolder()) ?>"<?= $Page->nombre_jugador->editAttributes() ?> aria-describedby="x_nombre_jugador_help"><?= $Page->nombre_jugador->EditValue ?></textarea>
<?= $Page->nombre_jugador->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombre_jugador->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->votos_jugador->Visible) { // votos_jugador ?>
    <div id="r_votos_jugador"<?= $Page->votos_jugador->rowAttributes() ?>>
        <label id="elh_jugador_votos_jugador" for="x_votos_jugador" class="<?= $Page->LeftColumnClass ?>"><?= $Page->votos_jugador->caption() ?><?= $Page->votos_jugador->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->votos_jugador->cellAttributes() ?>>
<span id="el_jugador_votos_jugador">
<textarea data-table="jugador" data-field="x_votos_jugador" name="x_votos_jugador" id="x_votos_jugador" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->votos_jugador->getPlaceHolder()) ?>"<?= $Page->votos_jugador->editAttributes() ?> aria-describedby="x_votos_jugador_help"><?= $Page->votos_jugador->EditValue ?></textarea>
<?= $Page->votos_jugador->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->votos_jugador->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->imagen_jugador->Visible) { // imagen_jugador ?>
    <div id="r_imagen_jugador"<?= $Page->imagen_jugador->rowAttributes() ?>>
        <label id="elh_jugador_imagen_jugador" class="<?= $Page->LeftColumnClass ?>"><?= $Page->imagen_jugador->caption() ?><?= $Page->imagen_jugador->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->imagen_jugador->cellAttributes() ?>>
<span id="el_jugador_imagen_jugador">
<div id="fd_x_imagen_jugador" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_imagen_jugador"
        name="x_imagen_jugador"
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
        aria-describedby="x_imagen_jugador_help"
        <?= ($Page->imagen_jugador->ReadOnly || $Page->imagen_jugador->Disabled) ? " disabled" : "" ?>
        <?= $Page->imagen_jugador->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->imagen_jugador->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->imagen_jugador->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_imagen_jugador" id= "fn_x_imagen_jugador" value="<?= $Page->imagen_jugador->Upload->FileName ?>">
<input type="hidden" name="fa_x_imagen_jugador" id= "fa_x_imagen_jugador" value="<?= (Post("fa_x_imagen_jugador") == "0") ? "0" : "1" ?>">
<table id="ft_x_imagen_jugador" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->posicion->Visible) { // posicion ?>
    <div id="r_posicion"<?= $Page->posicion->rowAttributes() ?>>
        <label id="elh_jugador_posicion" for="x_posicion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->posicion->caption() ?><?= $Page->posicion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->posicion->cellAttributes() ?>>
<span id="el_jugador_posicion">
<input type="<?= $Page->posicion->getInputTextType() ?>" name="x_posicion" id="x_posicion" data-table="jugador" data-field="x_posicion" value="<?= $Page->posicion->EditValue ?>" size="30" maxlength="56" placeholder="<?= HtmlEncode($Page->posicion->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->posicion->formatPattern()) ?>"<?= $Page->posicion->editAttributes() ?> aria-describedby="x_posicion_help">
<?= $Page->posicion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->posicion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fjugadoredit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fjugadoredit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
