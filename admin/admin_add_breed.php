<?php
session_start();


require_once '../connection.php';


if (!empty($_POST)) {
    $breed_name = $_POST['breed_name'];
    $sql = "INSERT INTO breed(breed_name) VALUES ('$breed_name')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location:' . $_SERVER['PHP_SELF']);
    } else {
        echo "Failed to add breed";
    }
}
?>

<style>
    
/* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0; /* Light gray background */
    padding: 20px;
}

header {
    background-color: #333; /* Dark gray header */
    color: #fff; /* White text */
    padding: 10px;
    text-align: center;
    margin-bottom: 20px;
}

header a {
    color: #fff; /* White link text */
    text-decoration: none;
    position:absolute;
    left:20px;
}

form {
    background-color: #fff; /* White form background */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

form label {
    display: block;
    margin-bottom: 10px;
}

form input[type="text"],
form input[type="number"],
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 5px;
}

form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 5px;
    appearance: none; /* Remove default appearance */
    background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="%23333"><path d="M7 10l5 5 5-5z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
}

form textarea {
    resize: none; /* Disable resizing */
}

form .radio-buttons {
    margin-bottom: 20px;
}

form button[type="submit"] {
    background-color: #333; /* Dark gray button */
    color: #fff; /* White button text */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button[type="submit"]:hover {
    background-color: #555; /* Darker gray on hover */
}



</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dog</title>
    <link rel="stylesheet" href="css/add_dog.css">
</head>
<body>

<header>
    <a href="admin_display.php">&#8592; Back</a>
    <h1>Add Breed</h1>
</header>

<form action="" method="post">
    <!-- <h2>Add Breed</h2> -->
    <label for="breed_name">Breed Name</label>
    <input type="text" name="breed_name" required>
    <button onclick="alert('Breed added successfully');" type="submit">Add Breed</button>

</form>

<!-- <a href="index.php"><button class="logout-btn">Logout</button></a> -->

</body>
</html>
