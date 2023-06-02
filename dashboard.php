<!-- index.php -->
<?php
// Establish database connection (replace 'localhost', 'root', '', and 'student_management' with your database credentials)
$conn = mysqli_connect('localhost', 'root', '', 'student_management');

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Check if form is submitted to add a new student
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $fatherName = $_POST['father_name'];
    $class = $_POST['class'];
    $city = $_POST['city'];
    $mobileNumber = $_POST['mobile_number'];
    $email = $_POST['email'];

    // Insert the new student record
    $sql = "INSERT INTO students (name, father_name, class, city, mobile_number, email) VALUES ('$name', '$fatherName', '$class', '$city', '$mobileNumber', '$email')";
    if (mysqli_query($conn, $sql)) {
        $message = 'New student added successfully.';
    } else {
        $message = 'Error: ' . mysqli_error($conn);
    }
}

// Check if search query is submitted
if (isset($_POST['search'])) {
    $searchQuery = $_POST['searchQuery'];

    // Retrieve student records based on search query
    $sql = "SELECT * FROM students WHERE name LIKE '%$searchQuery%' OR id = '$searchQuery'";
    $result = mysqli_query($conn, $sql);
} else {
    // Retrieve all student records
    $sql = "SELECT * FROM students";
    $result = mysqli_query($conn, $sql);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/index.css">
    <title>Student Management System</title>
</head>
<body>
    <h1>Student Management System</h1>      

     

    <!-- Add Student Form -->
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="father_name">Father's Name:</label>
        <input type="text" id="father_name" name="father_name" required><br><br>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" id="mobile_number" name="mobile_number" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" name="add" value="Add Student">
    </form>

    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

   

    <!-- Display Student Records -->
    <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Father's Name</th>
        <th>Class</th>
        <th>City</th>
        <th>Mobile Number</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['father_name'] . "</td>";
        echo "<td>" . $row['class'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['mobile_number'] . "</td>";
        echo"<td>"  .$row['email'] . "</td>";
        echo "<td>";
        echo "<a href='edit.php?id=" . $row['id'] . "' class='edit-button'>Edit</a>";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='delete-button'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>

</table>

</body>
</html>
