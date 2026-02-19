<?php
require "includes/connect.php";
require "includes/header.php"; 
?>

<h1 class="mb-4">Delete Task</h1><!-- Delete task main heading -->

<p><!-- Message asking user if they are sure about decision -->
    Are you sure you want to delete this task?
    <small><strong>This cannot be undone.</strong></small>
</p>

<a href="add.php?delete=<?php echo $_GET['id'] ?? ''; ?>" class="btn btn-danger">YES</a><!-- Yes to confirm or cancel button -->
<a href="tasks.php" class="btn btn-secondary">CANCEL</a>

<?php require "includes/footer.php"; ?>