<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die ObjektKomponent Verbindung
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbObjektKomponent extends db {
    
    /**
     *  Einen neuen ObjektKomponent Verbindung einfügen
     */
    function db_insert_objektKomponent($oid, $kid) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO objektKomponent (objektId, komponentId) VALUES (?, ?)")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ii", $oid, $kid);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Löscht alle objektKomponent Verbindungen von einem Objekt
     */
    function db_delete_objektKomponentForObjekt($params){
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM objektKomponent WHERE objektId = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Löscht einen bestimmten objektKomponent Verbindung
     */
    function db_delete_objektKomponentForKomponent($params){
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM objektKomponent WHERE komponentId = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['kid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>