<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für die ObjektBezeichnungsverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class objektBezeichnungListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db für alle objektBezeichnungen
    private $dbobjektBezeichnungen;
    
    // array mit allen objektBezeichnungen
    private $objektBezeichnungen=array();
    
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
        $dbObjektBezeichnung = new dbObjektBezeichnung();
        if ( isset($this->params['delete']) ) {
            if(userHelper::isUserAdmin()) {
                $dbObjektBezeichnung->db_delete_objektBezeichnung($this->params);
            }
            $this->redirect("objektBezeichnungListe");
        } else{
            $this->dbobjektBezeichnungen = $dbObjektBezeichnung->db_select_all_objektBezeichnung();
        }
    }
    
    /**
     * Template ausführen, ObjektBezeichnungsverwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."objektbezeichnungsverwaltung.htm.php");
    }
    
    /**
     * Wert für das gewünschte Feld zurückgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle objektBezeichnungen zurück
     * @return array mit allen objektBezeichnungen
     */
    public function getObjektbezeichnungsListe(){
        foreach ($this->dbobjektBezeichnungen as $bezeichnung) {
            array_push($this->objektBezeichnungen, new objektBezeichnungData($bezeichnung["idobjektbezeichnung"], $bezeichnung["name"]));
        }
        return $this->objektBezeichnungen;
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
}

?>