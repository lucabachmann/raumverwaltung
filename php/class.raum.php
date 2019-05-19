<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für das Raumform.
 *
 */
require_once("interface.subcontroller.php");

class raum implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // Raumdaten falls ein edit gemacht wird
    public $raum;
    
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
        if( isset($this->params['abbrechen'])){
            $this->redirect("raumListe");
        }
        $dbRaum = new dbRaum();
        if(!empty($this->params['rid'])){
            $raumDb = $dbRaum->db_get_selected_raum($this->params);
            foreach($raumDb as $raum){
                $this->raum = new raumData($raum["idraum"], $raum["name"], $raum["nummer"]);
            }
        }
        if ( isset($this->params['speichern']) ) {
            if( empty($this->params['rid'])){
                if ( $this->checkInput() ){
                    $this->insertRaum();
                    $this->redirect("raumListe");
                }
            } else {
                if ( $this->checkInput() ) {
                    $this->updateRaum();
                    $this->redirect("raumListe");
                }
            }
        }
    }
    
    /**
     * Template ausführen, Raumformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."raum.htm.php");
    }
    
    /**
     * Wert für das gewünschte Feld zurückgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
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
    
    /**
     * Benutzereingaben prüfen
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
     * neuer raum in die db einfügen
     */
    private function insertRaum() {
        $dbRaum = new dbRaum();
        $dbRaum->db_insert_raum($this->params);
    }
    
    /**
     * bestehender raum in der db aktualisieren 
     */
    private function updateRaum() {
        $dbRaum = new dbRaum();
        $dbRaum->db_update_raum($this->params);
    }
    
}

?>