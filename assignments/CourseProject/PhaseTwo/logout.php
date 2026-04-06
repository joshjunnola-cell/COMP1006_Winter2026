<?php

// ======= Re-used code from lesson 10 =========

// Load the auth file so the session starts
session_start();

require "includes/auth.php";

// Clear all session variables by replacing the session array with an empty one
$_SESSION = [];

// Unset all session variables currently stored in memory
session_unset();

// Destroy the session completely on the server
session_destroy();

// Redirect the user back to the login page
header("Location: login.php");

// Stop the script from executing any further code
exit;