<!--
 * Template Formular Objektbezeichnung. Responsive mit Bootstrap.
-->
<form name="fObjektbezeichnung" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="bezeichnung" class="col-sm-2 col-form-label">Bezeichnung(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("bezeichnung")?>" type="text" id="bezeichnung" name="bezeichnung" value="<?php echo $v->getData("bezeichnung")?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="senden" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>