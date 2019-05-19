<?php
/**
 * @author Marco Sturzo
 * @date 15. Mai 2019
 *
 * Hiere sind alle db Funktionen für das login
 *
 */

// DB-Verbindung herstellen
db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );

class dbLogin extends db {
        
    /**
     * Login request
     */
    public function login($params) {
        if ( !$stmt = self::$mysqli->prepare("SELECT * FROM user WHERE username = ? AND password = ?") ) {
            die ("Prepare failed" . self::$mysqli->errno . "  ".self::$mysqli->error);
        }
        
        $stmt->bind_param("ss", $params['name'], $params['pw']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
}

?>