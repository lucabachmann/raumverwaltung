<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die ObjektBezeichnungen
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbObjektBezeichnung extends db {
    
    /**
     *  Eine neue ObjektBezeichnung einfügen
     */
    public function db_insert_objektBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO objektbezeichnung (name) VALUES (?)") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  " . self::$mysqli->error);
        }
        
        $stmt->bind_param("s", self::$mysqli->real_escape_string($params['name']));
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Liest alle objektBezeichnungen
     */
    public function db_select_all_objektBezeichnung() {
        $stmt = self::$mysqli->prepare("SELECT * FROM objektbezeichnung");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    /**
     * Liest einen bestimmten objektBezeichnung
     */
    public function db_get_selected_objektBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM objektbezeichnung WHERE idobjektbezeichnung = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['obid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Löscht einen bestimmten objektBezeichnung
     */
    public function db_delete_objektBezeichnung($params) {
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM objektbezeichnung WHERE idobjektBezeichnung = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>