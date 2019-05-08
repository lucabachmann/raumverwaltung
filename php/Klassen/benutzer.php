<?php
    public class Benutzer
    {
        private $id;
        private $username;
        private $password;
        private $name;
        private $surname;
        private $admin;
        
        public function __construct($id, $username, $password, $name, $surname, $admin)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->surname = $surname;
            $this->admin = $admin;
        }
    }
?>