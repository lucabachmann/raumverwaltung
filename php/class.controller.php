<?php
/**
 * @autor Marco Sturzo
 * @date 8. Mai 2019
 *
 * Der Controller nimmt http-Anfragen entgegen, ruft die gewünschten Subcontroller auf, 
 * nimmt den von den Subcontrollern produzierte Output entgegen, fügt diesen in an der
 * entsprechenden Position im Haupttemplate ein und sendet die gesamte HTML-Seite dem Browser.
 * 
 * Subcontroller werden über die Methode register_class() registriert. Der erste Parameter weist
 * den Namen der Klasse auf, welche den Subcontroller implementiert, der zweite Parameter bestimmt,
 * ob ein Subcontroller immer (permanent) oder nur, falls über die URL verlangt, ausgeführt wird.
 *
 * Der Output der Subcontroller wird mit dem Befehl $this->content( $class ) in das
 * Haupttemplate eingefügt, wobei der Parameter den Subcontroller identifiziert. Wird
 * $this->content() ohne Parameter aufgerufen, wird der Output des "verlangten" Subcontrollers
 * eingefügt, was sich typischerweise für den Inhaltsbereich eignet.  
 * 
 * Der "verlangte" Subcontroller via Parameter "show" oder "id" in der URL übergeben.
 * Beispiel: Die URL "http://.../controller.php?show=beispielclasse" führt zur Instanzierung der Klasse
 * "beispielklasse", welche im Modul "beispielklasse.php" definiert ist.  
 *
 * Der Controller kann direkt instanziert werden, oder als Basisklasse dienen.
 *
 */
class controller {
	private $dispatch_classes = array();        // Liste mit den registrierten Subcontrollern
	private $active_objects = array();          // Liste mit den Objekten der aktiven Subcontroller
        private $requested_subcontroller = NULL;    // Der Subcontroller, welcher ausgeführt wird (URL oder default)
        private $template_layout = NULL;            // Dateiname des Haupttmplates
	private $template_path = "";                // Pfad zum Haupttemplate
	private $class_path = "";                   // Pfad zu den Subcontrollern
	
	/**
	 * Konstruktor. Das Haupttemplate MUSS als Parameter übergeben werden!
	 * @param $template Dateiname des Haupttemplates
	 * @param $template_path Verzeichnispfad zu den Templates (php-Dateieb)
	 * @param $class_path Verzeichnispfad zu den Klassen (php-Dateien)
	 */
	function __construct( $template, $template_path="", $class_path="" ) {
		$this->template_layout = $template;
		$this->template_path = $template_path;
		$this->class_path = $class_path;
	}
	
	/**
	 * Mit dieser Methode lassen sich "Subcontroller" registrieren.
	 * Die Subcontroller-Klassen müssen die Schnittstelle "subcontroller" implementieren.
	 *
	 * @param $class Name der zu registrierenden Klasse
	 * @param $always Falls true: Der Subcontroller wird IMMER ausgeführt, auch wenn nicht über die URL verlangt
	 * @param $menuoption Text, welcher im Menu angezeigt wird, falls leer: Subcontroller wird im Menu nicht angezeigt
	 */
	function registerSubcontroller( $class, $menuoption="", $always=false ) {
                if ( empty($class) ) die("Der Name des Subcontrollers muss angegeben werden!");
		$this->dispatch_classes[] = array ( 'class' => $class, 'always' => $always, 'menu' => $menuoption );
	}
	
