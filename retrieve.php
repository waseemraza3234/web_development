<!-- retrieve.php -->
<?php
// Establish database connection (replace 'localhost', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('localhost', 'root', '', 'student_management');

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Retrieve student records from the database
$sql = 'SELECT * FROM students';
$result = mysqli_query($conn, $sql);

// Display the retrieved records in the HTML table
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['age'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a> | <a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No records found.</td></tr>';
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Add Student button -->
<tr>
    <td colspan="5" style="text-align: center;">
        <a href="index.php">Add Student</a>
    </td>
</tr>
