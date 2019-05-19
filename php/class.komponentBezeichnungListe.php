<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r das KomponentBezeichnungsverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class komponentBezeichnungListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db f�r alle komponentBezeichnungen
    private $dbkomponentBezeichnungen;
    
    // array mit allen komponentBezeichnungen
    private $komponentBezeichnungen=array();
    
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
     * Template ausf�hren, KomponentBezeichnungVerwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."komponentenbezeichnungsverwaltung.htm.php");
    }
    
    /**
     * Wert f�r das gew�nschte Feld zur�ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle komponentBezeichnungen zur�ck
     * @return array mit allen komponentBezeichnungen
     */
    public function getKomponentenbezeichnungsListe(){
        foreach ($this->dbkomponentBezeichnungen as $bezeichnung) {
            array_push($this->komponentBezeichnungen, new komponentBezeichnungData($bezeichnung["idkomponentenBezeichnung"], $bezeichnung["name"]));
        }
        return $this->komponentBezeichnungen;
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
}

?>