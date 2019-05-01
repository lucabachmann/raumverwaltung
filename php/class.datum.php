<?php 
require_once("interface.subcontroller.php");

/**
 * Gibt das aktuelle Datum aus
 */
class datum implements subcontroller {
	public function __construct( $template_path ) {
	}

	public function run() {
	}

	public function getOutput(){
            echo date("d.m.Y");
	}
}

?>