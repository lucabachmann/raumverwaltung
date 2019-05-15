<!--
 * Template Raumliste. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <div>
        <form action="index.php?id=raumListe" method="post">
            <label for="search">Raum suchen</label>
            <input type="text" name="search" maxlength="30">
            <button type="submit">Suchen</button>
    	</form>
        <form action="index.php?id=raum" method="post">
            <input type="submit" value="Raum Hinzufügen"/>
    	</form>
    </div>
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th></th><th>Name</th><th>Nummer</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->getRaumListe() as $raum ): ?>
            <tr>
            	<td><a href="index.php?id=raum&rid=<?php echo $raum->getRid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                <td><a href="index.php?id=raumListe&delete=<?php echo $raum->getRid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td><?php echo $raum->getName()?></td>
                <td><?php echo $raum->getNummer()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>