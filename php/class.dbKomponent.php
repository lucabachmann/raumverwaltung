<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die Komponente
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbKomponent extends db {
    
    /**
     *  Einen neuen Komponent einfügen
     */
    function db_insert_komponent($params) {
        $komponentenWert = $this->db_insert_komponentWert($params);
        
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO komponent (komponentenBezeichnungId, komponentWertId) VALUES (?, ?)")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ii", $params['komponentenbezeichnung'], $komponentenWert);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        $dbObjektKomponent = new dbObjektKomponent();
        $dbObjektKomponent->db_insert_objektKomponent($params["oid"], self::$mysqli->insert_id);
    }
    
    /**
     *  Einen neuen KomponentWert einfügen, wenn der Wert schon besteht, wird der bestehende wert verwendet
     */
    function db_insert_komponentWert($params){
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM komponentenwert WHERE wert = ?")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("s", $params['komponentenwert']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result)==0) {
            if ( !$stmt = self::$mysqli->prepare("INSERT INTO komponentenwert (wert) VALUES (?)")) {
                die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
            }
            
            $stmt->bind_param("s", $params['komponentenwert']);
            
            if (!$stmt->execute()) {
                die("Fehler in Query: ".$stmt->error );
            }
            
            return self::$mysqli->insert_id;
        } else {
            $wertId;
            foreach($result as $wert){
                $wertId = $wert["idkomponentenWert"];
            }
            return $wertId;
        }
    }
    
    /**
     * Liest einen bestimmten komponentenWert
     */
    public function db_get_selected_komponentWert($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM komponentenwert WHERE idkomponentenWert = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['kwid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Liest alle Komponente von einem Objekt
     */
    function db_select_all_komponentForObjekt($oid){
        if ( !$stmt = self::$mysqli->prepare("SELECT komponent.idkomponent, komponent.komponentenBezeichnungId, komponent.komponentWertId, objektkomponent.objektId FROM `komponent` 
                                              INNER JOIN objektkomponent ON komponent.idkomponent=objektkomponent.komponentId WHERE objektkomponent.objektId = ?")) 
        {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $oid);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Löscht einen bestimmten komponent
     */
    function db_delete_komponent($params){
        $dbObjektKomponent = new dbObjektKomponent();
        $dbObjektKomponent->db_delete_objektKomponentForKomponent($params);
        
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM komponent WHERE idkomponent = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['kid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>