<?php
/**
 * @autor Marco Sturzo
 * @date 15. Mai 2019
 *
 * Model für Komponente
 */
    class KomponentData
    {
        private $id;
        private $bezeichnungId;
        private $wertId;
        
        /**
         * Konstruktor
         */
        public function __construct($id, $bezeichnungId, $wertId)
        {
            $this->id = $id;
            $this->bezeichnungId = $bezeichnungId;
            $this->wertId = $wertId;
        }
        
        public function getKid() {
            return $this->id;
        }
        
        public function getBezeichnung() {
            $dbBezeichnung = new dbKomponentBezeichnung();
            $_REQUEST["kbid"] = $this->bezeichnungId;
            $bezeichnungDb = $dbBezeichnung->db_get_selected_komponentBezeichnung($_REQUEST);
            $bezeichnung;
            foreach($bezeichnungDb as $komponentBezeichnung){
                $bezeichnung = $komponentBezeichnung["name"];
            }
            return $bezeichnung;
        }
        
        public function getWert() {
            $dbKomponent = new dbKomponent();
            $_REQUEST["kwid"] = $this->wertId;
            $wertDb = $dbKomponent->db_get_selected_komponentWert($_REQUEST);
            $wert;
            foreach($wertDb as $komponentWert){
                $wert = $komponentWert["wert"];
            }
            return $wert;
        }
    }
?>