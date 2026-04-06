<?php
//ensure session start for navbar login/logout

    session_start();

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
    <nav class="navbar bg-dark border-bottom border-body mb-4" data-bs-theme="dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">Time Tracker</a>
            <div class="d-flex align-items-center gap-2">

                <?php if (!empty($_SESSION['user_id'])) : ?>

                    <span class="navbar-text text-light">
                        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
                    </span>

                    <a class="btn btn-outline-light" href="add.php">Add a Task</a>
                    <a class="btn btn-danger" href="logout.php">Logout</a>

                <?php else : ?>

                    <a class="btn btn-outline-light" href="login.php">Login</a>
                    <a class="btn btn-success" href="register.php">Register</a>

                <?php endif; ?>

            </div>
        </div>
    </nav>

<div class="container-fluid">