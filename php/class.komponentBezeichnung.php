<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für das KomponentBezeichnungsFormular
 *
 */
require_once("interface.subcontroller.php");

class komponentBezeichnung implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
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
            $this->redirect("komponentBezeichnungListe");
        }
        if ( isset($this->params['speichern']) ) {
            if ( $this->checkInput() ){
                $this->insertKomponentBezeichnung();
                $this->redirect("komponentBezeichnungListe");
            }
        }
    }
    
    /**
     * Template ausführen, KomponentBezeichnungsFormular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."komponentBezeichnung.htm.php");
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
     * neuer KomponentenBezeichnung in die db einfügen
     */
    private function insertKomponentBezeichnung() {
        $dbKomponentBezeichnung = new dbKomponentBezeichnung();
        $dbKomponentBezeichnung->db_insert_komponentBezeichnung($this->params);
    }
}

?>