<?php
    public class Objekt
    {
        private $id;
        private $bezeichnung;
        private $bezeichnungId;
        private $raumId;
        private $komponent[];
        
        public function __construct($id, $bezeichnung, $bezeichnungId, $raumId, $komponent[])
        {
            $this->id = $id;
            $this->bezeichnung = $bezeichnung;
            $this->bezeichnungId = $bezeichnungId;
            $this->raumId = $raumId;
            $this->komponent[] = $komponent[];
        }
    }
?>