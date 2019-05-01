<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Responsive mit Bootstrap.
 *
-->
<div class="table-responsive-sm">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
                <th></th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Telefon privat</th><th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getKontaktListe() as $kontakt ): ?>
            <tr>
                <td><a href="<?php echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td><?php echo $kontakt->getName()?></td>
                <td><?php echo $kontakt->getVorname()?></td>
                <td><?php echo $kontakt->getStrasse()?></td>
                <td><?php if(empty($kontakt->getPlz())) echo ""; else echo $kontakt->getPlz()?></td>
                <td><?php echo $kontakt->getOrt()?></td>
                <td><?php echo $kontakt->getEmail()?></td>
                <td><?php echo $kontakt->getTpriv()?></td>
                <td><?php echo $kontakt->getTgesch()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>