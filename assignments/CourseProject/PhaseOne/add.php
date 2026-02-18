<?php
require "includes/header.php"; ?>

<h1 class="mb-4">Add New Task</h1>

<form action="add.php" method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Task Name</label>
        <input type="text" name="task_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Priority</label>
        <select name="priority" class="form-select" required>
            <option value="">Priority Level</option>
            <option value="high">High Priority</option>
            <option value="medium">Medium Priority</option>
            <option value="low">Low Priority</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Time Spent (hrs)</label>
        <input type="number" name="time_spent" class="form-control" step="0.1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Action Plan</label>
        <textarea name="action_plan" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Add Task</button>
</form>
<?php "includes/footer.php"; ?>