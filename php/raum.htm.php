<!--
 * Template Formular Raum. Responsive mit Bootstrap.
-->
<form name="fRaum" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Raumname(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name" value="<?php echo $v->getData("name")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="nummer" class="col-sm-2 col-form-label">Raumnummer(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("nummer")?>" type="text" id="nummer" name="nummer" value="<?php echo $v->getData("nummer")?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="senden" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>