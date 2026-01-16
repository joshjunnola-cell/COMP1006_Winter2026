<?php
//Make PHP strict, needs to be at the start of your script
declare(strict_types=1);

require_once "connect.php";

//.1 Code commenting example

// Inline comment

/*
  Multi-line comment
  explaining the following code block
*/

//.2 Variables, Data Types, Concatenation & Conditional Statements

$firstName = "Josh"; //String
$lastName = "Junnola-Nagy"; //String
$age = 26; //Int
$isInstructor = true; //Boolean

echo "<p> Hello there, my name is " . $firstName . " " . $lastName . "</p>";

if($isInstructor) {
    echo "<p> I am your teacher.</p>";
}
else {
    echo "<p> Whoops, teach didn't show! </p>";
}

//.3 PHP is loosely typed
//create two variables, one called num1 and one called num2, in num1 store a integer value and in num2 store a number but treat as string "10"

$num1 = 10; //Integer
$num2 = "10"; //String


//Add type hints to make PHP less loosey goosey
// function add(int $num1,int $num2) : int {
//     return $num1 + $num2;
// }

// echo "<p>" . add($num1, $num2) . "</p>";

// OOP with PHP

class Person {
    public string $name;
    public int $age;
    public bool $isInstructor;

    public function __construct(string $name, int $age, bool $isInstructor) {
        $this->name = $name;
        $this->age = $age;
        $this->isInstructor = $isInstructor;
    }

    public function getBadge(): string {
        $role = $this->isInstructor ? "Instructor" : "student";
        return "Name : {$this->name} | Age: {$this->age} | Role: $role";
    }
}

//Create an instance of the object

$person = new Person ("Josh Junnola-Nagy", 26, true);

echo $person -> getBadge();