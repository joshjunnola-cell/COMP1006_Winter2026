<?php
require "includes/header.php"; ?>

<h1>Your Tasks</h1>

<table>
    <thead>
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
            <td>I have to focus on the task at hand</td>
            <td>
                <a href='#'>Edit</a>
                <a href='#'>Delete</a>
            </td>
        </tr>
    </tbody>
</table>
<?php "includes/footer.php"; ?>