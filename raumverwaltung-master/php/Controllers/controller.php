<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 *
 * Implementiert die anwendungslogik f�r das Kontaktformular.
 *
 */
//require_once("class.basic.php");
require_once("interface.subcontroller.php");
//require_once("classes.dbKontakte.php");

class raum implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
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
        if ( isset($this->params['speichern']) ) {
            if( empty($this->params['hiddenidobjektBezeichnung'])){
                if ( $this->checkInput() ){
                    $this->insert();
                    
                    $ob = new dbObjektBezeichnung();
                    $objektBezeichnung = $ob->selectLatestObjektBezeichnung();
                    redirect("objektBezeichnung&obid=".$objektBezeichnung[0]->idobjektBezeichnung);
                }
            } else {
                if ( $this->checkInput() ) {
                    $this->update();
                    redirect("objektBezeichnung&obid=".$this->params['hiddenidobjektBezeichnung']);
                }
            }
        } else if ( isset($this->params['abbrechen']) ) {
            redirect("objektBezeichnungliste");
            
        } else if ( isset($this->params['obid']) ) {
            $ob = new dbObjektBezeichnung();
            $objektBezeichnung = $ob->selectFoundObjektBezeichnung($this->params['obid']);
            $this->params['idobjektBezeichnung'] = $objektBezeichnung[0]->idobjektBezeichnung;
            $this->params['bezeichnung'] = $objektBezeichnung[0]->bezeichnung;
            
        } else if (isset($this->params['neu'])){
            redirect("objektBezeichnung");
            
        } else if (isset($this->params['loeschen'])){
            $ob = new dbObjektBezeichnung();
            if($ob->checkDeleteObjektBezeichnung($this->params['hiddenidobjektBezeichnung'])){
                $this->delete();
                redirect("objektBezeichnungliste");
            } else {
                setValue('InfoObjektBezeichnung', showWarnungObjektBezeichnung());
            }
        }
    }
    
    /*
     * Template ausf�hren, Kontaktformular anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."objektBezeichnung.htm.php");
    }
    
    /*
     * Wert f�r das gew�nschte Feld zur�ckgeben
     */
    public function getData( $field ) {
        if ( empty($this->params[$field]) ) return "";
        else return $this->params[$field];
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
    private function redirect() {
        header("Location: ".$_SERVER['SCRIPT_NAME']);
        exit();
    }
    
    /*
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
    
    private function insert() {
        $ob = new dbObjektBezeichnung();
        $ob->insertObjektBezeichnung(new objektBezeichnungData(0,
            $this->params['bezeichnung']));
    }
    
    private function update() {
        $ob = new dbObjektBezeichnung();
        $ob->db_update_raum(new objektBezeichnungData($this->params['hiddenidobjektBezeichnung'],
            $this->params['bezeichnung']));
    }
    
    private function delete() {
        $r = new dbObjektBezeichnung();
        $r->deleteObjektBezeichnung($this->params['hiddenidobjektBezeichnung']);
    }
    
}

?>