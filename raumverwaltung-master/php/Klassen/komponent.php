<?php
    public class Komponent
    {
        private $id;
        private $bezeichnung;
        private $bezeichnungId;
        private $wert;
        private $wertId;
        
        public function __construct($id, $bezeichnung, $bezeichnungId, $wert, $wertId)
        {
            $this->id = $id;
            $this->bezeichnung = $bezeichnung;
            $this->bezeichnungId = $bezeichnungId;
            $this->wert = $wert;
            $this->wertId = $wertId;
        }
    }
?>