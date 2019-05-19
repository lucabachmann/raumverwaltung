<!--
 * Template Komponentenbezeichnungsverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
	<div>
    	<?php if(userHelper::isUserAdmin()) {?>
            <form action="index.php?id=komponentBezeichnung" method="post">
                <input type="submit" value="Komponent Bezeichnung Hinzufügen"/>
        	</form>
    	<?php }?>
	</div>
	<br>
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
    			<?php if(userHelper::isUserAdmin()) {?>
                	<th></th>
                <?php }?>
                <th>ID</th><th>Bezeichnung</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $this->getKomponentenbezeichnungsListe() as $komponentenbezeichnung ): ?>
                <tr>
        			<?php if(userHelper::isUserAdmin()) {?>
                    	<td><a href="index.php?id=komponentBezeichnungListe&delete=<?php echo $komponentenbezeichnung->getKBid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                    <?php }?>
                    <td><?php echo $komponentenbezeichnung->getKBid()?></td>
                    <td><?php echo $komponentenbezeichnung->getName()?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>