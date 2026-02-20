<?php
require "includes/connect.php";
require "includes/header.php"; 

// For initializing variables
$errors = [];
$task_name = "";
$priority = "";
$due_date = "";
$time_spent = "";
$action_plan = "";

// check if form was submitted then update
if($_SERVER["REQUEST_METHOD"] === "POST") {

    //sanitize
    $task_name = trim($_POST["task_name"]);
    $priority = trim($_POST["priority"]);
    $due_date = trim($_POST["due_date"]);
    $time_spent = trim($_POST["time_spent"]);
    $action_plan = trim($_POST["action_plan"]);

    // Product quantities (force to integer, prevent blanks) - code updated and repurposed from week 6 lesson 3
    $time_spent = (int)($_POST['time_spent'] ?? 0);

    // Simple validation (beginner-friendly) 
    if($task_name === ""){
        $errors[] = "Task name is required.";
    }

    $valid_priorities = ["high","medium","low"];
    if(!in_array($priority, $valid_priorities)) {
        $errors[] = "Priority must be set!";
    }

    if($due_date === "" || !strtotime($due_date)){
        $errors[] = "Must be a valid due date.";
    }

    if(!is_numeric($time_spent) || $time_spent < 0){
        $errors[] = "Time spent must be a positive number (decimals are allowed).";
    }

    if($action_plan === ""){
        $errors[] ="Action plan required, plan ahead!!";
    }

    if(empty($errors)){

        $sql = "INSERT INTO tasks (task_name, priority, due_date, time_spent, action_plan)
            VALUES (:task_name, :priority, :due_date, :time_spent, :action_plan)";
       
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            "task_name" => $task_name,
            "priority" => $priority,
            "due_date" => $due_date,
            "time_spent" => $time_spent,
            "action_plan" => $action_plan
        ]);

        // Redirect back to the task list (prevents resubmission on refresh)
        header("Location: tasks.php");
        exit;
    }

}

?>

<h1 class="mb-4">Add New Task</h1><!-- add new task page heading -->

<?php if(!empty($errors)): ?>
    <div class="">
        
    </div>

<form action="add.php" method="post" class="card p-4 shadow-sm"><!-- Sends to address at action -->

    <div class="mb-3">
        <label class="form-label">Task Name</label> <!-- user can input task name -->
        <input type="text" name="task_name" class="form-control" required>
        <div class="invalid-feedback">Please enter a task name.</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label>Priority</label> <!-- Allows user to select priority level of task -->
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
        <label class="form-label">Time Spent (hrs)</label> <!-- total hours spent so user can track -->
        <input type="number" name="time_spent" class="form-control" min="0" step="0.1" required>
        <div class="invalid-feedback">Please enter the time spent (decimals allowed)</div><!-- gives user a message if field left blank -->
    </div>

    <div class="mb-3">
        <label class="form-label">Action Plan</label> <!-- allows user to input text to create a action plan to complete task -->
        <textarea name="action_plan" class="form-control" rows="3" required></textarea>
        <div class="invalid-feedback">Please enter an action plan. It's for your benefit!</div><!-- gives user a message if field left blank -->
    </div>

    <button type="submit" class="btn btn-success">Add Task</button><!-- submit completed task -->
</form>
<?php require "includes/footer.php"; ?>