<?php
require "includes/connect.php";
require "includes/header.php";

// if there is no id, redirects user
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: tasks.php");
    exit;
}

$id = $_GET["id"];

// used to fetch existing task
$sql = "SELECT * FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header("Location: tasks.php");
    exit;
}

// fills variables in the form
$taskName = $task["task_name"];
$priority = $task["priority"];
$dueDate = $task["due_date"];
$timeSpent = $task["time_spent"];
$actionPlan = $task["action_plan"];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //sanitize
    $id = $_POST["id"];
    $task_name = trim($_POST["task_name"]);
    $priority = trim($_POST["priority"]);
    $due_date = trim($_POST["due_date"]);
    $time_spent = trim($_POST["time_spent"]);
    $action_plan = trim($_POST["action_plan"]);

    if ($task_name === "") { // same logic as add!
        $errors[] = "Task name is required.";
    }

    $valid_priorities = ["high", "medium", "low"];
    if (!in_array($priority, $valid_priorities)) {
        $errors[] = "Priority must be set!";
    }

    if ($due_date === "" || !strtotime($due_date)) {
        $errors[] = "Must be a valid due date.";
    }

    if (!is_numeric($time_spent) || $time_spent < 0) {
        $errors[] = "Time spent must be a positive number (decimals are allowed).";
    }

    if ($action_plan === "") {
        $errors[] = "Action plan required, plan ahead!!";
    }

    if (empty($errors)) { //if no errors update the task

        $sql = "UPDATE tasks
                SET task_name = :task_name,
                    priority = :priority,
                    due_date = :due_date,
                    time_spent = :time_spent,
                    action_plan = :action_plan
                WHERE id = :id";
    }
}


$stmt->bindParam(':task_name', $taskName);
$stmt->bindParam(':priority', $priority);
$stmt->bindParam(':due_date', $dueDate);
$stmt->bindParam(':time_spent', $timeSpent);
$stmt->bindParam(':action_plan', $action_plan);

?>
<h1>Edit Task</h1><!-- edit task page heading -->

<form action="update.php" method="post" class=""><!-- Sends to address at action -->

    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? ''; ?>"><!-- lets database know when to update -->

    <div class="mb-3">
        <label class="form-label">Task Name</label><!-- user can input task name -->
        <input type="text" name="task_name" class="form-control" required>
        <div class="invalid-feedback">Please enter a task name.</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label>Priority</label><!-- Allows user to select priority level of task -->
        <select name="priority" class="form-select" required>
            <option value="">Priority Level</option>
            <option value="high">High Priority</option>
            <option value="medium">Medium Priority</option>
            <option value="low">Low Priority</option>
        </select>
        <div class="invalid-feedback">Please select a priority level.</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label class="form-label">Due Date</label><!-- input for due date -->
        <input type="date" name="due_date" class="form-control" required>
        <div class="invalid-feedback">Please choose a valid due date.</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label class="form-label">Time Spent (hrs)</label><!-- total hours spent so user can track -->
        <input type="number" name="time_spent" class="form-control" min="0" step="0.1" required>
        <div class="invalid-feedback">Please enter the time spent (decimals allowed)</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label class="form-label">Action Plan</label><!-- allows user to input text to create a action plan to complete task -->
        <textarea name="action_plan" class="form-control" rows="3" required></textarea>
        <div class="invalid-feedback">Please enter an action plan. It's for your benefit!</div><!-- gives user a message if field left blank -->
    </div>

    <button type="submit" class="btn btn-primary">Update Task</button><!-- Confirms update -->

</form>

<?php require "includes/footer.php"; ?>