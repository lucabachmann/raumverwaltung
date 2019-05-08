<!--
 * Template Objektverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th></th><th></th><th>Objektbezeichung</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getObjektListe() as $objekt ): ?>
            <tr>
            	<td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $objekt->getOid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
            	<td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $objekt->getOid()?>"><img src="<?php echo config::IMAGE_PATH?>/editComponents.png" border=\"no\"></a></td>
                <td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $objekt->getOid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td><?php echo $objekt->getObjektbezeichnung()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>