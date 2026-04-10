<?php
//ensure session start for navbar login/logout

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head><!-- Head with meta info, including link to bootstrap (may not use stylesheet) -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phase Two - Time Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body><!-- Body info including nav with bootstrap for styling and spacing -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">Task Tracker</a>

            <?php if (!empty($_SESSION['user_id'])): ?>

                <ul class="navbar-nav me-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Add A Task</a>
                    </li>
                </ul>

            <?php endif; ?>

            <!-- RIGHT SIDE NAV which changes when logged in -->
            <ul class="navbar-nav ms-auto">

                <?php if (empty($_SESSION['user_id'])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item d-flex align-items-center me-3 text-white">
                        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Account</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>
    </nav>


    <div class="container-fluid">