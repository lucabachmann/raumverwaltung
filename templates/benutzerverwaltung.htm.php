<!--
 * Template Benutzerverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
	<div>
        <form action="index.php?id=benutzerListe" method="post">
            <label for="search">Benutzer suchen</label>
            <input type="text" name="search" maxlength="30">
            <button type="submit">Suchen</button>
    	</form>
    	<?php if(userHelper::isUserAdmin()) {?>
            <form action="index.php?id=benutzer" method="post">
                <input type="submit" value="Benutzer Hinzufügen"/>
        	</form>
    	<?php }?>
	</div>
	<br>
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
    			<?php if(userHelper::isUserAdmin()) {?>
                	<th></th><th></th>
            	<?php }?>
            	<th>Vorname</th><th>Name</th><th>Username</th><th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ( $this->getUserListe() as $user ): ?>
            <tr>
    			<?php if(userHelper::isUserAdmin()) {?>
                	<td><a href="index.php?id=benutzer&uid=<?php echo $user->getUid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                    <td><a href="index.php?id=benutzerListe&delete=<?php echo $user->getUid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
            	<?php }?>
                <td><?php echo $user->getVorname()?></td>
                <td><?php echo $user->getName()?></td>
                <td><?php echo $user->getUsername()?></td>
                <td><?php echo $user->getAdmin()?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>