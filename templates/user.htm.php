<!--
 * Template Formular User. Responsive mit Bootstrap.
-->
<?php if(userHelper::isUserAdmin()) {?>
<form name="fuser" action="index.php?id=benutzer" method="post">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("name")?>" type="text" id="name" name="name" 
           	 	value="<?php if(!empty($this->user)) {echo $this->user->getName();}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="vorname" class="col-sm-2 col-form-label">Vorname</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("vorname")?>" type="text" id="vorname" name="vorname" 
       	 		value="<?php if(!empty($this->user)) {echo $this->user->getVorname();}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("username")?>" type="text" id="username" name="username" 
           	 	value="<?php if(!empty($this->user)) {echo $this->user->getUsername();}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Passwort(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("password")?>" type="password" id="password" name="password" 
           	 	value="<?php if(!empty($this->user)) {echo $this->user->getPassword();}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="admin" class="col-sm-2 col-form-label">Admin(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo $v->getCssClass("admin")?>" type="checkbox" id="admin" name="admin" 
           	 	<?php if(!empty($this->user)) {if($this->user->getAdmin() == 1){?>
       	 			checked
       	 		<?php }}?>
           	 	>
        </div>
    </div>
    <input type="hidden" name="uid" value="<?php if(!empty($this->user)) {echo $this->user->getUid();}?>"/>
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