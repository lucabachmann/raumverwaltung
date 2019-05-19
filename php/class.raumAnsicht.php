<?php
/**
 * @author Silvia Bavetta
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für die Druckansicht.
 *
 */
require_once("interface.subcontroller.php");

class raumAnsicht implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db für alle objekte
    private $dbobjekte;
    
    // array mit allen objekten
    private $objekte=array();
    
    // resultat der db für alle komponente
    private $dbkomponenten;
    
    // array mit allen komponenten
    private $komponenten=array();
    
    // resultat der db für alle räume
    private $dbRäume;
    
    // array mit allen räumen
    private $räume=array();
    
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
        
    }
    
    /**
     * Template ausfï¿½hren, Druckansicht anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."raumansicht.htm.php");
    }
    
    /**
     * Wert fï¿½r das gewï¿½nschte Feld zurï¿½ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Aktive Klasse fï¿½r das ï¿½bergebene Feld zurï¿½ckgeben
     */
    public function getCssClass( $field ) {
        return $this->input_classes[$field];
    }
    
    /**
     * Gibt alle räume zurück
     * @return array mit allen räumen
     */
    public function getRäume(){
        $dbRaum = new dbRaum();
        $this->dbRäume = $dbRaum->db_select_all_raum();
        foreach ($this->dbRäume as $raum) {
            array_push($this->räume, new raumData($raum["idraum"], $raum["name"], $raum["nummer"]));
        }
        return $this->räume;
    }
    
    /**
     * Gibt alle objekte von einem raum zurück
     * @return array mit allen objekten
     */
    public function getObjektListe(){
        $dbObjekt = new dbObjekt();
        $this->dbobjekte = $dbObjekt->db_get_objektForRaum($this->params);
        foreach ($this->dbobjekte as $objekt) {
            array_push($this->objekte, new objektData($objekt["idobjekt"], $objekt["bezeichnungId"], $objekt["raumId"]));
        }
        return $this->objekte;
    }
    
    /**
     * Gibt alle komponente für ein objekt zurück
     * @param int $oid objekt
     * @return array mit allen komponenten
     */
    public function getKomponente($oid){
        $this->komponenten = array();
        $dbKomponent = new dbKomponent();
        $this->dbkomponenten = $dbKomponent->db_select_all_komponentForObjekt($oid);
        foreach ($this->dbkomponenten as $komponent) {
            array_push($this->komponenten, new komponentData($komponent["idkomponent"], $komponent["komponentenBezeichnungId"], $komponent["komponentWertId"]));
        }
        return $this->komponenten;
    }
    
    /**
     * Redirect...
     */
    private function redirect($page) {
        header("Location: index.php?id=".$page);
        exit();
    }
    
    /**
     * Benutzereingaben prï¿½fen
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