<?php
require "includes/header.php"; ?>

<h1 class="mb-4">Your Tasks</h1>

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Task Name:</th>
            <th>Priority:</th>
            <th>Due Date:</th>
            <th>Time Spend (hrs):</th>
            <th>Action Plan:</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Example</td>
            <td>High</td>
            <td>2026-02-20</td>
            <td>3</td>
            <td>I have to focus on the task at hand(EXAMPLE)</td>
            <td>
                <a href='update.php' class="btn btn-sm btn-primary">Edit</a>
                <a href='delete.php' class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    </tbody>
</table>
<?php "includes/footer.php"; ?>