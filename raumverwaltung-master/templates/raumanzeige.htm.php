<!--
 * Template Raumliste. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th>Name</th><th>Nummer</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getRaumListe() as $raum ): ?>
            <tr>
                <td><?php echo $raum->getName()?></td>
                <td><?php echo $raum->getNummer()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>