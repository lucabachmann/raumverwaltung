<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für das Komponentenform.
 *
 */
require_once("interface.subcontroller.php");

class komponent implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db für alle komponentBezeichnungen
    private $dbkomponentBezeichnungen;
    
    // array mit allen komponentBezeichnungen
    private $komponentBezeichnungen=array();
    
    // resultat der db für alle räume
    private $dbRäume;
    
    // array mit allen räume
    private $räume=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen fï¿½r alle Eingabefelder
    private $input_classes = array( 'bezeichnung' => config::INPUT_CLASS_N);
    
    private $db = null;
    
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
            $this->redirect("objektListe");
        }
        if ( isset($this->params['speichern']) ) {
            if ( $this->checkInput() ) {
                $this->insertKomponent();
                $this->redirect("objektListe");
            }
        }
    }
    
    /**
     * Template ausführen, Komponentformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."komponent.htm.php");
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
     * Gibt alle KomponentBezeichnungen zurück
     * @return array mit allen KomponentBezeichnungen
     */
    public function getKomponentBezeichnungen(){
        $dbKomponentBezeichnung = new dbKomponentBezeichnung();
        $this->dbkomponentBezeichnungen = $dbKomponentBezeichnung->db_select_all_komponentBezeichnung();
        foreach ($this->dbkomponentBezeichnungen as $bezeichnung) {
            array_push($this->komponentBezeichnungen, new komponentBezeichnungData($bezeichnung["idkomponentenBezeichnung"], $bezeichnung["name"]));
        }
        return $this->komponentBezeichnungen;
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
     * neuer komponent in die db einfügen
     */
    private function insertKomponent() {
        $dbKomponent = new dbKomponent();
        $dbKomponent->db_insert_komponent($this->params);
    }
}

?>