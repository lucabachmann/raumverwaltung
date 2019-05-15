<!--
 * Template Formular Login. Responsive mit Bootstrap.
-->
<form name="fRaum" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Username(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name">
        </div>
    </div>
    <div class="form-group row">
        <label for="nummer" class="col-sm-2 col-form-label">Password(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="password" id="pw" name="pw">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="login" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>