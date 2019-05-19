<!--
 * Template Formular Objekt. Responsive mit Bootstrap.
-->
<?php if(userHelper::isUserAdmin()) {?>
<form name="fObjekt" action="index.php?id=objekt" method="post">
    <div class="form-group row">
        <label for="objektbezeichnung" class="col-sm-2 col-form-label">Bezeichnung(*)</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo $v->getCssClass("name")?>" id="objektbezeichnung" name="objektbezeichnung">
			<?php foreach ( $this->getObjektBezeichnungen() as $objektBezeichnung ): ?>
                <option value="<?php echo $objektBezeichnung->getOBid()?>" <?php if(!empty($this->objekt)) { if($this->objekt->getBezeichnungId() == $objektBezeichnung->getOBid()){?> selected <?php }}?>><?php echo $objektBezeichnung->getName()?></option>
			<?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="raum" class="col-sm-2 col-form-label">Raum(*)</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo $v->getCssClass("name")?>" id="raum" name="raum">
			<?php foreach ( $this->getRäume() as $raum ): ?>
                <option value="<?php echo $raum->getRid()?>" <?php if(!empty($this->objekt)) { if($this->objekt->getRaumId() == $raum->getRid()){?> selected <?php }}?>><?php echo $raum->getNummer()?></option>
			<?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="oid" value="<?php if(!empty($this->objekt)) {echo $this->objekt->getOid();}?>"/>
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