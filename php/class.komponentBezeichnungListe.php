<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für das KomponentBezeichnungsverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class komponentBezeichnungListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db für alle komponentBezeichnungen
    private $dbkomponentBezeichnungen;
    
    // array mit allen komponentBezeichnungen
    private $komponentBezeichnungen=array();
    
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
     *  Entsprechende Methode ausfï¿½hren (je nachdem welcher Schaltknopf betï¿½tigt wurde)
     */
    public function run() {
        $dbKomponentBezeichnung = new dbKomponentBezeichnung();
        if ( isset($this->params['delete']) ) {
            if(userHelper::isUserAdmin()) {
                $dbKomponentBezeichnung->db_delete_komponentBezeichnung($this->params);
            }
            $this->redirect("komponentBezeichnungListe");
        } else{
            $this->dbkomponentBezeichnungen = $dbKomponentBezeichnung->db_select_all_komponentBezeichnung();
        }
    }
    
    /**
     * Template ausführen, KomponentBezeichnungVerwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."komponentenbezeichnungsverwaltung.htm.php");
    }
    
    /**
     * Wert für das gewünschte Feld zurückgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle komponentBezeichnungen zurück
     * @return array mit allen komponentBezeichnungen
     */
    public function getKomponentenbezeichnungsListe(){
        foreach ($this->dbkomponentBezeichnungen as $bezeichnung) {
            array_push($this->komponentBezeichnungen, new komponentBezeichnungData($bezeichnung["idkomponentenBezeichnung"], $bezeichnung["name"]));
        }
        return $this->komponentBezeichnungen;
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