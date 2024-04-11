<?php
// Start the session
session_start();

// Define username and password
$admin_username = "Donatas";
$admin_password = "Admin1";

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // If logged in, redirect to the admin dashboard
    header("Location: admin_dashboard.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Verify the provided username and password
        if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
            // Authentication successful, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $admin_username;
            
            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            // Authentication failed, display error message
            $error_message = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
        body{
            display: flex;
            flex-direction: column;
            color: white;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php
        // Display error message if authentication failed
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login"> 
        </form>
        <a href="index.php"><button>Back</button></a>
    </div>
</body>
</html>
