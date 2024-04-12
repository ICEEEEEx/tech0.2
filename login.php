<?php
session_start();

// Slapyvardis ir slaptažodis
$admin_username = "Donatas";
$admin_password = "Admin1";

// patikriname ar vartotojas jau prisijunęs
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Jeigu prisijungęs permetame į admin_dashboard.php
    header("Location: admin_dashboard.php");
    exit;
}

// Checkinam ar forma yra "submit'inta"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Paziurime ar slapyvardis ir slaptazodis abu duoti
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // patikriname ar sutampa duota info
        if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
            // Authentikuota sekmingai, nustatome sessijos "variables"
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $admin_username;
            
            // permetame vartotoją į admin_dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            // Authentikacija nepavyko žinutė
            $error_message = "slapyvardis arba slaptažodis netinka";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
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
        <h2>Admin Prisijungimas</h2>
        <?php
        // žinutė jeigu prisijungti nepavyko
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Slapyvardis:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Slaptažodis:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Prisijungti"> 
        </form>
        <a href="index.php"><button>Į pagrindinį puslapį</button></a>
    </div>
</body>
</html>
