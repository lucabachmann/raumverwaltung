<?php
/**
 * @author Luca Bachmann
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r das Objektform.
 *
 */
require_once("interface.subcontroller.php");

class objekt implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // Benutzerdaten falls ein edit gemacht wird
    public $objekt;
    
    // resultat der db f�r alle ObjektBezeichnungen
    private $dbobjektBezeichnungen;
    
    // array mit allen ObjektBezeichnungen
    private $objektBezeichnungen=array();
    
    // resultat der db f�r alle r�ume
    private $dbR�ume;
    
    // array mit allen r�umen
    private $r�ume=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen f�r alle Eingabefelder
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
     *  Entsprechende Methode ausf�hren (je nachdem welcher Schaltknopf bet�tigt wurde)
     */
    public function run() {
        if( isset($this->params['abbrechen'])){
            $this->redirect("objektListe");
        }
        $dbObjekt = new dbObjekt();
        if(!empty($this->params['oid'])){
            $objektDb = $dbObjekt->db_get_selected_objekt($this->params);
            foreach($objektDb as $objekt){
                $this->objekt = new objektData($objekt["idobjekt"], $objekt["bezeichnungId"], $objekt["raumId"]);
            }
        }
        if ( isset($this->params['speichern']) ) {
            if( empty($this->params['oid'])){
                if ( $this->checkInput() ){
                    $this->insertObjekt();
                    $this->redirect("objektListe");
                }
            } else {
                if ( $this->checkInput() ) {
                    $this->updateObjekt();
                    $this->redirect("objektListe");
                }
            }
        }
    }
    
    /**
     * Template ausf�hren, Objektformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."objekt.htm.php");
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
     * Gibt alle objekte zur�ck
     * @return array mit allen objekten
     */
    public function getObjektBezeichnungen(){
        $dbObjektBezeichnung = new dbObjektBezeichnung();
        $this->dbobjektBezeichnungen = $dbObjektBezeichnung->db_select_all_objektBezeichnung();
        foreach ($this->dbobjektBezeichnungen as $bezeichnung) {
            array_push($this->objektBezeichnungen, new objektBezeichnungData($bezeichnung["idobjektbezeichnung"], $bezeichnung["name"]));
        }
        return $this->objektBezeichnungen;
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
     * neues objekt in die db einf�gen
     */
    private function insertObjekt() {
        $dbObjekt = new dbObjekt();
        $dbObjekt->db_insert_objekt($this->params);
    }
    
    /**
     * bestehndes objekt in der db aktualisieren
     */
    private function updateObjekt() {
        $dbObjekt = new dbObjekt();
        $dbObjekt->db_update_objekt($this->params);
    }
}

?>