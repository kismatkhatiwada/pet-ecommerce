<?php
session_start();


require_once '../connection.php';


if (!isset($_SESSION['is_login'])) {
    $_SESSION['error'] = 'You must login';
    header("Location:index.php");
}





$breedsql = "SELECT * FROM breed";
$result = mysqli_query($conn, $breedsql);
while ($row = mysqli_fetch_assoc($result)) {
    $breeds[] = $row;
}



if (!empty($_POST)) {
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $breed_id = $_POST['breed_id'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = 'uploads/';

        move_uploaded_file($tmp, $path . $image);
    }

    $sql = "INSERT INTO dogs(breed_id, gender, age, size, color, description, quantity, image, price) 
            VALUES ($breed_id, '$gender', '$age', '$size', '$color', '$description','$quantity' ,'$image','$price')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location:admin_display.php');
    } else {
        echo "Failed to add";
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
        background-color: #f0f0f0;
        /* Light gray background */
        padding: 20px;
    }

    header {
        background-color: #333;
        /* Dark gray header */
        color: #fff;
        /* White text */
        padding: 10px;
        text-align: center;
        margin-bottom: 20px;
    }

    header a {
        color: #fff;
        /* White link text */
        text-decoration: none;
        position: absolute;
        left: 20px;
    }

    form {
        background-color: #fff;
        /* White form background */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
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
        border: 1px solid #ccc;
        /* Light gray border */
        border-radius: 5px;
    }

    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        /* Light gray border */
        border-radius: 5px;
        appearance: none;
        /* Remove default appearance */
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="%23333"><path d="M7 10l5 5 5-5z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
    }

    form textarea {
        resize: none;
        /* Disable resizing */
    }

    form .radio-buttons {
        margin-bottom: 20px;
    }

    form button[type="submit"] {
        background-color: #333;
        /* Dark gray button */
        color: #fff;
        /* White button text */
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    form button[type="submit"]:hover {
        background-color: #555;
        /* Darker gray on hover */
    }

    .logout-btn {
        background-color: #ccc;
        /* Light gray logout button */
        color: #333;
        /* Dark gray button text */
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .logout-btn:hover {
        background-color: #ddd;
        /* Slightly lighter gray on hover */
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
        <h1>Add Dog</h1>
    </header>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="breed">Breed</label>
        <select name="breed_id">
            <?php
            foreach ($breeds as $breed):
                ?>
                <option value="<?= $breed['id'] ?>"><?= $breed['breed_name'] ?></option>
                <?php
            endforeach;
            ?>
        </select>
        <label>Gender</label>
        <div class="radio-buttons">
            <label><input type="radio" name="gender" value="male" required> Male</label>
            <label><input type="radio" name="gender" value="female" required> Female</label>
        </div>

        <label for="age">Age</label>
        <input type="text" name="age" required>

        <label for="size">Size</label>
        <div class="radio-btn">
            <label><input type="radio" name="size" value="Small" required>Small </label>
            <label><input type="radio" name="size" value="Medium" required> Medium</label>
            <label><input type="radio" name="size" value="Large" required> Large</label>
        </div>

        <label for="color">Color</label>
        <input type="text" name="color" required>

        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" required>
        </select>



        <label for="image">Image</label>
        <input type="file" name="image" required>

        <label for="price">Price</label>
        <input type="number" name="price" required>

        <label for="description">Description</label>
        <textarea name="description" rows="4" required></textarea>

        <button type="submit">Submit</button>
    </form>

    <!-- <a href="index.php"><button class="logout-btn">Logout</button></a> -->

</body>

</html>