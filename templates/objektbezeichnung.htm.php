<!--
 * Template Formular Objektbezeichnung. Responsive mit Bootstrap.
-->
<?php if(userHelper::isUserAdmin()) {?>
<form name="fObjektbezeichnung" action="index.php?id=objektBezeichnung" method="post">
    <div class="form-group row">
        <label for="bezeichnung" class="col-sm-2 col-form-label">Name(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("bezeichnung")?>" type="text" id="name" name="name" value="<?php echo $v->getData("bezeichnung")?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="speichern" value="speichern">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>
<?php } else {
echo "Need administrator permission!";
}?>