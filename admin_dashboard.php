<?php
session_start();
// patikriname ar vartotojas yra prisijungęs, jeigu ne permetame jį į login.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Atsijungimas
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    // Permetam į login page'ą
    header("Location: login.php");
    exit;
}

// Funkcija, kad išsaugoti post'us arba hobby korteles į JSON file'ą
function saveDataToJson($filename, $data) {
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $json_data);
}

// Užkrauname egsistuojančius post'us ir hobby korteles
$posts = json_decode(file_get_contents('Jsons/posts.json'), true);
$hobbies = json_decode(file_get_contents('Jsons/hobbies.json'), true);

// Handle form submissions for creating or editing posts
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_post'])) {
        // sukurti naują post'ą
        $new_post = array(
            'username' => $_SESSION['username'], 
            'message' => $_POST['post_message'],
            'timestamp' => date("d m Y"),
        );
        $posts[] = $new_post;
        saveDataToJson('Jsons/posts.json', $posts);
    } elseif (isset($_POST['create_hobby'])) {
        // sukurti nauja hobby kortelę
        $new_hobby = array(
            'hobbyName' => $_POST['hobby_name'],
            'backgroundImage' => $_POST['background_image'],
            'coolerImage' => $_POST['cooler_image'],
            'description' => $_POST['hobby_description'],
        );
        $hobbies[] = $new_hobby;
        saveDataToJson('Jsons/hobbies.json', $hobbies);
    } elseif (isset($_POST['edit_post'])) {
        // redaguoti egzistuojantį post'ą
        $post_index = $_POST['post_index'];
        $posts[$post_index]['message'] = $_POST['edited_message'];
        saveDataToJson('jsons/posts.json', $posts);
    } elseif (isset($_POST['edit_hobby'])) {
        // redaguojame egzistuojančią pomėgių kortelę
        $hobby_index = $_POST['hobby_index'];
        $hobbies[$hobby_index]['hobbyName'] = $_POST['edited_hobby_name'];
        $hobbies[$hobby_index]['backgroundImage'] = $_POST['edited_background_image'];
        $hobbies[$hobby_index]['coolerImage'] = $_POST['edited_cooler_image'];
        $hobbies[$hobby_index]['description'] = $_POST['edited_hobby_description'];
        saveDataToJson('Jsons/hobbies.json', $hobbies);
    } elseif (isset($_POST['delete_post'])) {
        // Istriname post'ą
        $post_index = $_POST['post_index'];
        unset($posts[$post_index]);
        $posts = array_values($posts); // Reset array keys
        saveDataToJson('Jsons/posts.json', $posts);
    } elseif (isset($_POST['delete_hobby'])) {
        // Istriname hobby kortele
        $hobby_index = $_POST['hobby_index'];
        unset($hobbies[$hobby_index]);
        $hobbies = array_values($hobbies); // Reset array keys
        saveDataToJson('Jsons/hobbies.json', $hobbies);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 18px;
        }
        form{
            border-style: solid;
            border-color: white;
            border-width: 1px;
            margin-bottom: 20px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <form method="post" action="">
        <input type="submit" name="logout" value="Logout">
    </form>
    <a href="index.php"><button>Back</button></a>

    <h2>Create New Post</h2>
    <form method="post" action="">
        <textarea name="post_message" rows="4" cols="50"></textarea><br>
        <input type="submit" name="create_post" value="Create Post">
    </form>

    <h2>Create New Hobby Card</h2>
    <form method="post" action="">
        Hobby Name: <input type="text" name="hobby_name"><br>
        Background Image URL: <input type="text" name="background_image"><br>
        Cooler Image URL: <input type="text" name="cooler_image"><br>
        Description: <input type="text" name="hobby_description"><br>
        <input type="submit" name="create_hobby" value="Create Hobby Card">
    </form>

    <h2>Edit Posts</h2>
    <?php
    foreach ($posts as $index => $post) {
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='post_index' value='$index'>";
        echo "<textarea name='edited_message' rows='4' cols='50'>" . $post['message'] . "</textarea><br>";
        echo "<input type='submit' name='edit_post' value='Save'>";
        echo "<input type='submit' name='delete_post' value='Delete'>";
        echo "</form>";
    }
    ?>

    <h2>Edit Hobby Cards</h2>
    <?php
    foreach ($hobbies as $index => $hobby) {
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='hobby_index' value='$index'>";
        echo "Hobby Name: <input type='text' name='edited_hobby_name' value='" . $hobby['hobbyName'] . "'><br>";
        echo "Background Image URL: <input type='text' name='edited_background_image' value='" . $hobby['backgroundImage'] . "'><br>";
        echo "Cooler Image URL: <input type='text' name='edited_cooler_image' value='" . $hobby['coolerImage'] . "'><br>";
        echo "Description: <input type='text' name='edited_hobby_description' value='" . $hobby['description'] . "'><br>";
        echo "<input type='submit' name='edit_hobby' value='Save'>";
        echo "<input type='submit' name='delete_hobby' value='Delete'>";
        echo "</form>";
    }
    ?>
</body>
</html>
