<?php
include '../includes/db.php';
include '../includes/auth.php';
requireLogin();

echo "<h2>Welcome, User " . $_SESSION['user_id'] . "</h2>";
?>

<a href="grades.php">Manage Grades</a><br>
<a href="logout.php">Logout</a>
