<?php
    public class Raum
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
    }
?>