<?php
class coche
{
    public $ruedas;
    public $color;
    public $motor;

    public function __construct(int $ruedas, string $color, int $motor)
    {
        $this->ruedas = $ruedas;
        $this->color = $color;
        $this->motor = $motor;
    }

    function arrancar()
    {
        echo "Estoy arrancando<br>";
    }

    function girar()
    {
        echo "Estoy girando<br>";
    }

    function frenar()
    {
        echo "Estoy frenando<br>";
    }
    function getdetails()
    {
        return "El Golf es $this->color y tiene $this->ruedas ruedas<br>";
    }
}

$golf = new coche(4, "verde", 1600);
$ibiza = new coche(4, "rojo", 1400);
echo $golf->getdetails();
class camion
{
    public $ruedas;
    public $color;
    public $motor;

    public function __construct(int $ruedas, string $color, float $motor)
    {
        $this->ruedas = $ruedas;
        $this->color = $color;
        $this->motor = $motor;
    }

    public function arrancar()
    {
        echo "Estoy arrancando<br>";
    }

    public function girar()
    {
        echo "Estoy girando<br>";
    }

    public function getRuedas(): int
    {
        return $this->ruedas;
    }

    public function setRuedas(int $ruedas)
    {
        $this->ruedas = $ruedas;
    }

    public function frenar()
    {
        echo "Estoy frenando<br>";
    }
}

$iveco = new camion(16, "blanco", 12000.0);

echo "El camión tiene " . $iveco->ruedas . " ruedas y es de color " . $iveco->color . "<br>";
?>