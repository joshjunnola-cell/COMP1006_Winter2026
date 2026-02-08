<?php 
require "includes/header.php"; 

//grab the data, clean and store in a variable (sanitize)
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);


$user = [
    'First Name' => $firstName,
    'Last Name'  => $lastName,
    'Email'      => $email,
    'Message'    => $message,
];
?>


<main>
    <h3> Email Sent: </h3>
    <ul>
        <!-- use for each loop to loop through array and display user inputs -->
    <?php foreach($user as $label => $input): ?>
        <li><?php echo $label ?> - <?php echo $input ?> </li>
    <?php endforeach; ?>
    </ul>
</main>

<!--send email using mail function -->
<?php
$to = "info@bakery.com";
$subject = "Customer Info/Request Form";

$emailBody = "
Customer Submission: 

First Name: $firstName
Last Name: $lastName
Email: $email
Message: $message;";

mail($to, $subject, $emailBody);

?> 

<?php require "includes/footer.php"; ?>