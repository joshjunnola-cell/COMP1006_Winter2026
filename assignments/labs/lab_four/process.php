<?php
require "includes/connect.php";

//  TODO: connect to the database 

//   TODO: Grab form data (no validation or sanitization for this lab)
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];


/*
  1. Write an INSERT statement with named placeholders
  2. Prepare the statement
  3. Execute the statement with an array of values
  4.

*/
$sql = "
    INSERT INTO subscribers (
    first_name,
    last_name,
    email
    ) VALUES (
    :first_name,
    :last_name,
    :email
    )
";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':email', $email);

$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing, <?= htmlspecialchars($first_name) ?> <?= htmlspecialchars($last_name) ?></h2>

        <p>You will be sent a confirmation email at <?= htmlspecialchars($email) ?></p>
        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->


        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>