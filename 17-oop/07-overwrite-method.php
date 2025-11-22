<?php

    $tittle = "07 - overwrite-method";
    $descripcion = "Perform logic operations on variables";

include 'template/header.php';
    echo '<section>';
    class VideoGame {
        protected $name;
        protected $platform;

        public function __construct($name, $platform) {
            $this->name     = $name;
            $this->platform = $platform;
        }
        public function showVideoGame() {
            echo "Platform: {$this->platform} </li></ul>";
        }
    }
    class GameConsole extends VideoGame {
        public function showVideoGame() {
            echo "<ul><li> Name: {$this->name} <br>";
            parent::showVideoGame();
        }
    }
    $gm = new GameConsole('Hollow Knight: Silk Song', 'Nintendo Switch');
    $gm->showVideoGame();
    $gm = new GameConsole('Metroid Prime 4', 'Nintendo Switch');
    $gm->showVideoGame();
    $gm = new GameConsole('Death Stranding 2', 'Play Station 5');
    $gm->showVideoGame();
    $gm = new GameConsole('Expedition 33', 'Xbox Series X');
    $gm->showVideoGame();

include 'template/footer.php';
