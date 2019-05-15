<?php
/**
 * @author Marco Sturzo.
 * @date 8. Mai 2018
 *
 * Implementiert die anwendungslogik f�r das Raumverwaltung.
 *
 */
//require_once("class.basic.php");
require_once("interface.subcontroller.php");
//require_once("classes.dbKontakte.php");

class raumListe implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    private $dbR�ume;
    private $r�ume=array();
    
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    // Default CSS-Klassen f�r alle Eingabefelder
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
     *  Entsprechende Methode ausf�hren (je nachdem welcher Schaltknopf bet�tigt wurde)
     */
    public function run() {
        $dbRaum = new dbRaum();
        if ( isset($this->params['search']) ) {
            $this->dbR�ume = $dbRaum->db_search_raum($this->params);
        } elseif ( isset($this->params['delete']) ) {
            $dbRaum->db_delete_raum($this->params);
            $this->redirect("raumListe");
        } else{
            $this->dbR�ume = $dbRaum->db_select_all_raum();
        }
    }
    
    /*
     * Template ausf�hren, Kontaktformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."raumverwaltung.htm.php");
    }
    
    /*
     * Wert f�r das gew�nschte Feld zur�ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
    }
    
    public function getRaumListe(){
        foreach ($this->dbR�ume as $raum) {
            array_push($this->r�ume, new raumData($raum["idraum"], $raum["name"], $raum["nummer"]));
        }
        return $this->r�ume;
    }
    
    /*
     * Aktive Klasse f�r das �bergebene Feld zur�ckgeben
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