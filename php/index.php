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
session_start();

require_once("class.controller.php");
require_once("../config/config.php");
require_once("class.userHelper.php");
require_once("class.basic.php");
require_once("class.db.php");

require_once("./Klassen/benutzerData.php");
require_once("class.dbBenutzer.php");
require_once("class.benutzer.php");
require_once("class.dbLogin.php");
require_once("class.login.php");
require_once("class.logout.php");

require_once("./Klassen/raumData.php");
require_once("class.dbRaum.php");
require_once("class.raum.php");
require_once("class.raumListe.php");

require_once("./Klassen/objektBezeichnungsData.php");
require_once("class.dbObjektBezeichnung.php");
require_once("class.objektBezeichnung.php");
require_once("class.objektBezeichnungListe.php");

require_once("./Klassen/komponentBezeichnungsData.php");
require_once("class.dbKomponentBezeichnung.php");
require_once("class.komponentBezeichnung.php");
require_once("class.komponentBezeichnungListe.php");

require_once("./Klassen/objektData.php");
require_once("class.dbObjektKomponent.php");
require_once("class.dbObjekt.php");
require_once("class.objekt.php");
require_once("class.objektListe.php");

require_once("./Klassen/komponentData.php");
require_once("class.dbKomponent.php");
require_once("class.komponent.php");

require_once("class.raumAnsicht.php");

$c = new controller("index.htm.php", config::TEMPLATE_PATH );
$c->registerSubcontroller("datum", "", true);
$c->registerSubcontroller("login", "", true);
$c->registerSubcontroller("logout", "", true);
$c->registerSubcontroller("raum", "", false);
$c->registerSubcontroller("raumListe", "Raum Verwaltung", false);
$c->registerSubcontroller("benutzer", "", false);
$c->registerSubcontroller("benutzerListe", "Benutzer Verwaltung", false);
$c->registerSubcontroller("objektBezeichnung", "", false);
$c->registerSubcontroller("objektBezeichnungListe", "Objekt Bezeichnung Verwaltung", false);
$c->registerSubcontroller("komponentBezeichnung", "", false);
$c->registerSubcontroller("komponentBezeichnungListe", "Komponent Bezeichnung Verwaltung", false);
$c->registerSubcontroller("objektListe", "Objekt Verwaltung", false);
$c->registerSubcontroller("objekt", "", false);
$c->registerSubcontroller("komponent", "", false);
$c->registerSubcontroller("raumAnsicht", "Druckansicht", false);
$c->dispatch();
$c->sendOutput();

?>