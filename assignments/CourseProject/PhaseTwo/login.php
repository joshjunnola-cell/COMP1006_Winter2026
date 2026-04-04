<?php

// ======= Re-used code from lesson 10 =========

session_start(); //Starts the session
require "includes/connect.php";
require "includes/header.php";

$error = "";
$usernameOrEmail = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usernameOrEmail === '' || $password === '') {
        $error = "Username/email and password are required.";
    } else {
        $sql = "SELECT id, username, email, password
                FROM users
                WHERE username = :login OR email = :login
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $usernameOrEmail);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid credentials. Please try again.";
        }
    }
}
?>

<h1 class="mb-4">Login</h1>

<?php if ($error !== ""): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<form action="login.php" method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Username or Email</label>
        <input type="text" name="username_or_email" class="form-control" value="<?=  htmlspecialchars($usernameOrEmail) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-secondary">Sign Up</a>

</form>

    <?php require "includes/footer.php"; ?>