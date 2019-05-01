<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Formular Kontakte. Responsive mit Bootstrap.
 *
-->
<form name="fkontakt" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name" value="<?php echo $v->getData("name")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="vorname" class="col-sm-2 col-form-label">Vorname(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("vorname")?>" type="text" id="vorname" name="vorname" value="<?php echo $v->getData("vorname")?>">
        </div>
    </div>
        <div class="form-group row">
        <label for="vorname" class="col-sm-2 col-form-label">Strasse</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="strasse" name="strasse" value="<?php echo $v->getData("strasse")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="plz" class="col-sm-2 col-form-label">Plz</label>
        <div class="col-sm-2">
            <input class="form-control" type="text" id="plz" name="plz" value="<?php echo $v->getData("plz")?>">
        </div>
        <label for="ort" class="col-sm-2 col-form-label">Ort</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" id="ort" name="ort" value="<?php echo $v->getData("ort")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("email")?>" type="email" id="email" name="email" value="<?php echo $v->getData("email")?>">
        </div>
    </div>
        <div class="form-group row">
        <label for="telpriv" class="col-sm-2 col-form-label">Telefon Privat</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="telpriv" name="tpriv" value="<?php echo $v->getData("tpriv")?>">
        </div>
    </div>
        <div class="form-group row">
        <label for="telgesch" class="col-sm-2 col-form-label">Telefon Geschäft</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="telgesch" name="tgesch" value="<?php echo $v->getData("tgesch")?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="senden" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>