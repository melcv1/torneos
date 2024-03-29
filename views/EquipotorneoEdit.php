<?php

namespace PHPMaker2023\project11;

// Page object
$EquipotorneoEdit = &$Page;
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
<form name="fequipotorneoedit" id="fequipotorneoedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipotorneo: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fequipotorneoedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fequipotorneoedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["ID_EQUIPO_TORNEO", [fields.ID_EQUIPO_TORNEO.visible && fields.ID_EQUIPO_TORNEO.required ? ew.Validators.required(fields.ID_EQUIPO_TORNEO.caption) : null], fields.ID_EQUIPO_TORNEO.isInvalid],
            ["ID_TORNEO", [fields.ID_TORNEO.visible && fields.ID_TORNEO.required ? ew.Validators.required(fields.ID_TORNEO.caption) : null], fields.ID_TORNEO.isInvalid],
            ["ID_EQUIPO", [fields.ID_EQUIPO.visible && fields.ID_EQUIPO.required ? ew.Validators.required(fields.ID_EQUIPO.caption) : null], fields.ID_EQUIPO.isInvalid],
            ["PARTIDOS_JUGADOS", [fields.PARTIDOS_JUGADOS.visible && fields.PARTIDOS_JUGADOS.required ? ew.Validators.required(fields.PARTIDOS_JUGADOS.caption) : null, ew.Validators.integer], fields.PARTIDOS_JUGADOS.isInvalid],
            ["PARTIDOS_GANADOS", [fields.PARTIDOS_GANADOS.visible && fields.PARTIDOS_GANADOS.required ? ew.Validators.required(fields.PARTIDOS_GANADOS.caption) : null, ew.Validators.integer], fields.PARTIDOS_GANADOS.isInvalid],
            ["PARTIDOS_EMPATADOS", [fields.PARTIDOS_EMPATADOS.visible && fields.PARTIDOS_EMPATADOS.required ? ew.Validators.required(fields.PARTIDOS_EMPATADOS.caption) : null, ew.Validators.integer], fields.PARTIDOS_EMPATADOS.isInvalid],
            ["PARTIDOS_PERDIDOS", [fields.PARTIDOS_PERDIDOS.visible && fields.PARTIDOS_PERDIDOS.required ? ew.Validators.required(fields.PARTIDOS_PERDIDOS.caption) : null, ew.Validators.integer], fields.PARTIDOS_PERDIDOS.isInvalid],
            ["GF", [fields.GF.visible && fields.GF.required ? ew.Validators.required(fields.GF.caption) : null, ew.Validators.integer], fields.GF.isInvalid],
            ["GC", [fields.GC.visible && fields.GC.required ? ew.Validators.required(fields.GC.caption) : null, ew.Validators.integer], fields.GC.isInvalid],
            ["GD", [fields.GD.visible && fields.GD.required ? ew.Validators.required(fields.GD.caption) : null, ew.Validators.integer], fields.GD.isInvalid],
            ["GRUPO", [fields.GRUPO.visible && fields.GRUPO.required ? ew.Validators.required(fields.GRUPO.caption) : null], fields.GRUPO.isInvalid],
            ["POSICION_EQUIPO_TORENO", [fields.POSICION_EQUIPO_TORENO.visible && fields.POSICION_EQUIPO_TORENO.required ? ew.Validators.required(fields.POSICION_EQUIPO_TORENO.caption) : null], fields.POSICION_EQUIPO_TORENO.isInvalid],
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
            "ID_TORNEO": <?= $Page->ID_TORNEO->toClientList($Page) ?>,
            "ID_EQUIPO": <?= $Page->ID_EQUIPO->toClientList($Page) ?>,
            "GRUPO": <?= $Page->GRUPO->toClientList($Page) ?>,
            "POSICION_EQUIPO_TORENO": <?= $Page->POSICION_EQUIPO_TORENO->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="equipotorneo">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ID_EQUIPO_TORNEO->Visible) { // ID_EQUIPO_TORNEO ?>
    <div id="r_ID_EQUIPO_TORNEO"<?= $Page->ID_EQUIPO_TORNEO->rowAttributes() ?>>
        <label id="elh_equipotorneo_ID_EQUIPO_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID_EQUIPO_TORNEO->caption() ?><?= $Page->ID_EQUIPO_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ID_EQUIPO_TORNEO->cellAttributes() ?>>
<span id="el_equipotorneo_ID_EQUIPO_TORNEO">
<span<?= $Page->ID_EQUIPO_TORNEO->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID_EQUIPO_TORNEO->getDisplayValue($Page->ID_EQUIPO_TORNEO->EditValue))) ?>"></span>
<input type="hidden" data-table="equipotorneo" data-field="x_ID_EQUIPO_TORNEO" data-hidden="1" name="x_ID_EQUIPO_TORNEO" id="x_ID_EQUIPO_TORNEO" value="<?= HtmlEncode($Page->ID_EQUIPO_TORNEO->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ID_TORNEO->Visible) { // ID_TORNEO ?>
    <div id="r_ID_TORNEO"<?= $Page->ID_TORNEO->rowAttributes() ?>>
        <label id="elh_equipotorneo_ID_TORNEO" for="x_ID_TORNEO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID_TORNEO->caption() ?><?= $Page->ID_TORNEO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ID_TORNEO->cellAttributes() ?>>
