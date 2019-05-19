<!--
 * Template Formular Komponent. Responsive mit Bootstrap.
-->
<?php if(userHelper::isUserAdmin()) {?>
<form name="fKomponent" action="index.php?id=komponent" method="post">
    <div class="form-group row">
        <label for="komponentenbezeichnung" class="col-sm-2 col-form-label">Bezeichnung(*)</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo $v->getCssClass("name")?>" id="komponentenbezeichnung" name="komponentenbezeichnung">
			<?php foreach ( $this->getKomponentBezeichnungen() as $komponentBezeichnung ): ?>
                <option value="<?php echo $komponentBezeichnung->getKBid()?>"><?php echo $komponentBezeichnung->getName()?></option>
			<?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="komponentenwert" class="col-sm-2 col-form-label">Komponentenwert(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="komponentenwert" name="komponentenwert">
        </div>
    </div>
    <input type="hidden" id="oid" name="oid" value="<?php echo $this->params["oid"]?>"/>
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