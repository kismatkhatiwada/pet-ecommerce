
<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['is_login'])) {
    $_SESSION['error'] = 'You must log in';
    // header("Location: admin_index.php");
}

$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (!empty($_POST)) {
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $quantity=$_POST['quantity'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = 'uploads/';
        move_uploaded_file($tmp, $path . $image);
    }
    $breedexistsquery="SELECT id FROM breed WHERE breed_name='$breed'";
    

    $breedexistsresult=mysqli_query($conn,$breedexistsquery);
   
    if(mysqli_num_rows($breedexistsresult)>0){
        $breeddata=mysqli_fetch_assoc($breedexistsresult);
        $breedId=$breeddata['id'];
    }
    else{
        $insertbreedquery="INSERT INTO breed(breed_name) VALUES ('$breed')";
        mysqli_query($conn,$insertbreedquery);
        $breedId=mysqli_insert_id($conn);
    }
   

    $updateQuery = "UPDATE dogs SET gender='$gender', description='$description', price='$price', age='$age', quantity='$quantity', breed_id='$breedId', color='$color', size='$size'";
    
    if (!empty($image)) {
        $updateQuery .= ", image='$image'";
    }
    
    $updateQuery .= " WHERE id=$id";

    $res = mysqli_query($conn, $updateQuery);

    if ($res) {
        header('Location: admin_display.php');
    }
}



$sql = "SELECT dogs.*, breed.breed_name, size ,color
        FROM dogs 
        LEFT JOIN breed ON dogs.breed_id = breed.id 
        WHERE dogs.id=$id";
$result = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Dog Information</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="file"] {
            margin-bottom: 25px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            position: relative;
            background-color: #090cd5;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 16px;
            left: 640px;
            bottom: 40px;
        }

        button:hover {
            background-color: #ff9900;
        }

        h1 {
            text-align: center;
            color: black;
        }


        .image-preview {
            max-width: 100%;
            margin-top: 15px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            display: block;
            margin: 0 auto;
        }CSS styles 
    </style>
</head>
<body>
    <header>
        <a href="admin_display.php">&#8592; Back</a>
        <h1>Update Dog Information</h1>
    </header>

    <form action="" method="post" enctype="multipart/form-data">
        <?php while ($row = $result->fetch_assoc()): ?>
            <label for="breed">Breed</label><br>
            <input type="text" name="breed" value="<?= $row['breed_name'] ?>"><br><br>

            <label for="gender">Gender</label><br>
            <input type="text" name="gender" value="<?=$row['gender'] ?>"><br><br>

            <label for="age">Age</label><br>
            <input type="text" name="age" value="<?= $row['age'] ?>"><br><br>

            <label for="quantity">Quantity</label><br>
            <input type="number" name="quantity" value="<?= $row['quantity'] ?>"><br><br>

            <label for="size">Size</label><br>
            <input type="text" name="size" value="<?= $row['size'] ?>"><br><br>

            <label for="color">Color</label><br>
            <input type="text" name="color" value="<?= $row['color'] ?>"><br><br>

            <label for="price">Price</label><br>
            <input type="text" name="price" value="<?= $row['price'] ?>"><br><br>

            <label for="description">Description</label><br>
            <textarea name="description" rows="8"><?= $row['description'] ?></textarea><br><br>

            <label for="image">Image</label>
            <input type="file" name="image" onchange="previewImage(this);">

            <!-- Image Preview Box -->
            <div class="image-preview" id="imagePreview">
                <?php if (!empty($row['image'])): ?>
                    <img src="uploads/<?= $row['image'] ?>" alt="Current Image">
                <?php else: ?>
                    <p>No image selected</p>
                <?php endif; ?>
            </div>

            <button type="submit">Update Dog</button>
        <?php endwhile; ?>
    </form>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.innerHTML = '<img src="' + reader.result + '" alt="Preview Image">';
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<p>No image selected</p>';
            }
        }
    </script>
</body>
</html>