<span id="el_equipotorneo_ID_TORNEO">
    <select
        id="x_ID_TORNEO"
        name="x_ID_TORNEO"
        class="form-select ew-select<?= $Page->ID_TORNEO->isInvalidClass() ?>"
        data-select2-id="fequipotorneoedit_x_ID_TORNEO"
        data-table="equipotorneo"
        data-field="x_ID_TORNEO"
        data-value-separator="<?= $Page->ID_TORNEO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ID_TORNEO->getPlaceHolder()) ?>"
        <?= $Page->ID_TORNEO->editAttributes() ?>>
        <?= $Page->ID_TORNEO->selectOptionListHtml("x_ID_TORNEO") ?>
    </select>
    <?= $Page->ID_TORNEO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ID_TORNEO->getErrorMessage() ?></div>
<?= $Page->ID_TORNEO->Lookup->getParamTag($Page, "p_x_ID_TORNEO") ?>
<script>
loadjs.ready("fequipotorneoedit", function() {
    var options = { name: "x_ID_TORNEO", selectId: "fequipotorneoedit_x_ID_TORNEO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipotorneoedit.lists.ID_TORNEO?.lookupOptions.length) {
        options.data = { id: "x_ID_TORNEO", form: "fequipotorneoedit" };
    } else {
        options.ajax = { id: "x_ID_TORNEO", form: "fequipotorneoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipotorneo.fields.ID_TORNEO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ID_EQUIPO->Visible) { // ID_EQUIPO ?>
    <div id="r_ID_EQUIPO"<?= $Page->ID_EQUIPO->rowAttributes() ?>>
        <label id="elh_equipotorneo_ID_EQUIPO" for="x_ID_EQUIPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID_EQUIPO->caption() ?><?= $Page->ID_EQUIPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ID_EQUIPO->cellAttributes() ?>>
<span id="el_equipotorneo_ID_EQUIPO">
<div class="input-group flex-nowrap">
    <select
        id="x_ID_EQUIPO"
        name="x_ID_EQUIPO"
        class="form-select ew-select<?= $Page->ID_EQUIPO->isInvalidClass() ?>"
        data-select2-id="fequipotorneoedit_x_ID_EQUIPO"
        data-table="equipotorneo"
        data-field="x_ID_EQUIPO"
        data-value-separator="<?= $Page->ID_EQUIPO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ID_EQUIPO->getPlaceHolder()) ?>"
        <?= $Page->ID_EQUIPO->editAttributes() ?>>
        <?= $Page->ID_EQUIPO->selectOptionListHtml("x_ID_EQUIPO") ?>
    </select>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_ID_EQUIPO" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->ID_EQUIPO->caption() ?>" data-title="<?= $Page->ID_EQUIPO->caption() ?>" data-ew-action="add-option" data-el="x_ID_EQUIPO" data-url="<?= GetUrl("equipoaddopt") ?>"><i class="fa-solid fa-plus ew-icon"></i></button>
</div>
<?= $Page->ID_EQUIPO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ID_EQUIPO->getErrorMessage() ?></div>
<?= $Page->ID_EQUIPO->Lookup->getParamTag($Page, "p_x_ID_EQUIPO") ?>
<script>
loadjs.ready("fequipotorneoedit", function() {
    var options = { name: "x_ID_EQUIPO", selectId: "fequipotorneoedit_x_ID_EQUIPO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipotorneoedit.lists.ID_EQUIPO?.lookupOptions.length) {
        options.data = { id: "x_ID_EQUIPO", form: "fequipotorneoedit" };
    } else {
        options.ajax = { id: "x_ID_EQUIPO", form: "fequipotorneoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipotorneo.fields.ID_EQUIPO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PARTIDOS_JUGADOS->Visible) { // PARTIDOS_JUGADOS ?>
    <div id="r_PARTIDOS_JUGADOS"<?= $Page->PARTIDOS_JUGADOS->rowAttributes() ?>>
        <label id="elh_equipotorneo_PARTIDOS_JUGADOS" for="x_PARTIDOS_JUGADOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PARTIDOS_JUGADOS->caption() ?><?= $Page->PARTIDOS_JUGADOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PARTIDOS_JUGADOS->cellAttributes() ?>>
<span id="el_equipotorneo_PARTIDOS_JUGADOS">
<input type="<?= $Page->PARTIDOS_JUGADOS->getInputTextType() ?>" name="x_PARTIDOS_JUGADOS" id="x_PARTIDOS_JUGADOS" data-table="equipotorneo" data-field="x_PARTIDOS_JUGADOS" value="<?= $Page->PARTIDOS_JUGADOS->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->PARTIDOS_JUGADOS->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->PARTIDOS_JUGADOS->formatPattern()) ?>"<?= $Page->PARTIDOS_JUGADOS->editAttributes() ?> aria-describedby="x_PARTIDOS_JUGADOS_help">
<?= $Page->PARTIDOS_JUGADOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PARTIDOS_JUGADOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PARTIDOS_GANADOS->Visible) { // PARTIDOS_GANADOS ?>
    <div id="r_PARTIDOS_GANADOS"<?= $Page->PARTIDOS_GANADOS->rowAttributes() ?>>
        <label id="elh_equipotorneo_PARTIDOS_GANADOS" for="x_PARTIDOS_GANADOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PARTIDOS_GANADOS->caption() ?><?= $Page->PARTIDOS_GANADOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PARTIDOS_GANADOS->cellAttributes() ?>>
<span id="el_equipotorneo_PARTIDOS_GANADOS">
<input type="<?= $Page->PARTIDOS_GANADOS->getInputTextType() ?>" name="x_PARTIDOS_GANADOS" id="x_PARTIDOS_GANADOS" data-table="equipotorneo" data-field="x_PARTIDOS_GANADOS" value="<?= $Page->PARTIDOS_GANADOS->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->PARTIDOS_GANADOS->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->PARTIDOS_GANADOS->formatPattern()) ?>"<?= $Page->PARTIDOS_GANADOS->editAttributes() ?> aria-describedby="x_PARTIDOS_GANADOS_help">
<?= $Page->PARTIDOS_GANADOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PARTIDOS_GANADOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PARTIDOS_EMPATADOS->Visible) { // PARTIDOS_EMPATADOS ?>
    <div id="r_PARTIDOS_EMPATADOS"<?= $Page->PARTIDOS_EMPATADOS->rowAttributes() ?>>
        <label id="elh_equipotorneo_PARTIDOS_EMPATADOS" for="x_PARTIDOS_EMPATADOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PARTIDOS_EMPATADOS->caption() ?><?= $Page->PARTIDOS_EMPATADOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PARTIDOS_EMPATADOS->cellAttributes() ?>>
<span id="el_equipotorneo_PARTIDOS_EMPATADOS">
<input type="<?= $Page->PARTIDOS_EMPATADOS->getInputTextType() ?>" name="x_PARTIDOS_EMPATADOS" id="x_PARTIDOS_EMPATADOS" data-table="equipotorneo" data-field="x_PARTIDOS_EMPATADOS" value="<?= $Page->PARTIDOS_EMPATADOS->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->PARTIDOS_EMPATADOS->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->PARTIDOS_EMPATADOS->formatPattern()) ?>"<?= $Page->PARTIDOS_EMPATADOS->editAttributes() ?> aria-describedby="x_PARTIDOS_EMPATADOS_help">
<?= $Page->PARTIDOS_EMPATADOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PARTIDOS_EMPATADOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PARTIDOS_PERDIDOS->Visible) { // PARTIDOS_PERDIDOS ?>
    <div id="r_PARTIDOS_PERDIDOS"<?= $Page->PARTIDOS_PERDIDOS->rowAttributes() ?>>
        <label id="elh_equipotorneo_PARTIDOS_PERDIDOS" for="x_PARTIDOS_PERDIDOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PARTIDOS_PERDIDOS->caption() ?><?= $Page->PARTIDOS_PERDIDOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->PARTIDOS_PERDIDOS->cellAttributes() ?>>
<span id="el_equipotorneo_PARTIDOS_PERDIDOS">
<input type="<?= $Page->PARTIDOS_PERDIDOS->getInputTextType() ?>" name="x_PARTIDOS_PERDIDOS" id="x_PARTIDOS_PERDIDOS" data-table="equipotorneo" data-field="x_PARTIDOS_PERDIDOS" value="<?= $Page->PARTIDOS_PERDIDOS->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->PARTIDOS_PERDIDOS->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->PARTIDOS_PERDIDOS->formatPattern()) ?>"<?= $Page->PARTIDOS_PERDIDOS->editAttributes() ?> aria-describedby="x_PARTIDOS_PERDIDOS_help">
<?= $Page->PARTIDOS_PERDIDOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PARTIDOS_PERDIDOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GF->Visible) { // GF ?>
    <div id="r_GF"<?= $Page->GF->rowAttributes() ?>>
        <label id="elh_equipotorneo_GF" for="x_GF" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GF->caption() ?><?= $Page->GF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->GF->cellAttributes() ?>>
<span id="el_equipotorneo_GF">
<input type="<?= $Page->GF->getInputTextType() ?>" name="x_GF" id="x_GF" data-table="equipotorneo" data-field="x_GF" value="<?= $Page->GF->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->GF->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->GF->formatPattern()) ?>"<?= $Page->GF->editAttributes() ?> aria-describedby="x_GF_help">
<?= $Page->GF->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GF->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GC->Visible) { // GC ?>
    <div id="r_GC"<?= $Page->GC->rowAttributes() ?>>
        <label id="elh_equipotorneo_GC" for="x_GC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GC->caption() ?><?= $Page->GC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->GC->cellAttributes() ?>>
<span id="el_equipotorneo_GC">
<input type="<?= $Page->GC->getInputTextType() ?>" name="x_GC" id="x_GC" data-table="equipotorneo" data-field="x_GC" value="<?= $Page->GC->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->GC->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->GC->formatPattern()) ?>"<?= $Page->GC->editAttributes() ?> aria-describedby="x_GC_help">
<?= $Page->GC->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GC->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GD->Visible) { // GD ?>
    <div id="r_GD"<?= $Page->GD->rowAttributes() ?>>
        <label id="elh_equipotorneo_GD" for="x_GD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GD->caption() ?><?= $Page->GD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->GD->cellAttributes() ?>>
<span id="el_equipotorneo_GD">
<input type="<?= $Page->GD->getInputTextType() ?>" name="x_GD" id="x_GD" data-table="equipotorneo" data-field="x_GD" value="<?= $Page->GD->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->GD->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->GD->formatPattern()) ?>"<?= $Page->GD->editAttributes() ?> aria-describedby="x_GD_help">
<?= $Page->GD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GD->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GRUPO->Visible) { // GRUPO ?>
    <div id="r_GRUPO"<?= $Page->GRUPO->rowAttributes() ?>>
        <label id="elh_equipotorneo_GRUPO" for="x_GRUPO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GRUPO->caption() ?><?= $Page->GRUPO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->GRUPO->cellAttributes() ?>>
<span id="el_equipotorneo_GRUPO">
    <select
        id="x_GRUPO"
        name="x_GRUPO"
        class="form-select ew-select<?= $Page->GRUPO->isInvalidClass() ?>"
        data-select2-id="fequipotorneoedit_x_GRUPO"
        data-table="equipotorneo"
        data-field="x_GRUPO"
        data-value-separator="<?= $Page->GRUPO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->GRUPO->getPlaceHolder()) ?>"
        <?= $Page->GRUPO->editAttributes() ?>>
        <?= $Page->GRUPO->selectOptionListHtml("x_GRUPO") ?>
    </select>
    <?= $Page->GRUPO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->GRUPO->getErrorMessage() ?></div>
<script>
loadjs.ready("fequipotorneoedit", function() {
    var options = { name: "x_GRUPO", selectId: "fequipotorneoedit_x_GRUPO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipotorneoedit.lists.GRUPO?.lookupOptions.length) {
        options.data = { id: "x_GRUPO", form: "fequipotorneoedit" };
    } else {
        options.ajax = { id: "x_GRUPO", form: "fequipotorneoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipotorneo.fields.GRUPO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->POSICION_EQUIPO_TORENO->Visible) { // POSICION_EQUIPO_TORENO ?>
    <div id="r_POSICION_EQUIPO_TORENO"<?= $Page->POSICION_EQUIPO_TORENO->rowAttributes() ?>>
        <label id="elh_equipotorneo_POSICION_EQUIPO_TORENO" for="x_POSICION_EQUIPO_TORENO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->POSICION_EQUIPO_TORENO->caption() ?><?= $Page->POSICION_EQUIPO_TORENO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->POSICION_EQUIPO_TORENO->cellAttributes() ?>>
<span id="el_equipotorneo_POSICION_EQUIPO_TORENO">
    <select
        id="x_POSICION_EQUIPO_TORENO"
        name="x_POSICION_EQUIPO_TORENO"
        class="form-select ew-select<?= $Page->POSICION_EQUIPO_TORENO->isInvalidClass() ?>"
        data-select2-id="fequipotorneoedit_x_POSICION_EQUIPO_TORENO"
        data-table="equipotorneo"
        data-field="x_POSICION_EQUIPO_TORENO"
        data-value-separator="<?= $Page->POSICION_EQUIPO_TORENO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->POSICION_EQUIPO_TORENO->getPlaceHolder()) ?>"
        <?= $Page->POSICION_EQUIPO_TORENO->editAttributes() ?>>
        <?= $Page->POSICION_EQUIPO_TORENO->selectOptionListHtml("x_POSICION_EQUIPO_TORENO") ?>
    </select>
    <?= $Page->POSICION_EQUIPO_TORENO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->POSICION_EQUIPO_TORENO->getErrorMessage() ?></div>
<script>
loadjs.ready("fequipotorneoedit", function() {
    var options = { name: "x_POSICION_EQUIPO_TORENO", selectId: "fequipotorneoedit_x_POSICION_EQUIPO_TORENO" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fequipotorneoedit.lists.POSICION_EQUIPO_TORENO?.lookupOptions.length) {
        options.data = { id: "x_POSICION_EQUIPO_TORENO", form: "fequipotorneoedit" };
    } else {
        options.ajax = { id: "x_POSICION_EQUIPO_TORENO", form: "fequipotorneoedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.equipotorneo.fields.POSICION_EQUIPO_TORENO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<span id="el_equipotorneo_crea_dato">
<input type="hidden" data-table="equipotorneo" data-field="x_crea_dato" data-hidden="1" name="x_crea_dato" id="x_crea_dato" value="<?= HtmlEncode($Page->crea_dato->CurrentValue) ?>">
</span>
<span id="el_equipotorneo_modifica_dato">
<input type="hidden" data-table="equipotorneo" data-field="x_modifica_dato" data-hidden="1" name="x_modifica_dato" id="x_modifica_dato" value="<?= HtmlEncode($Page->modifica_dato->CurrentValue) ?>">
</span>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fequipotorneoedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fequipotorneoedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("equipotorneo");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
