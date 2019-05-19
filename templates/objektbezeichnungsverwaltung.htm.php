<!--
 * Template Objektsbezeichnungsverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
	<div>
    	<?php if(userHelper::isUserAdmin()) {?>
            <form action="index.php?id=objektBezeichnung" method="post">
                <input type="submit" value="Objekt Bezeichnung Hinzufügen"/>
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
			<?php foreach ( $this->getObjektbezeichnungsListe() as $objektbezeichnung ): ?>
                <tr>
					<?php if(userHelper::isUserAdmin()) {?>
                    	<td><a href="index.php?id=objektBezeichnungListe&delete=<?php echo $objektbezeichnung->getOBid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                    <?php }?>
                    <td><?php echo $objektbezeichnung->getOBid()?></td>
                    <td><?php echo $objektbezeichnung->getName()?></td>
                </tr>
			<?php endforeach; ?>
        </tbody>
    </table>
</div>