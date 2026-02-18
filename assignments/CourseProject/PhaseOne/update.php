<?php
require "includes/header.php"; ?>

<h1>Edit Task</h1><!-- edit task page heading -->

<form action="update.php" method="post" class=""><!-- Sends to address at action -->

    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? ''; ?>"><!-- lets database know when to update -->

    <div class="mb-3">
        <label class="form-label">Task Name</label><!-- user can input task name -->
        <input type="text" name="task_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Priority</label><!-- Allows user to select priority level of task -->
        <select name="priority" class="form-select" required>
            <option value="">Priority Level</option>
            <option value="high">High Priority</option>
            <option value="medium">Medium Priority</option>
            <option value="low">Low Priority</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Due Date</label><!-- input for due date -->
        <input type="date" name="due_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Time Spent (hrs)</label><!-- total hours spent so user can track -->
        <input type="number" name="time_spent" class="form-control" step="0.1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Action Plan</label><!-- allows user to input text to create a action plan to complete task -->
        <textarea name="action_plan" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Task</button><!-- Confirms update -->

</form>

<?php "includes/footer.php"; ?>