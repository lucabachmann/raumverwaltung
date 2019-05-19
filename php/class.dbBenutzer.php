<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für die Benutzer
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbBenutzer extends db {
    
    /**
     *  Einen neuen Benutzer einfügen
     */
    function db_insert_benutzer($params) {
        if ( !$stmt = self::$mysqli->prepare("INSERT INTO user (name, surname, username, password, admin) VALUES (?, ?, ?, ?, ?)")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $admin = (isset($params["admin"])) ? 1 : 0;
        
        $stmt->bind_param("ssssi",
            self::$mysqli->real_escape_string($params['name']),
            self::$mysqli->real_escape_string($params['vorname']),
            self::$mysqli->real_escape_string($params['username']),
            self::$mysqli->real_escape_string($params['password']),
            $admin
            );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Einen bestehenden Benutzer aktualisieren
     */
    function db_update_benutzer($params) {
        if ( !$stmt = self::$mysqli->prepare("UPDATE user SET name = ?, surname = ?, username = ?, password = ?, admin = ? WHERE iduser = ?")) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $admin = (isset($params["admin"])) ? 1 : 0;
        
        $stmt->bind_param("ssssii",
            self::$mysqli->real_escape_string($params['name']),
            self::$mysqli->real_escape_string($params['vorname']),
            self::$mysqli->real_escape_string($params['username']),
            self::$mysqli->real_escape_string($params['password']),
            $admin,
            $params['uid']
        );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    /**
     * Liest alle benutzer, die einen username haben welcher mit dem Suchkriterium übereinstimmt
     */
    function db_search_benutzer($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM user WHERE username LIKE ? ORDER BY username") ) {
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
     * Liest alle benutzer
     */
    function db_select_all_benutzer(){
        $stmt = self::$mysqli->prepare("SELECT * FROM user");
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        return $stmt->get_result();
    }
    
    /**
     * Liest einen bestimmten benutzer
     */
    function db_get_selected_benutzer($params){
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM user WHERE iduser = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['uid']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    /**
     * Löscht einen bestimmten benutzer
     */
    function db_delete_benutzer($params){
        if ( !$stmt = self::$mysqli->prepare("DELETE FROM user WHERE iduser = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['delete']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
}

?>