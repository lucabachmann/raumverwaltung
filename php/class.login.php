<?php
/**
 * @author Silvia Bavetta
 * @date 8. Mai 2019
 *
 * Implementiert die anwendungslogik f�r das Loginform.
 *
 */
require_once("interface.subcontroller.php");

class login implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    // resultat vom login request
    private $login;
    
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
        if( isset($this->params['login'])){
            $dbLogin = new dbLogin();
            $this->login = $dbLogin->login($this->params);
            foreach($this->login as $user) {
                if(!empty($user)) {
                    $_SESSION["currentUser"] = new BenutzerData($user["iduser"], $user["username"], $user["password"] ,$user["name"], $user["surname"], $user["admin"]);
                    $_SESSION["adminNumber"] = $user["admin"];
                    $this->redirect();
                } else {
                    echo "Username or password are wrong!";
                }
            }
        }
    }
    
    /**
     * Template ausf�hren, loginscreen anzeigen
     */
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."login.htm.php");
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
     * Redirect...
     */
    private function redirect() {
        header("Location: index.php");
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