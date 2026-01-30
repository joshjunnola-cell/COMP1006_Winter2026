<?php 
require "includes/header.php";
// Access the form data and then echo on the page in a confirmation message
/*
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$address = $_POST['address'];
$email = $_POST['email'];
$items = $_POST['items'];
*/

/* A better way!

Sanitize the data - filter_input and validate - filter_var (proper email format, proper phone number format, interger for order quantities) and logic to ensure users provide required info
*/

//grab the data, clean and store in a variable - sanitize!
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$items = $_POST['items'] ?? [];

//validation time - serverside

$errors = [];

//require text fields
if ($firstName === null || $firstName === ''){
    $errors[] = "First Name is Required";
}

if ($lastName === null || $lastName === ''){
    $errors[] = "Last Name is Required";
}

//email validation

if ($email === null || $email === '') {
    $errors[] = "Email is Required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Email is not formatted correctly!";
}

//address validation
if ($address === null || $address === '') {
    $errors[] = "Address is Required.";
}

$itemsOrdered = [];
//check that the order quantity is a number

foreach($items as $item => $quantity) {
    if(filter_var($quantity, FILTER_VALIDATE_INT) !== false && $quantity > 0) {
        $itemsOrdered[$item] = $quantity;
    }
}

if(count($itemsOrdered) === 0) {
    $errors[] = "Please order at least one item";
}

//loops through error messages

if(!empty($errors)){
foreach ($errors as $error): ?>
    <li><?php echo $error; ?> </li>
<?php endforeach; 
//stops the script from executing
exit;
}
?>


<main>
   <?php echo "<h2> Thank you for filling out a order! " . $firstName . "</h2>"; ?>
    <h3> Items Ordered </h3>
    <ul>
        <!-- use for each loop to loop through array and display quantities -->
        <?php foreach($items as $item => $quantity): ?>
            <li><?php echo $item ?> - <?php echo $quantity ?> </li>
        <?php endforeach; ?>
    </ul>

</main>

<!-- Send email using mail function -->

<?php //mail ($to, $subject, $message); ?>

<?php require "includes/footer.php"; ?>