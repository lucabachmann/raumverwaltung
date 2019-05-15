<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
    <table class="tstacked">
        <thead>
            <tr>
                <th></th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Telefon privat</th><th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $this->data->getKontaktListe() as $kontakt ): ?>
            <tr>
                <td data-label="Löschen"><a href="<?php echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td data-label="Name"><?php echo $kontakt->getName()?></td>
                <td data-label="Vorname"><?php echo $kontakt->getVorname()?></td>
                <td data-label="Strasse"><?php echo $kontakt->getStrasse()?></td>
                <td data-label="PLZ"><?php if(empty($kontakt->getPlz())) echo ""; else echo $kontakt->getPlz()?></td>
                <td data-label="Ort"><?php echo $kontakt->getOrt()?></td>
                <td data-label="Email"><?php echo $kontakt->getEmail()?></td>
                <td data-label="Telefon privat"><?php echo $kontakt->getTpriv()?></td>
                <td data-label="Telefon gesch."><?php echo $kontakt->getTgesch()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>