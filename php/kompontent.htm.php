<!--
 * Template Formular Komponent. Responsive mit Bootstrap.
-->
<form name="fKomponent" action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
    <div class="form-group row">
        <label for="bezeichnung" class="col-sm-2 col-form-label">Bezeichnung(*)</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo $v->getCssClass("bezeichnung")?>" id="bezeichnung" name="bezeichnung">
              <option value="volvo">Volvo</option>
  			  <option value="saab">Saab</option>
              <option value="fiat">Fiat</option>
              <option value="audi">Audi</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Komponentenname(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name" value="<?php echo $v->getData("name")?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="objekt" class="col-sm-2 col-form-label">Objekt(*)</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo $v->getCssClass("objekt")?>" id="objekt" name="objekt">
              <option value="volvo">Volvo</option>
  			  <option value="saab">Saab</option>
              <option value="fiat">Fiat</option>
              <option value="audi">Audi</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="senden" value="senden">
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>