<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 *
 * Modul index.php.
 * Instanziert den Controller und registriert die Subcontroller.
 *
 */
header('Content-Type: text/html; charset=iso-8859-1');
require_once ("class.kontaktData.php");
require_once ("class.kontaktListe.php");
session_start();
require_once("class.controller.php");
require_once("../config/config.php");
require_once("class.basic.php");
require_once("class.db.php");
require_once("class.dbKontakte.php");
require_once("./Klassen/raumData.php");
require_once("class.dbRaum.php");
require_once("class.raum.php");
require_once("class.raumListe.php");

$c = new controller("index.htm.php", config::TEMPLATE_PATH );
$c->registerSubcontroller("kontakt", "Kontaktformular", false);
$c->registerSubcontroller("liste", "Kontaktliste", false);
$c->registerSubcontroller("datum", "", true);
$c->registerSubcontroller("raumListe", "Raumverwaltung", false);
$c->registerSubcontroller("raum", "", false);
$c->dispatch();
$c->sendOutput();

?>