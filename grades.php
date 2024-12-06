<?php
include '../includes/db.php';
include '../includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];

// Handle Create
if (isset($_POST['add_grade'])) {
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $semester = $_POST['semester'];

    $stmt = $conn->prepare("INSERT INTO grades (user_id, subject, grade, semester) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $subject, $grade, $semester);
    $stmt->execute();
}

// Fetch Grades
$result = $conn->query("SELECT * FROM grades WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Grades</title>
</head>
<body>
    <h2>Grades</h2>
    <form method="POST">
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="number" name="grade" placeholder="Grade" step="0.01" required>
        <input type="text" name="semester" placeholder="Semester" required>
        <button type="submit" name="add_grade">Add Grade</button>
    </form>

    <table>
        <tr>
            <th>Subject</th>
            <th>Grade</th>
            <th>Semester</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['subject'] ?></td>
            <td><?= $row['grade'] ?></td>
            <td><?= $row['semester'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
