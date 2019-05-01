<?php
/**
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Datenschnittstelle für die Anwendung MVC-GIBS.
 *
 */

/**
 *  Diese Klasse liest und speichert Daten
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

// Die Daten werden als Objekte des Typs kontakData in derr Session gespeichern
//if ( !isset($_SESSION['kontaktliste']) ) $_SESSION['kontaktliste'] = array(); 

class dbKontakte extends db {
        /*
         *  Alle Kontakte lesen
         */
        public function selectKontakte() {
            $liste = new kontaktListe();
            $result = $this->select( "select * from kontakte order by name, vorname");
            if (count($result)) {
                foreach ($result as $data ) {
                    $liste->addKontaktData( new kontaktData($data->kid, $data->name, $data->vorname, $data->strasse, $data->plz, $data->ort, $data->email, $data->tpriv, $data->tgesch));
                }
            }
            return $liste;
        }

        /**
         *  Einen Kontakt in die Tabelle einfügen
         */
	public function insertKontakt( $kontakt ) {
            if ($kontakt instanceof  kontaktData) {
                $sql = "insert into kontakte (name, vorname, strasse, plz, ort, email, tpriv, tgesch)
                        values (".$this->escape($kontakt->getName()).",".$this->escape($kontakt->getVorname()).",".$this->escape($kontakt->getStrasse()).",".
                        "'".intval($kontakt->getPlz())."',".$this->escape($kontakt->getOrt()).",".$this->escape($kontakt->getEmail()).",".$this->escape($kontakt->getTpriv()).",".
                        $this->escape($kontakt->getTgesch()).")";
                $this->query( $sql );
            } else {
                throw new Exception (getclass().": Parameter kontakt is no instance of class kontaktData");
            }
	}
        
        /**
         * Einen bestimmten Kontakt löschen
         */
        public function deleteKontakt( $kid ) {
            $this->query("delete from kontakte where kid='$kid'");
        }
}

?>