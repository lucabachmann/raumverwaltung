<!--
 * Template Komponentenverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th></th><th>Bezeichnung</th><th>Wert</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getKomponentenListe() as $komponent ): ?>
            <tr>
            	<td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $komponent->getKid()?>"><img src="<?php echo config::IMAGE_PATH?>/edit.png" border=\"no\"></a></td>
                <td><a href="<?php echo $this->phpmodule?>&rid=<?php echo $komponent->getKid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td><?php echo $komponent->getBezeichnung()?></td>
                <td><?php echo $komponent->getWert()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>