<?php

    $tittle = "06 - extends";
    $descripcion = "Perform logic operations on variables";

include 'template/header.php';

echo '<section>';

class Operation
{
    protected $num1;
    protected $num2;

    public function __construct($num1, $num2){
        $this->num1 = $num1;
        $this->num2 = $num2;
    }
}

class Addition extends Operation{
    public function showResult(){
        $result = $this->num1 + $this->num2;
        return "<ul>
                    <li> {$this->num1} + {$this->num2} = {$result}</li>
                </ul>";
    }
}

class Substraction extends Operation{
    public function showResult(){
        $result = $this->num1 - $this->num2;
        return "<ul>
                    <li> {$this->num1} - {$this->num2} = {$result}</li>
                </ul>";
    }
}

class Product extends Operation{
    public function showResult(){
        $result = $this->num1 * $this->num2;
        return "<ul>
                    <li> {$this->num1} * {$this->num2} = {$result}</li>
                </ul>";
    }
}

class Division extends Operation{
    public function showResult(){
        $result = $this->num1 / $this->num2;
        return "<ul>
                    <li> {$this->num1} / {$this->num2} = {$result}</li>
                </ul>";
    }
}

$op1 = new Addition(128, 256);
echo $op1->showResult();
$op2 = new Substraction(512, 256);
echo $op2->showResult();
$op3 = new Product(512, 256);
echo $op3->showResult();
$op4 = new Division(512, 256);
echo $op4->showResult();


include 'template/footer.php';
