<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die Objekte
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbObjekt extends db {
    
    /**
     *  Ein neues Objekt einfügen
     */
    function db_insert_objekt($params) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO objekt (bezeichnungId, raumId) VALUES (?, ?)")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ii", $params['objektbezeichnung'], $params['raum']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Ein bestehendenes Objekt aktualisieren
     */
    function db_update_objekt($params) {
        if ( !$stmt = self::$mysqli->prepare("UPDATE objekt SET bezeichnungId = ?, raumId = ? WHERE idobjekt = ?")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("iii", $params['objektbezeichnung'], $params['raum'], $params['oid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Liest alle objekte, die eine objektbezeichnung haben welcher mit dem Suchkriterium übereinstimmt
     */
    function db_search_objekt($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT objekt.idobjekt, objekt.bezeichnungId, objektbezeichnung.name, objekt.raumId FROM `objekt` 
                                              INNER JOIN objektbezeichnung ON objekt.bezeichnungId=objektbezeichnung.idobjektbezeichnung WHERE objektbezeichnung.name LIKE ? ORDER BY objektbezeichnung.name")) 
        {
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
     * Liest alle objekte
     */
    function db_select_all_objekt(){
        $stmt = self::$mysqli->prepare("SELECT * FROM objekt");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    /**
     * Liest einen bestimmten objekt
     */
    function db_get_selected_objekt($params){
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM objekt WHERE idobjekt = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['oid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Liest alle objekte für einen Raum
     */
    function db_get_objektForRaum($params){
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM objekt WHERE raumId = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['raum']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Löscht einen bestimmten objekt
     */
    function db_delete_objekt($params){
        $dbObjektKomponent = new dbObjektKomponent(); 
        $dbObjektKomponent->db_delete_objektKomponentForObjekt($params);
        
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM objekt WHERE idobjekt = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>