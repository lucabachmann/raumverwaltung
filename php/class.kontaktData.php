<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 * 
 * Datenstruktur für Kontaktdaten
 */
class kontaktData {
    private $kid;
    private $name;
    private $vorname;
    private $strasse;
    private $plz;
    private $ort;
    private $email;
    private $tpriv;
    private $tgesch;
    
    public function __construct($kid, $name, $vorname, $strasse, $plz, $ort, $email, $tpriv, $tgesch) {
        $this->kid = $kid;
        $this->name = $name;
        $this->vorname = $vorname;
        $this->strasse = $strasse;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->email = $email;
        $this->tpriv = $tpriv;
        $this->tgesch = $tgesch;
    }
    
    public function getKid() {
        return $this->kid;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getVorname() {
        return $this->vorname;
    }
    
    public function getStrasse() {
        return $this->strasse;
    }
    
    public function getPlz() {
        return $this->plz;
    }
    
    public function getOrt() {
        return $this->ort;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getTpriv() {
        return $this->tpriv;
    }
    
    public function getTgesch() {
        return $this->tgesch;
    }
}
?>

