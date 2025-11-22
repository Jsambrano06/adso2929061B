<?php

$tittle = "03 - private";
$descripcion = "Perform logic operations on variables";

include_once 'template/header.php';
echo '<section>';

class RenderTable
{
    private $nr;
    private $nc;

    public function __construct($nr, $nc){
        $this->nr = $nr;
        $this->nc = $nc;
        //access to private methods
        $this->startTable();
        $this->bodyTable();
        $this->endTable();
    }

    private function startTable(){
        echo "<table>";
    }
    private function bodyTable(){
        echo "<h3> Table ({$this->nr}x{$this->nc})</h3>";
        for($r = 1; $r <= $this->nr; $r++) {
            echo "<tr>";
            for($c = 1; $c <= $this->nc; $c++) {
                echo "<td> f{$r}c{$c} </td>";
            }
            echo "</tr>";
        }
    }
    private function endTable(){
        echo "</table>";
    }
}

$tbl = new RenderTable(5, 5);
$tbl = new RenderTable(3, 8);
$tbl = new RenderTable(2, 2);
include 'template/footer.php';
