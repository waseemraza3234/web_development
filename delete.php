<?php
// Establish database connection (replace 'localhost', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('localhost', 'root', '', 'student_management');

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Check if student ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete student record from the database
    $sql = "DELETE FROM students WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        // Redirect to the index page after successful deletion
        echo'Record succesfully deleted';
        header('Location: index.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'Student ID not provided.';
}

// Close the database connection
mysqli_close($conn);
?>
