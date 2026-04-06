<?php
require "includes/connect.php";
require "includes/auth.php"; // run before html
require "includes/header.php";

// to fetch all tasks from database ordered by due date
// orders by due date so the user knows whats coming up soonest.
$sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY due_date ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$tasks = $stmt->fetchAll();
?>

<h1 class="mb-4">Your Tasks</h1><!-- lists current tasks -->

<table class="table table-striped table-bordered align-middle"><!-- setups up how the table will look -->
    <thead class="table-dark">
        <tr>
            <th>Task Name:</th>
            <th>Image</th>
            <th>Priority:</th>
            <th>Due Date:</th>
            <th>Time Spend (hrs):</th>
            <th>Action Plan:</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($tasks)): ?><!-- placeholder to let user know to add tasks -->
            <tr>
                <td colspan="7" class="text-center text-muted">
                    No Tasks found. Add one to get started!
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>

                <tr><!-- takes created tasks from db and displays them in table -->
                    <td><?= htmlspecialchars($task["task_name"]) ?></td>
                    <td>
                        <?php if (!empty($task['image'])): ?>
                            <img src="<?= htmlspecialchars($task['image']) ?>"
                                alt="Task image" class="img-thumbnail mb-2" style="max-width: 150px; height: auto;">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars(ucfirst($task["priority"])) ?></td>
                    <td><?= htmlspecialchars($task["due_date"]) ?></td>
                    <td><?= htmlspecialchars($task["time_spent"]) ?></td>
                    <td><?= htmlspecialchars($task["action_plan"]) ?></td>
                    <td>
                        <a href='update.php?id=<?= $task["id"] ?>' class="btn btn-sm btn-primary">Edit</a><!-- Update/edit and delete buttons -->
                        <a href='delete.php?id=<?= $task["id"] ?>' class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php require "includes/footer.php"; ?>