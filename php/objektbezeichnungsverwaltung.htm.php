<!--
 * Template Objektsbezeichnungsverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th></th><th>ID</th><th>Bezeichnung</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getObjektbezeichnungsListe() as $objektbezeichnung ): ?>
            <tr>
            	<td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $objektbezeichnung->getOBid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                <td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $objektbezeichnung->getOBid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td><?php echo $objektbezeichnung->getOBid()?></td>
                <td><?php echo $objektbezeichnung->getBezeichnung()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>