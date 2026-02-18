<?php
require "includes/header.php"; ?>

<h1 class="mb-4">Add New Task</h1>

<form action="add.php" method="post" class="card p-4 shadow-sm">

    <div class="mb-3">
        <label class="form-label">Task Name</label>
        <input type="text" name="task_name" class="form-control" required>
    </div>


</form>