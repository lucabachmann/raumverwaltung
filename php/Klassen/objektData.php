<?php
/**
 * @autor Marco Sturzo
 * @date 15. Mai 2019
 *
 * Model für Objekt
 */
    class ObjektData
    {
        private $id;
        private $bezeichnungId;
        private $raumId;
        
        /**
         * Konstruktor
         */
        public function __construct($id, $bezeichnungId, $raumId)
        {
            $this->id = $id;
            $this->bezeichnungId = $bezeichnungId;
            $this->raumId = $raumId;
        }
        
        public function getOid() {
            return $this->id;
        }
        
        public function getBezeichnungId() {
            return $this->bezeichnungId;
        }
        
        public function getBezeichnung() {
            $dbBezeichnung = new dbObjektBezeichnung();
            $_REQUEST["obid"] = $this->bezeichnungId;
            $bezeichnungDb = $dbBezeichnung->db_get_selected_objektBezeichnung($_REQUEST);
            $bezeichnung;
            foreach($bezeichnungDb as $objektBezeichnung){
                $bezeichnung = $objektBezeichnung["name"];
            }
            return $bezeichnung;
        }
        
        public function getRaumId() {
            return $this->raumId;
        }
        
        public function getRaum() {
            $dbRaum = new dbRaum();
            $_REQUEST["rid"] = $this->raumId;
            $raumDb = $dbRaum->db_get_selected_raum($_REQUEST);
            $raumNummer;
            foreach($raumDb as $raum){
                $raumNummer = $raum["nummer"];
            }
            return $raumNummer;
        }
    }
?>