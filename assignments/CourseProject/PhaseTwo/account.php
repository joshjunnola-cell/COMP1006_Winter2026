<?php
//page handles updating account info/deleting account
require "includes/connect.php";
require "includes/auth.php";
require "includes/header.php";

$user_id = $_SESSION['user_id'];

//gets current user info
$sql = "SELECT username, email 
        FROM users
        WHERE id = :id";
//prepare/execute        
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$errors = [];
$success = "";

// if handles account updates
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_account'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    //validation
    if ($username === "")
        $errors[] = "Username is required!";

    //min username length requirement
    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email required!";
    }

    // if password fields filled, validate
    $passwordUpdate = "";

    if ($password !== "" || $confirm !== "") {
        if ($password !== $confirm) {
            $errors[] = "Passwords do not match.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $passwordUpdate = ", password = :password";
        }
    }

    //checks databse if username or email already exists
    $sql = "SELECT id
            FROM users
            WHERE (username = :username OR email = :email)
            AND id != :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':id' => $user_id
    ]);

    if ($stmt->fetch()) {
        $errors[] = "Username or email already in use.";
    }

    // if no errors, update
    if (empty($errors)) {
        $sql = "UPDATE users
                SET username = :username,
                    email = :email
                    $passwordUpdate
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $params = [
            ':username' => $username,
            ':email' => $email,
            ':id' => $user_id
        ];

        if ($passwordUpdate !== "") {
            $params[':password'] = $hashed;
        }

        $stmt->execute($params);

        $_SESSION['username'] = $username;
        $success = "Account has been updated successfully!";
    }
}

// handles account deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_account'])) {

    //fetches images associated to account
    $sql = "SELECT image
            FROM tasks
            WHERE user_id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $user_id]);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // loops if any images and a file exists remove
    foreach ($images as $img) {
        $path = __DIR__ . "/" . $img['image'];

        if (!empty($img['image']) && file_exists($path)) {
            unlink($path);
        }
    }

    //deletes tasks associated with account
    $pdo->prepare("DELETE FROM tasks
                   WHERE user_id = :id")
        ->execute([':id' => $user_id]);

    // delete user
    $pdo->prepare("DELETE FROM users
                   WHERE id = :id")
        ->execute([':id' => $user_id]);

    //destroy session
    session_unset();
    session_destroy();

    header("Location: register.php");
    exit;
}

//UPDATE ACCOUNT FIELDS
?>
<div class="container w-50 justify-content-center">

    <h1>Account Settings</h1>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e) : ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success) : ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="post" class="card p-4 mb-4">

        <h3>Update Account</h3>

        <input type="hidden" name="update_account" value="1">

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>

        <button class="btn btn-primary">Save Changes</button>

    </form>
    
    <!-- DELETE account button -->
    <form method="post" class="container card p-4 border-danger text-center w-75 justify-content-center">
        <h3 class="text-danger">Delete Account</h3>
        <p>This action will <em>permanently</em> delete your account and <strong>all</strong> tasks.</p>

        <input type="hidden" name="delete_account" value="1">

        <button class="btn btn-danger">Delete My Account</button>
    </form>
</div>

<?php require "includes/footer.php"; ?>