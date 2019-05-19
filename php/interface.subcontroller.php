<?php
/**
 * @author Marco Sturzo
 * @date 8. Mai 2019
 *
 *  Schnittstelle für die "Subcontroller". Diese Schnittstelle
 *  muss von den Klassen implementiert werden, welche beim 
 *  Controller (Klasse controller) registriert werden.
 *	
 */
interface subcontroller {
	/**
	 * Der Templatepfad wird als Parameter dem Konsstruktoren übergeben.
	 */	
	function __construct( $template_path );

	/**
	 * Führt den Subcontroller aus.
	 */
	function run();
	
	/**
	 * Gibt den vom Subcontroller produzierten Output (HTML) zurück.
	 */
	function getOutput();
}

?>