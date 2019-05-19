<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik für das Objektverwaltung.
 *
 */
require_once("interface.subcontroller.php");

class objektListe implements subcontroller {
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
        $dbObjekt = new dbObjekt();
        if ( isset($this->params['search']) ) {
            $this->dbobjekte = $dbObjekt->db_search_objekt($this->params);
        } elseif ( isset($this->params['delete']) ) {
            if(userHelper::isUserAdmin()) {
                $dbObjekt->db_delete_objekt($this->params);
            }
            $this->redirect("objektListe");
        } elseif  ( isset($this->params['kid']) ) {
            if(userHelper::isUserAdmin()) {
                $dbKomponent = new dbKomponent();
                $dbKomponent->db_delete_komponent($this->params);
            }
            $this->redirect("objektListe");
        } else {
            $this->dbobjekte = $dbObjekt->db_select_all_objekt();
        }
    }
    
    /**
     * Template ausführen, Objektverwaltung anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."objektverwaltung.htm.php");
    }
    
    /**
     * Wert für das gewünschte Feld zurückgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    /**
     * Gibt alle objekte zurück
     * @return array mit allen objekten
     */
    public function getObjektListe(){
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