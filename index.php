<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the credentials are correct (replace with your own authentication logic)
    if ($username === "admin" && $password === "password") {
        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        // Credentials are incorrect, show error message
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="index.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">

            <?php if (isset($errorMessage)) { ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>
