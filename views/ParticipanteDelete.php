<?php

namespace PHPMaker2023\project11;

// Page object
$ParticipanteDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { participante: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fparticipantedelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fparticipantedelete")
        .setPageId("delete")
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
<form name="fparticipantedelete" id="fparticipantedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="participante">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->ID_PARTICIPANTE->Visible) { // ID_PARTICIPANTE ?>
        <th class="<?= $Page->ID_PARTICIPANTE->headerCellClass() ?>"><span id="elh_participante_ID_PARTICIPANTE" class="participante_ID_PARTICIPANTE"><?= $Page->ID_PARTICIPANTE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NOMBRE->Visible) { // NOMBRE ?>
        <th class="<?= $Page->NOMBRE->headerCellClass() ?>"><span id="elh_participante_NOMBRE" class="participante_NOMBRE"><?= $Page->NOMBRE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->APELLIDO->Visible) { // APELLIDO ?>
        <th class="<?= $Page->APELLIDO->headerCellClass() ?>"><span id="elh_participante_APELLIDO" class="participante_APELLIDO"><?= $Page->APELLIDO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FECHA_NACIMIENTO->Visible) { // FECHA_NACIMIENTO ?>
        <th class="<?= $Page->FECHA_NACIMIENTO->headerCellClass() ?>"><span id="elh_participante_FECHA_NACIMIENTO" class="participante_FECHA_NACIMIENTO"><?= $Page->FECHA_NACIMIENTO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CEDULA->Visible) { // CEDULA ?>
        <th class="<?= $Page->CEDULA->headerCellClass() ?>"><span id="elh_participante_CEDULA" class="participante_CEDULA"><?= $Page->CEDULA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th class="<?= $Page->_EMAIL->headerCellClass() ?>"><span id="elh_participante__EMAIL" class="participante__EMAIL"><?= $Page->_EMAIL->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TELEFONO->Visible) { // TELEFONO ?>
        <th class="<?= $Page->TELEFONO->headerCellClass() ?>"><span id="elh_participante_TELEFONO" class="participante_TELEFONO"><?= $Page->TELEFONO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <th class="<?= $Page->crea_dato->headerCellClass() ?>"><span id="elh_participante_crea_dato" class="participante_crea_dato"><?= $Page->crea_dato->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <th class="<?= $Page->modifica_dato->headerCellClass() ?>"><span id="elh_participante_modifica_dato" class="participante_modifica_dato"><?= $Page->modifica_dato->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->ID_PARTICIPANTE->Visible) { // ID_PARTICIPANTE ?>
        <td<?= $Page->ID_PARTICIPANTE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_ID_PARTICIPANTE" class="el_participante_ID_PARTICIPANTE">
<span<?= $Page->ID_PARTICIPANTE->viewAttributes() ?>>
<?= $Page->ID_PARTICIPANTE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NOMBRE->Visible) { // NOMBRE ?>
        <td<?= $Page->NOMBRE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_NOMBRE" class="el_participante_NOMBRE">
<span<?= $Page->NOMBRE->viewAttributes() ?>>
<?= $Page->NOMBRE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->APELLIDO->Visible) { // APELLIDO ?>
        <td<?= $Page->APELLIDO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_APELLIDO" class="el_participante_APELLIDO">
<span<?= $Page->APELLIDO->viewAttributes() ?>>
<?= $Page->APELLIDO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FECHA_NACIMIENTO->Visible) { // FECHA_NACIMIENTO ?>
        <td<?= $Page->FECHA_NACIMIENTO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_FECHA_NACIMIENTO" class="el_participante_FECHA_NACIMIENTO">
<span<?= $Page->FECHA_NACIMIENTO->viewAttributes() ?>>
<?= $Page->FECHA_NACIMIENTO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CEDULA->Visible) { // CEDULA ?>
        <td<?= $Page->CEDULA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_CEDULA" class="el_participante_CEDULA">
<span<?= $Page->CEDULA->viewAttributes() ?>>
<?= $Page->CEDULA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td<?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante__EMAIL" class="el_participante__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TELEFONO->Visible) { // TELEFONO ?>
        <td<?= $Page->TELEFONO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_TELEFONO" class="el_participante_TELEFONO">
<span<?= $Page->TELEFONO->viewAttributes() ?>>
<?= $Page->TELEFONO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
        <td<?= $Page->crea_dato->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_crea_dato" class="el_participante_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
        <td<?= $Page->modifica_dato->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_participante_modifica_dato" class="el_participante_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<?= $Page->modifica_dato->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