	/**
	 * Der Dispatcher instanziert die entsprechenden Subkontroller und führt
	 * diese aus ( runSubcontroller() ).
	 */
	function dispatch() {
                $url_subcontroller = "";
                // Der Name des Subcontrollers wird über die URL, via Parameter "show" oder "id" übergeben
                if ( isset($_REQUEST['show']) ) $url_subcontroller = $_REQUEST['show'];
                if ( isset($_REQUEST['id']) ) $url_subcontroller = $_REQUEST['id'];

                // Alle "permanenten" Subcontroller und der via URL übergebene Subcontroller werden ausgeführt
		foreach( $this->dispatch_classes as $dclass ) {
			if ( ($dclass['always'] == true) || ($url_subcontroller == $dclass['class']) ) {
				$this->runSubcontroller( $dclass['class'] );
				if ( $url_subcontroller == $dclass['class'] ) {
                                    $this->requested_subcontroller = $url_subcontroller;
                                }
			}
		}

                // Falls die Variable $requested_object immer noch nicht initialisiert ist, wird der zuerst registrierte Subcontroller ausgeführt
                // Das ist der Fall, wenn in der URL kein oder ein falscher Subcontroller angegeben wurde
                if ( $this->requested_subcontroller == NULL ) {
		//if ( $this->active_objects[$this->requested_subcontroller] == NULL ) {
                        $this->requested_subcontroller = $this->dispatch_classes[0]['class'];
			$this->runSubcontroller( $this->requested_subcontroller );
		}
	}
	
	/**
	 *  Instanzieren ( new $class() ) und ausführen ( run() ) der Subcontroller.
	 */	
	private function runSubcontroller( $class ) {
		require_once( "class.".$class.".php" );
		$this->active_objects[$class] = new $class( $this->template_path );
		$this->active_objects[$class]->run();
	}
	
	/**
	 * Diese Methode wird im Haupttemplate aufgerufen um dynamischen Inhalt
	 * einzufügen.
	 * @param $class Subcontroller (Klasse), welcher den Inhalt liefert
	 */
	function content( $class=NULL ) {
		if ( $class == NULL ) return $this->active_objects[$this->requested_subcontroller]->getOutput();
		else return $this->active_objects[$class]->getOutput();
	}
	
	/**
	 * Diese Methode sendet den Output an den Browser!
	 */
	function sendOutput() {
		include($this->template_path."/".$this->template_layout);
	}

	/**
	 * Beliebige Funktion des Subcontrollers ausführen.
	 * @param $func Name der Funktion
	 * @param $param Parameter der Funktion $func
	 */	
	function execute( $func, $param ) {
		return $this->requested_object->$func( $param );
	}

	/**
	 * Menu erstellen und ausgeben (Tabelle mit der Klasse "menu_table", Link der Klasse "link_menu", aktiver Link mid der ID "active").
         * @param $title Titel des Menus
         * @param $horizontal Falls true: Horizontale Darstellung der Menuoptionen, falls false: Vertikale Darstellung
	 */
	function menu( $title="", $horizontal=false ) {
            if ( count($this->dispatch_classes)) {
                $printmenu = "<table class=\"table_menu\">";
                if ( !empty($title) && !$horizontal ) $printmenu .= "<tr><th align=\"left\">$title</th></tr>";
                if ($horizontal) $printmenu .= "<tr>";
                foreach ( $this->dispatch_classes as $class ) {
                    if ( !empty($class['menu']) ) {
                        if (!$horizontal) $printmenu .= "<tr>";
                        $active = "";
                        if ($class['class'] == $this->requested_subcontroller) $active = "id=active";
                        $printmenu .= "<td><a class=\"link_menu\" $active href=\"".$_SERVER['PHP_SELF']."?id=".$class['class']."\">".
                        $class['menu']."</a></td>";
                        if (!$horizontal) $printmenu .= "</tr>";
                    }
                }
                if ($horizontal) $printmenu .= "</tr>";
                $printmenu .= "</table>";
            }
            echo $printmenu;
	}
        
	/**
	 * Menu erstellen und ausgeben (Bootstrap-Stil)
         * 
         * @param $template HTML-Template
	 */
	function menu_bootstrap($template) {
            $printmenu = "";
            if ( count($this->dispatch_classes)) {
                foreach ( $this->dispatch_classes as $class ) {
                    if ( !empty($class['menu']) ) {
                        $active = "";
                        if ($class['class'] == $this->requested_subcontroller) $active = "active";                        
                        $printmenu .= "<li class=\"nav-item\"><a class=\"nav-link $active\" href=\"".$_SERVER['PHP_SELF']."?id=".$class['class']."\">".$class['menu']."</a></li>";
                    }
                }
            }
            include($template);
	}

}
?>