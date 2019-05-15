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

class dbRaum extends db {
        /*
         *  Alle Kontakte lesen
         */
    public function db_insert_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO raum (name, nummer) VALUES (?, ?)") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  " . self::$mysqli->error);
        }
        
        $stmt->bind_param("ss", self::$mysqli->real_escape_string($params['name']), self::$mysqli->real_escape_string($params['nummer']) );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    public function db_update_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("UPDATE raum SET name = ?, nummer = ? WHERE idraum = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ssi", self::$mysqli->real_escape_string($params['name']), self::$mysqli->real_escape_string($params['nummer']), $params['rid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    public function db_search_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM raum WHERE name LIKE ? ORDER BY name") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("s", self::$mysqli->real_escape_string("%".$params['search']."%"));
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    public function db_select_all_raum() {
        $stmt = self::$mysqli->prepare("SELECT * FROM raum");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    public function db_get_selected_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM raum WHERE idraum = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['rid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    public function db_delete_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM raum WHERE idraum = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>