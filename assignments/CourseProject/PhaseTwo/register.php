<?php
session_start();
// ======= Re-used code from lesson 10 =========

// Include the database connection so we can interact with the users table
require "includes/connect.php";

// Include the site header (navigation, Bootstrap, etc.)
require "includes/header.php";

// Array to store validation errors
$errors = [];

// Variable to store a success message if the account is created
$success = "";

//Registration variables
$username = "";
$email = "";
$password = "";
$confirmPassword = "";

// Check if the form was submitted using POST
// This ensures the registration logic only runs when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve and sanitize the username from the form
    // filter_input helps clean user input
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));

    // Retrieve and sanitize the email address
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    // Retrieve password fields (no sanitizing because passwords may contain special characters)
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // -----------------------------
    // Server-side Validation
    // -----------------------------

    // Check that a username was entered
    if ($username === '') {
        $errors[] = "Username is required.";
    }

    // Check that an email was entered
    if ($email === '') {
        $errors[] = "Email is required.";
    }
    // Validate the email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email address.";
    }

    // Check that a password was entered
    if ($password === '') {
        $errors[] = "Password is required.";
    }

    // Check that the confirm password field was filled in
    if ($confirmPassword === '') {
        $errors[] = "Please confirm your password.";
    }

    // Check that both passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // Enforce a minimum password length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // --------------------------------------------------
    // Check if the username or email already exists
    // --------------------------------------------------

    // Only check the database if there are no validation errors so far
    if (empty($errors)) {

        // SQL query to check for existing username or email
        $sql = "SELECT id FROM users WHERE username = :username OR email = :email";

        // Prepare the SQL statement using PDO
        $stmt = $pdo->prepare($sql);

        // Bind user inputs to the query parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        // Execute the query
        $stmt->execute();

        // If a record is returned, the username or email is already in use
        if ($stmt->fetch()) {
            $errors[] = "That username or email is already in use.";
        }
    }

    // --------------------------------------------------
    // Insert the new user into the database
    // --------------------------------------------------

    // Only insert if there are still no errors
    if (empty($errors)) {

        // Hash the password before storing it in the database
        // This ensures passwords are not stored in plain text
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert the new user
        $sql = "INSERT INTO users (username, email, password)
                VALUES (:username, :email, :password)";

        // Prepare the insert statement
        $stmt = $pdo->prepare($sql);

        // Bind the values to the query parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the insert query
        $stmt->execute();

        // Set a success message
        $success = "Account created successfully. You can now log in.";
    }
}
?>

<main class="container mt-4">

    <h1 class="mb-4">Register</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Display success message if account creation succeeded -->
    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success); ?>
            <br>
            <!-- Provide a link to the login page -->
            <a href="login.php" class="btn btn-sm btn-success mt-2">Go to Login</a>
        </div>
    <?php endif; ?>

    <form action="register.php" method="post" class="card p-4 shadow-sm">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control"
                value="<?= htmlspecialchars($username) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                value="<?= htmlspecialchars($email) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Account</button>
    
    </form>
</main>

<?php require "includes/footer.php"; ?>