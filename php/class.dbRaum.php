<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die Räume
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbRaum extends db {
    
    /**
     *  Einen neuen Raum einfügen
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
    
    /**
     * Einen bestehenden Raum aktualisieren
     */
    public function db_update_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("UPDATE raum SET name = ?, nummer = ? WHERE idraum = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ssi", self::$mysqli->real_escape_string($params['name']), self::$mysqli->real_escape_string($params['nummer']), $params['rid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Liest alle räume, die eine raumnname haben welcher mit dem Suchkriterium übereinstimmt
     */
    public function db_search_raum($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM raum WHERE name LIKE ? ORDER BY name") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $params['search'] = self::$mysqli->real_escape_string("%".$params['search']."%");
        
        $stmt->bind_param("s", $params['search']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Liest alle räume
     */
    public function db_select_all_raum() {
        $stmt = self::$mysqli->prepare("SELECT * FROM raum");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    /**
     * Liest einen bestimmten raum
     */
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
    
    /**
     * Löscht einen bestimmten raum
     */
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