<?php
require "includes/connect.php";
require "includes/auth.php"; // run before html
require "includes/header.php";

// make sure we received an ID - repurposed code from week 6 lesson 4
if (!isset($_GET['id'])|| empty($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = $_GET['id'];

// fetches deleted task to see if it has an image to delete
$sql = "SELECT image 
        FROM tasks
        WHERE id = :id
        AND user_id = :user_id";

$stmt = $pdo -> prepare($sql);
$stmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);

$task = $stmt->fetch(PDO::FETCH_ASSOC);

// no task, redirect
if (!$task) {
    header("Location: index.php");
    exit;
}

// if user confirms delete task
if ($_SERVER["REQUEST_METHOD"] === "POST"){ 

    //deletes image file if exists
    if(!empty($task['image']) && file_exists($task['image'])) {
        unlink($task['image']);
    }

    $sql = "DELETE from tasks 
            WHERE id = :id
            AND user_id = :user_id";
    //prepare 
    $stmt = $pdo->prepare($sql);
     
    //bind and execute
    $stmt->execute([':id' => $id,
                    ':user_id' => $_SESSION['user_id']]);

    // redirect after update (prevents resubmission on refresh)
    header("Location: index.php");
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
<a href="index.php" class="btn btn-secondary">CANCEL</a>
</form>

<?php require "includes/footer.php"; ?>