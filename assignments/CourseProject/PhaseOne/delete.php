<?php
require "includes/connect.php";
require "includes/header.php"; 

// make sure we received an ID - repurposed code from week 6 lesson 4
if (!isset($_GET['id'])|| empty($_GET['id'])) {
  header("Location: tasks.php");
  exit;
}

$id = $_GET['id'];

// if user confirms delete task
if ($_SERVER["REQUEST_METHOD"] === "POST"){ 

    $sql = "DELETE from tasks WHERE id = :id";
    //prepare 
    $stmt = $pdo->prepare($sql);
    //bind 
    $stmt->bindParam(':id', $id);
    //execute
    $stmt->execute();

    // redirect after update (prevents resubmission on refresh)
    header("Location: tasks.php");
    exit;
}
?>

<h1 class="mb-4">Delete Task</h1><!-- Delete task main heading -->

<p><!-- Message asking user if they are sure about decision -->
    Are you sure you want to delete this task?
    <small><strong>This cannot be undone.</strong></small>
</p>

<form method="post">
<button type="submit" class="btn btn-danger">YES</button><!-- Yes to confirm or cancel button -->
<a href="tasks.php" class="btn btn-secondary">CANCEL</a>
</form>

<?php require "includes/footer.php"; ?>