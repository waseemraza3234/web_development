<!-- edit.php -->
<?php
// Establish database connection (replace 'localhost', 'root', '', and 'student_management' with your database credentials)
$conn = mysqli_connect('localhost', 'root', '', 'student_management');

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Check if form is submitted to update a student record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $fatherName = $_POST['father_name'];
    $class = $_POST['class'];
    $city = $_POST['city'];
    $mobileNumber = $_POST['mobile_number'];
    $email = $_POST['email'];

    // Update the student record
    $sql = "UPDATE students SET name='$name', father_name='$fatherName', class='$class', city='$city', mobile_number='$mobileNumber', email='$email' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $message = 'Student record updated successfully.';
    } else {
        $message = 'Error: ' . mysqli_error($conn);
    }
}

// Retrieve the student record based on the provided ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the student record
    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the student record exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $fatherName = $row['father_name'];
        $class = $row['class'];
        $city = $row['city'];
        $mobileNumber = $row['mobile_number'];
        $email = $row['email'];
    } else {
        $message = 'Student record not found.';
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/edit.css">
    <title>Edit Student</title>
    <link rel="stylesheet"href="assets/edit.css">
</head>
<body>
    <div class="container">
    <h1>Edit Student</h1>

    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="father_name">Father's Name:</label>
        <input type="text" id="father_name" name="father_name" value="<?php echo $fatherName; ?>" required><br><br>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" value="<?php echo $class; ?>" required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required><br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" id="mobile_number" name="mobile_number" value="<?php echo $mobileNumber; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

        <input type="submit" name="update" value="Update Student">
    </form>
    </div>
</body>
</html>
