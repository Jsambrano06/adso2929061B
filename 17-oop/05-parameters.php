<?php

$tittle = "05 - parameters";
$descripcion = "Perform logic operations on variables";

include 'template/header.php';

echo '<section>';

class Country
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
}
class FifaWorldCup
{
    private $country;
    private $year;
    private $winner;

    public function __construct($country, $year, $winner = 'Brazil') {
        $this->country = $country;
        $this->year    = $year;
        $this->winner  = $winner;
    }
    public function showEvent() {
        echo "<ul>
                <li style='display: flex; flex-direction: column'>
                    <span><b>Country:</b> {$this->country->name}</span>
                    <span><b>Year:</b> {$this->year}</span>
                    <span><b>Winner:</b> {$this->winner}</span>
                </li>            
              </ul>";
    }
}

$country = new Country("Italy");
$worldCup = new FifaWorldCup($country, 1990, "Germany");
$worldCup->showEvent();

$country = new Country("USA");
$worldCup = new FifaWorldCup($country, 1994);
$worldCup->showEvent();

$country = new Country("France");
$worldCup = new FifaWorldCup($country, 1998, "France");
$worldCup->showEvent();

$country = new Country("Korea/Japan");
$worldCup = new FifaWorldCup($country, 2002);
$worldCup->showEvent();

$country = new Country("Germany");
$worldCup = new FifaWorldCup($country, 2006, "Italy");
$worldCup->showEvent();

include 'template/footer.php';
