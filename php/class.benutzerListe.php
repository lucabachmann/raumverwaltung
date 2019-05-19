<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r die Benutzerverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class benutzerListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db f�r alle users
    private $dbUsers;
    
    // array mit allen usern
    private $users=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen f�r alle Eingabefelder
    private $input_classes = array( 'bezeichnung' => config::INPUT_CLASS_N);
    
    /**
     * Konstruktor
     */
    public function __construct( $template_path ) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
    }
    
    /**
     *  Entsprechende Methode ausf�hren (je nachdem welcher Schaltknopf bet�tigt wurde)
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
     * Template ausf�hren, Benutzerverwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."benutzerverwaltung.htm.php");
    }
    
    /**
     * Wert f�r das gew�nschte Feld zur�ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle users zur�ck
     * @return array mit allen usern
     */
    public function getUserListe(){
        foreach ($this->dbUsers as $user) {
            array_push($this->users, new benutzerData($user["iduser"], $user["username"], $user["password"], $user["name"], $user["surname"], $user["admin"]));
        }
        return $this->users;
    }
    
    /**
     * Aktive Klasse f�r das �bergebene Feld zur�ckgeben
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