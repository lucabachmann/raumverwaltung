<?php
/**
 * @author Silvia Bavetta
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r die Druckansicht.
 *
 */
require_once("interface.subcontroller.php");

class raumAnsicht implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat der db f�r alle objekte
    private $dbobjekte;
    
    // array mit allen objekten
    private $objekte=array();
    
    // resultat der db f�r alle komponente
    private $dbkomponenten;
    
    // array mit allen komponenten
    private $komponenten=array();
    
    // resultat der db f�r alle r�ume
    private $dbR�ume;
    
    // array mit allen r�umen
    private $r�ume=array();
    
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
        
    }
    
    /**
     * Template ausf�hren, Druckansicht anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."raumansicht.htm.php");
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
     * Gibt alle r�ume zur�ck
     * @return array mit allen r�umen
     */
    public function getR�ume(){
        $dbRaum = new dbRaum();
        $this->dbR�ume = $dbRaum->db_select_all_raum();
        foreach ($this->dbR�ume as $raum) {
            array_push($this->r�ume, new raumData($raum["idraum"], $raum["name"], $raum["nummer"]));
        }
        return $this->r�ume;
    }
    
    /**
     * Gibt alle objekte von einem raum zur�ck
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
     * Gibt alle komponente f�r ein objekt zur�ck
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