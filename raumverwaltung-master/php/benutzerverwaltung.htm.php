<!--
 * Template Benutzerverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th>Vorname</th><th>Name</th><th>Username</th><th>Password</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getUserListe() as $user ): ?>
            <tr>
            	<td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $user->getUid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                <td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $user->getUid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td><?php echo $user->getVorname()?></td>
                <td><?php echo $user->getName()?></td>
                <td><?php echo $user->getUsername()?></td>
                <td><?php echo $user->getPassword()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>