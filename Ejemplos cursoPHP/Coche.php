<?php
class Coche
{
    // Properties
    public $color;
    public $model;

    // Constructor
    public function __construct($color, $model)
    {
        $this->color = $color;
        $this->model = $model;
    }

    // Methods
    public function getDetails()
    {
        return "This car is a $this->color $this->model.";
    }
}

// Code outside the class
$renault = new Coche('red', 'Clio');
echo "<h1>" . $renault->getDetails() . "</h1>";
?>