<?php
/**
 * @autor Marco Sturzo
 * @date 15. Mai 2019
 *
 * Model für KomponentBezeichnung
 */
    class KomponentBezeichnungData
    {
        private $id;
        private $name;
        
        /**
         * Konstruktor
         */
        public function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }
        
        public function getKBid() {
            return $this->id;
        }
        
        public function getName(){
            return $this->name;
        }
    }
?>