<?php 
    class Model extends DataBase {
        protected $db;

        public function __construct(){
            $this->db = DataBase::connect();
        }

        public function listPokemons(){
            $stmt = $this->db->query("SELECT * FROM pokemons");
            return $stmt->fetchAll();
        }
        
    }
