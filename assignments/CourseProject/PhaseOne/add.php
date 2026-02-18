<?php
require "includes/header.php"; ?>

<h1 class="mb-4">Add New Task</h1>

<form action="add.php" method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Task Name</label>
        <input type="text" name="task_name" class="form-control" required>
    </div>

    <div>
        <label>Priority</label>
        <select required>
            <option>Priority Level</option>
            <option>High Priority</option>
            <option>Medium Priority</option>
            <option>Low Priority</option>
        </select>
    </div>

    <div>
        <label>Due Date</label>
        <input type="date" name="due_date" class="" required>
    </div>

    <div>
        <label>Time Spent (hrs)</label>
        <input type="number" name="time_spent" class="" required>
    </div>

    <div>
        <label>Action Plan</label>
        <textarea name="action_plan" class="" rows="3" required></textarea>
    </div>

    <button type="submit" class="">Add Task</button>
</form>
<?php "includes/footer.php"; ?>