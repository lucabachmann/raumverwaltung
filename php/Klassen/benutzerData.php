<?php
/**
 * @autor Marco Sturzo
 * @date 15. Mai 2019
 *
 * Model für Benutzer
 */
    class BenutzerData
    {
        private $id;
        private $username;
        private $password;
        private $name;
        private $surname;
        private $admin;
        
        /**
         * Konstruktor
         */
        public function __construct($id, $username, $password, $name, $surname, $admin)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->surname = $surname;
            $this->admin = $admin;
        }
        
        public function getUid() {
            return $this->id;
        }
        
        public function getUsername() {
            return $this->username;
        }
        
        public function getPassword() {
            return $this->password;
        }
        
        public function getName() {
            return $this->name;
        }
        
        public function getVorname() {
            return $this->surname;
        }
        
        public function getAdmin() {
            return $this->admin;
        }
    }
?>