<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für die Benutzerverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class benutzerListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db für alle users
    private $dbUsers;
    
    // array mit allen usern
    private $users=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen fï¿½r alle Eingabefelder
    private $input_classes = array( 'bezeichnung' => config::INPUT_CLASS_N);
    
    /**
     * Konstruktor
     */
    public function __construct( $template_path ) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
    }
    
    /**
     *  Entsprechende Methode ausführen (je nachdem welcher Schaltknopf betätigt wurde)
     */
    public function run() {
        $dbBenutzer = new dbBenutzer();
        if ( isset($this->params['search']) ) {
            $this->dbUsers = $dbBenutzer->db_search_benutzer($this->params);
        } elseif ( isset($this->params['delete']) ) {
            if(userHelper::isUserAdmin()) {
                $dbBenutzer->db_delete_benutzer($this->params);
            }
            $this->redirect("benutzerListe");
        } else{
            $this->dbUsers = $dbBenutzer->db_select_all_benutzer();
        }
    }
    
    /**
     * Template ausführen, Benutzerverwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."benutzerverwaltung.htm.php");
    }
    
    /**
     * Wert für das gewünschte Feld zurückgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle users zurück
     * @return array mit allen usern
     */
    public function getUserListe(){
        foreach ($this->dbUsers as $user) {
            array_push($this->users, new benutzerData($user["iduser"], $user["username"], $user["password"], $user["name"], $user["surname"], $user["admin"]));
        }
        return $this->users;
    }
    
    /**
     * Aktive Klasse für das übergebene Feld zurückgeben
     */
    public function getCssClass( $field ) {
        return $this->input_classes[$field];
    }
    
    /**
     * Redirect...
     */
    private function redirect($page) {
        header("Location: index.php?id=".$page);
        exit();
    }
}

?>