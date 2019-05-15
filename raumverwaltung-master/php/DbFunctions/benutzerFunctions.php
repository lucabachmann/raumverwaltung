<?php
    function db_insert_benutzer($params) {
        if ( !$stmt = $mysqli->prepare("INSERT INTO user (name, surname, username, password, admin) VALUES (?, ?, ?, ?, ?)") {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("ssssi",
            $mysqli->real_escape_string($params['name']),
            $mysqli->real_escape_string($params['surname']),
            $mysqli->real_escape_string($params['username']),
            $mysqli->real_escape_string($params['password']),
            $params['admin']
        );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    function db_update_benutzer($params) {
        if ( !$stmt = $mysqli->prepare("UPDATE user SET name = ?, surname = ?, username = ?, password = ?, admin = ? WHERE iduser = ?") {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("ssssii",
            $mysqli->real_escape_string($params['name']),
            $mysqli->real_escape_string($params['surname']),
            $mysqli->real_escape_string($params['username']),
            $mysqli->real_escape_string($params['password']),
            $params['admin'],
            $params['iduser']
        );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    function db_search_benutzer($params) {
        if ( !$stmt = $mysqli->prepare("SELECT * FROM user WHERE username LIKE '%?%' ORDER BY username") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("s", $mysqli->real_escape_string($params['username']),);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    function db_select_all_benutzer($params){
        $sql = "SELECT * FROM user";
        return sqlQuery($sql);
    }
    
    function db_get_selected_benutzer($params){
        if ( !$stmt = $mysqli->prepare("SELECT * FROM user WHERE iduser = ?") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['iduser'];
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    function db_delete_benutzer($params){
        if ( !$stmt = $mysqli->prepare("DELETE FROM user WHERE iduser = ?") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['iduser'];
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
?>