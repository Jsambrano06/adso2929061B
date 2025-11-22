<?php

$tittle = "04 - collaboration";
$descripcion = "Perform logic operations on variables";

include_once 'template/header.php';
echo '<section>';

class Evolve
{
    public function evolvePokemon($origin, $evolution)
    {
        echo "<ul>
                <li style='display: flex; justify-content: space-between; align-items: center;'>
                    <span> {$origin}</span> <span>➡️</span> <span>{$evolution}</span> 
                </li>
              </ul>";
    }
}

class Pokemon {
    private $origin;
    private $evolution;
    private $collaboration;

    public function __construct($origin, $evolution) {
        $this->origin = $origin;
        $this->evolution = $evolution;
        //collaboration
        $this->collaboration = new Evolve();
    }
    public function nextLevel(){
        $this->collaboration->evolvePokemon($this->origin, $this->evolution);
    }
}

$ev1 = new Pokemon("Pichu", "Pikachu");
$ev1->nextLevel();
$ev2 = new Pokemon("Pikachu", "Raichu");
$ev2->nextLevel();
$ev3 = new Pokemon("Charmander", "Charmeleon");
$ev3->nextLevel();
$ev4 = new Pokemon("Charmeleon", "Charizard");
$ev4->nextLevel();
$ev5 = new Pokemon("Bulbasaur", "Ivysaur");
$ev5->nextLevel();
$ev6 = new Pokemon("Ivysaur", "Venusaur");
$ev6->nextLevel();


include_once 'template/footer.php';
