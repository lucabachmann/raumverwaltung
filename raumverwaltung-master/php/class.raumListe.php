<?php
/**
 * @author Marco Sturzo.
 * @date 8. Mai 2018
 *
 * Implementiert die anwendungslogik fï¿½r das Raumverwaltung.
 *
 */
//require_once("class.basic.php");
require_once("interface.subcontroller.php");
//require_once("classes.dbKontakte.php");

class raumListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    private $dbRäume;
    private $räume=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen fï¿½r alle Eingabefelder
    private $input_classes = array( 'bezeichnung' => config::INPUT_CLASS_N);
    
    private $db = null;
    
    /*
     * Konstruktor
     */
    public function __construct( $template_path ) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
    }
    
    /*
     *  Entsprechende Methode ausfï¿½hren (je nachdem welcher Schaltknopf betï¿½tigt wurde)
     */
    public function run() {
        $dbRaum = new dbRaum();
        if ( isset($this->params['search']) ) {
            $this->dbRäume = $dbRaum->db_search_raum($this->params);
        } elseif ( isset($this->params['delete']) ) {
            $dbRaum->db_delete_raum($this->params);
            $this->redirect("raumListe");
        } else{
            $this->dbRäume = $dbRaum->db_select_all_raum();
        }
    }
    
    /*
     * Template ausfï¿½hren, Kontaktformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."raumverwaltung.htm.php");
    }
    
    /*
     * Wert fï¿½r das gewï¿½nschte Feld zurï¿½ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    public function getRaumListe(){
        foreach ($this->dbRäume as $raum) {
            array_push($this->räume, new raumData($raum["idraum"], $raum["name"], $raum["nummer"]));
        }
        return $this->räume;
    }
    
    /*
     * Aktive Klasse fï¿½r das ï¿½bergebene Feld zurï¿½ckgeben
     */
    public function getCssClass( $field ) {
        return $this->input_classes[$field];
    }
    
    /*
     * Redirect...
     */
    private function redirect($page) {
        header("Location: index.php?id=".$page);
        exit();
    }
}

?>