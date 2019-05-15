<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 *
 * Implementiert die anwendungslogik für das Kontaktformular.
 *
 */
//require_once("class.basic.php");
require_once("interface.subcontroller.php");
//require_once("classes.dbKontakte.php");

class kontakt implements subcontroller {
	// Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
	private $params = NULL;
	
	// Pfad zum Template-Verzeichnis
	private $template_path = "";

	// Default CSS-Klassen für alle Eingabefelder
	private $input_classes = array( 'name' => config::INPUT_CLASS_N, 
					'vorname' => config::INPUT_CLASS_N, 
					'email' => config::INPUT_CLASS_N );

	/*
         * Konstruktor
         */
	public function __construct( $template_path ) {
		$this->params = $_REQUEST;
		$this->template_path = $template_path;
	}
	
	/*
         *  Entsprechende Methode ausföhren (je nachdem welcher Schaltknopf betätigt wurde)
         */
	public function run() {
		if ( isset($this->params['senden']) ) {
			if ( $this->checkInput() ) {
				$this->save();
				$this->redirect();
			}
		} else if ( isset($this->params['abbrechen']) ) {
			$this->redirect();
		}
	}

        /*
         * Template ausführen, Kontaktformular anzeigen
         */
	public function getOutput(){
		$v =& $this;
		include($this->template_path."/"."kontakt.htm.php");
	}
	
	/*
         * Wert für das gewünschte Feld zurückgeben
         */
	public function getData( $field ) {
            if ( empty($this->params[$field]) ) return ""; 
            else return $this->params[$field];
	}

	/*
         * Aktive Klasse für das übergebene Feld zurückgeben
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
         * Benutzereingaben prüfen
         */
	private function checkInput() {
		$input_ok = true;
		
                if ( !basic::CheckName($this->params['name'])) {
                        $this->input_classes['name'] = config::INPUT_CLASS_E;
			$input_ok = false; 
                }
                
                if ( !basic::CheckName($this->params['vorname'])) {
                        $this->input_classes['vorname'] = config::INPUT_CLASS_E;
			$input_ok = false; 
                }  
                
                if ( !basic::CheckEmail($this->params['email'])) {
                        $this->input_classes['email'] = config::INPUT_CLASS_E;
			$input_ok = false; 
                }                
		
		return $input_ok;
	}
	
	/*
         * Kontakt in DB speichern
         */
	private function save() {
            $k = new dbKontakte();
            $k->insertKontakt(new kontaktData(0,
                              $this->params['name'],
                              $this->params['vorname'],
                              $this->params['strasse'],
                              $this->params['plz'],
                              $this->params['ort'],
                              $this->params['email'],
                              $this->params['tpriv'],
                              $this->params['tgesch']) );
	}
	
}

?>