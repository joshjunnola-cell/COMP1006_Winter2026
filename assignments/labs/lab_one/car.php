<?php
declare(strict_types=1);

$make = "Toyota";
$model = "Corolla";
$year = 2020;

echo "<p> This car is a " . $year . ", " . $make . ", " . $model . ".</p>";

Class Car {
    public string $make;
    public string $model;
    public int $year;

    public function __construct(string $make, string $model, int $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    public function getCarInfo(): string {
        return "Car Make: {$this->make} | Model: {$this->model} | Year: {$this->year}";
    }
}