<?php
declare(strict_types=1);

// Car information
$make = "Toyota"; //car make
$model = "Corolla"; //car model
$year = 2020; //car year

// Display car information
echo "<p> This car is a " . $year . ", " . $make . ", " . $model . ".</p>";

// Define a Car class
Class Car {
    public string $make;
    public string $model;
    public int $year;

    // Constructor to initialize car properties
    public function __construct(string $make, string $model, int $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Method to get car information
    public function getCarInfo(): string {
        return "Car Make: {$this->make} | Model: {$this->model} | Year: {$this->year}";
    }
}

// Create a new Car instance

$myCar = new Car("Honda", "Accord", 1990);

echo "<p>" . $myCar->getCarInfo() . "</p>";