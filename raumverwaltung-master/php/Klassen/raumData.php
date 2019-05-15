<?php
    class RaumData
    {
        private $id;
        private $name;
        private $nummer;
        
        public function __construct($id, $name, $nummer)
        {
            $this->id = $id;
            $this->name = $name;
            $this->nummer = $nummer;
        }
        
        public function getRid() {
            return $this->id;
        }
        
        public function getName() {
            return $this->name;
        }
        
        public function getNummer() {
            return $this->nummer;
        }
    }
?>