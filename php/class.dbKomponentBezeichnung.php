<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die KomponentBezeichnungen
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbKomponentBezeichnung extends db {
    
    /**
     *  Einen neue KomponentBezeichnung einfügen
     */
    public function db_insert_komponentBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO komponentenbezeichnung (name) VALUES (?)") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  " . self::$mysqli->error);
        }
        
        $stmt->bind_param("s", self::$mysqli->real_escape_string($params['name']));
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Liest alle komponentBezeichnungen
     */
    public function db_select_all_komponentBezeichnung() {
        $stmt = self::$mysqli->prepare("SELECT * FROM komponentenbezeichnung");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    /**
     * Liest einen bestimmten komponentBezeichnung
     */
    public function db_get_selected_komponentBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM komponentenbezeichnung WHERE idkomponentenBezeichnung = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['kbid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Löscht einen bestimmten komponentBezeichnung
     */
    public function db_delete_komponentBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM komponentenbezeichnung WHERE idkomponentenBezeichnung = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>