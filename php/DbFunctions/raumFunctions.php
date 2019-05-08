<?php
    function db_insert_raum($params) {
        if ( !$stmt = $mysqli->prepare("INSERT INTO raum (name, nummer) VALUES (?, ?)") {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("ss", $mysqli->real_escape_string($params['name']), $mysqli->real_escape_string($params['nummer']) );
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    function db_update_raum($params) {
        if ( !$stmt = $mysqli->prepare("UPDATE raum SET name = ?, nummer = ? WHERE idraum = ?") {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("ssi", $mysqli->real_escape_string($params['name']), $mysqli->real_escape_string($params['nummer']), $params['idraum']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
    
    function db_search_raum($params) {
        if ( !$stmt = $mysqli->prepare("SELECT * FROM raum WHERE name LIKE '%?%' ORDER BY name") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("s", $mysqli->real_escape_string($params['name']);
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    function db_select_all_raum($params){
        $sql = "SELECT * FROM raum";
        return sqlQuery($sql);
    }
    
    function db_get_selected_raum($params){
        if ( !$stmt = $mysqli->prepare("SELECT * FROM raum WHERE idraum = ?") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['idraum'];
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
        
        return $stmt->get_result();
    }
    
    function db_delete_raum($params){
        if ( !$stmt = $mysqli->prepare("DELETE FROM raum WHERE idraum = ?") ) {
            die ("Prepare failed" . $mysqli->errno . "  ".$mysqli->error);
        }
        
        $stmt->bind_param("i", $params['idraum'];
        
        if (!$stmt->execute()) {
            die("Fehler in Query: ".$stmt->error );
        }
    }
?>