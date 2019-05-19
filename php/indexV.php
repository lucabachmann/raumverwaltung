<?php
/**
 * @author Marco Sturzo
 * @date 8. Mai 2019
 *
 * Modul index.php.
 * Instanziert den Controller und registriert die Subcontroller.
 *
 */
header('Content-Type: text/html; charset=iso-8859-1');
include_once("class.controller.php");
include_once("../config/config.php");

$c = new controller("indexV.htm.php", config::TEMPLATE_PATH );
$c->registerDatabase( "dbMVC_GIBS");
$c->registerSubcontroller("kontakt", "Kontaktformular", false);
$c->registerSubcontroller("liste", "Kontaktliste", false);
$c->registerSubcontroller("datum", "", true);
$c->dispatch();
$c->sendOutput();

?>