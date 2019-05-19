<!--
 * Template Objektverwaltung. Responsive mit Bootstrap.
-->
<div class="table-responsive-sm">
    <form id="raumAnsicht" action="index.php?id=raumAnsicht" method="post">
        <div class="form-group row">
            <label for="raum" class="col-sm-2 col-form-label">Raum(*)</label>
            <div class="col-sm-10">
                    <select class="form-control <?php echo $v->getCssClass("name")?>" id="raum" name="raum">
            			<?php foreach ( $this->getRäume() as $raum ): ?>
                            <option value="<?php echo $raum->getRid()?>"><?php echo $raum->getNummer()?></option>
            			<?php endforeach; ?>
                    </select>
            </div>
        </div>
        <input type="submit" value="Objekte erhalten"/>
    </form>
    <br>
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="table-active">
            	<th>Objektbezeichung</th><th>Komponente</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ( $this->getObjektListe() as $objekt ): ?>
            <tr>
                <td><?php echo $objekt->getBezeichnung()?></td>
                <td>
                	<ul>
                		<?php foreach ( $this->getKomponente($objekt->getOid()) as $komponent ): ?>
                			<li><?php echo $komponent->getBezeichnung().":   ".$komponent->getWert() ?></li>
            			<?php endforeach;?>
                	</ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>