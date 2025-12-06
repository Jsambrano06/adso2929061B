<?php 
    class Controller {
        public $load;
        public $model;

        public function __construct() {
            $this->load = new Load;
            $this->model = new Model;

            $pokemons = $this->model->listPokemons();
            $this->load->view('welcome.php', $pokemons);
        }
    }
