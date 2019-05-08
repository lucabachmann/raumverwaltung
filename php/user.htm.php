<!--
 * Template Formular User. Responsive mit Bootstrap.
-->
<form name="fuser" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name" value="<?php echo $v->getData("name")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="vorname" class="col-sm-2 col-form-label">Vorname</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("vorname")?>" type="text" id="vorname" name="vorname" value="<?php echo $v->getData("vorname")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("username")?>" type="text" id="username" name="username" value="<?php echo $v->getData("username")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Passwort(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("password")?>" type="password" id="password" name="password" value="<?php echo $v->getData("password")?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="senden" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>