<!--
 * Template Objektverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <div>
        <form action="index.php?id=objektListe" method="post">
            <label for="search">Objekt suchen</label>
            <input type="text" name="search" maxlength="30">
            <button type="submit">Suchen</button>
    	</form>
		<?php if(userHelper::isUserAdmin()) {?>
            <form action="index.php?id=objekt" method="post">
                <input type="submit" value="Objekt Hinzufügen"/>
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
                	<th>Objektbezeichung</th><th>Raum</th><th>Komponente</th>
				<?php if(userHelper::isUserAdmin()) {?>
                <th></th>
                <?php }?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ( $this->getObjektListe() as $objekt ): ?>
            <tr>
    			<?php if(userHelper::isUserAdmin()) {?>
                	<td><a href="index.php?id=objekt&oid=<?php echo $objekt->getOid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                    <td><a href="index.php?id=objektListe&delete=<?php echo $objekt->getOid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <?php }?>
                <td><?php echo $objekt->getBezeichnung()?></td>
                <td><?php echo $objekt->getRaum()?></td>
                <td>
                	<ul>
                		<?php foreach ( $this->getKomponente($objekt->getOid()) as $komponent ): ?>
                			<li>
                				<?php echo $komponent->getBezeichnung().":   ".$komponent->getWert() ?>
                    			<a href="index.php?id=objektListe&kid=<?php echo $komponent->getKid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                			</li>
            			<?php endforeach;?>
                	</ul>
                </td>
    			<?php if(userHelper::isUserAdmin()) {?>
            		<td><a href="index.php?id=komponent&oid=<?php echo $objekt->getOid()?>"><button>Komponent Hinzufügen</button></a></td>
        		<?php }?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>