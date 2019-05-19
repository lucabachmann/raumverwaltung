<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r das Benutzerform.
 *
 */
require_once("interface.subcontroller.php");

class benutzer implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // Benutzerdaten falls ein edit gemacht wird
    public $user;
    
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
        if( isset($this->params['abbrechen'])){
            $this->redirect("benutzerListe");
        }
        $dbBenutzer = new dbBenutzer();
        if(!empty($this->params['uid'])){
            $userDb = $dbBenutzer->db_get_selected_benutzer($this->params);
            foreach($userDb as $user){
                $this->user = new benutzerData($user["iduser"], $user["username"], $user["password"], $user["name"], $user["surname"], $user["admin"]);
            }
        }
        if ( isset($this->params['speichern']) ) {
            if( empty($this->params['uid'])){
                if ( $this->checkInput() ){
                    $this->insertBenutzer();
                    $this->redirect("benutzerListe");
                }
            } else {
                if ( $this->checkInput() ) {
                    $this->updateBenutzer();
                    $this->redirect("benutzerListe");
                }
            }
        }
    }
    
    /**
     * Template ausf�hren, Benutzerformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."user.htm.php");
    }
    
    /**
     * Wert f�r das gew�nschte Feld zur�ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
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
    
    /**
     * Benutzereingaben pr�fen
     */
    private function checkInput() {
        $input_ok = true;
        
        //                if ( !basic::CheckName($this->params['bezeichnung'])) {
        //                        $this->input_classes['bezeichnung'] = config::INPUT_CLASS_E;
        //			$input_ok = false;
        //                }
        
        return $input_ok;
    }
    
    /**
     * neuer benutzer in die db einf�gen
     */
    private function insertBenutzer() {
        $dbBenutzer = new dbBenutzer();
        $dbBenutzer->db_insert_benutzer($this->params);
    }
    
    /**
     * bestehender benutzer in der db aktualisieren
     */
    private function updateBenutzer() {
        $dbBenutzer = new dbBenutzer();
        $dbBenutzer->db_update_benutzer($this->params);
    }
    
}

?>