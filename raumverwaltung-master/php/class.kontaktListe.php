<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 * 
 * Datensrtruktur für eine Liste mit Kontktdaten (kontaktData)
 */
class kontaktListe {
    private $kontakt_liste = array();
    
    public function getKontaktListe() {
        return $this->kontakt_liste;
    }
    
    public function addKontaktData($kontakt) {
        if ($kontakt instanceof  kontaktData) {
            $this->kontakt_liste[] = $kontakt;
        } else {
            throw new Exception (getclass().": Parameter kontakt is not instance of class kontaktData");
        }        
    }
}

?>

