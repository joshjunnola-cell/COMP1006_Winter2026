<?php
require "includes/connect.php";
require "includes/header.php";
 ?>

<h1 class="mb-4">Your Tasks</h1><!-- lists current tasks -->

<table class="table table-striped table-bordered align-middle"><!-- setups up how the table will look -->
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
        <tr><!-- this shows a example of output to user -->
            <td>Task Example</td>
            <td>High</td>
            <td>2026-02-20</td>
            <td>6</td>
            <td>I have to focus on the task at hand(EXAMPLE)</td>
            <td>
                <a href='update.php' class="btn btn-sm btn-primary">Edit</a><!-- Update/edit and delete buttons -->
                <a href='delete.php' class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    </tbody>
</table>
<?php "includes/footer.php"; ?>