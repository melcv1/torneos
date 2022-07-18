<?php

namespace PHPMaker2022\project1;

// Page object
$UsuarioView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { usuario: currentTable } });
var currentForm, currentPageID;
var fusuarioview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fusuarioview = new ew.Form("fusuarioview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fusuarioview;
    loadjs.done("fusuarioview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->ID_USUARIO->Visible) { // ID_USUARIO ?>
    <tr id="r_ID_USUARIO"<?= $Page->ID_USUARIO->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_ID_USUARIO"><?= $Page->ID_USUARIO->caption() ?></span></td>
        <td data-name="ID_USUARIO"<?= $Page->ID_USUARIO->cellAttributes() ?>>
<span id="el_usuario_ID_USUARIO">
<span<?= $Page->ID_USUARIO->viewAttributes() ?>>
<?= $Page->ID_USUARIO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->USER->Visible) { // USER ?>
    <tr id="r_USER"<?= $Page->USER->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_USER"><?= $Page->USER->caption() ?></span></td>
        <td data-name="USER"<?= $Page->USER->cellAttributes() ?>>
<span id="el_usuario_USER">
<span<?= $Page->USER->viewAttributes() ?>>
<?= $Page->USER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CONTRASENA->Visible) { // CONTRASENA ?>
    <tr id="r_CONTRASENA"<?= $Page->CONTRASENA->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_CONTRASENA"><?= $Page->CONTRASENA->caption() ?></span></td>
        <td data-name="CONTRASENA"<?= $Page->CONTRASENA->cellAttributes() ?>>
<span id="el_usuario_CONTRASENA">
<span<?= $Page->CONTRASENA->viewAttributes() ?>>
<?= $Page->CONTRASENA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombre->Visible) { // nombre ?>
    <tr id="r_nombre"<?= $Page->nombre->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_nombre"><?= $Page->nombre->caption() ?></span></td>
        <td data-name="nombre"<?= $Page->nombre->cellAttributes() ?>>
<span id="el_usuario_nombre">
<span<?= $Page->nombre->viewAttributes() ?>>
<?= $Page->nombre->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->crea_dato->Visible) { // crea_dato ?>
    <tr id="r_crea_dato"<?= $Page->crea_dato->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_crea_dato"><?= $Page->crea_dato->caption() ?></span></td>
        <td data-name="crea_dato"<?= $Page->crea_dato->cellAttributes() ?>>
<span id="el_usuario_crea_dato">
<span<?= $Page->crea_dato->viewAttributes() ?>>
<?= $Page->crea_dato->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifica_dato->Visible) { // modifica_dato ?>
    <tr id="r_modifica_dato"<?= $Page->modifica_dato->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuario_modifica_dato"><?= $Page->modifica_dato->caption() ?></span></td>
        <td data-name="modifica_dato"<?= $Page->modifica_dato->cellAttributes() ?>>
<span id="el_usuario_modifica_dato">
<span<?= $Page->modifica_dato->viewAttributes() ?>>
<?= $Page->modifica_dato->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
