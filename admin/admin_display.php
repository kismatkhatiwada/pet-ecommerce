<?php
session_start();
require_once "../connection.php";

// echo $_SESSION['is_login'];
// die;

if($_SESSION['is_login'] != 1){
    $_SESSION['error']='You must login';
    // echo $_SESSION['error'];
    // die;
    header('Location:index.php');

}   

    // Fetch data from the database for the specific dog using the ID
    $sql = "SELECT dogs.*, breed.breed_name, size ,color
        FROM dogs 
        LEFT JOIN breed ON dogs.breed_id = breed.id ";
        
    $result = mysqli_query($conn, $sql);




?>
    <script>
        <?php if(isset($_SESSION['error'])): ?>
            alert("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Display Panel</title>
    <link rel="stylesheet" href="css/admin_display.css">
</head>
<body>

<header>
    <a href="admin_add.php"><button class="add">Add Dogs</button></a>
    <a href="admin_add_breed.php"><button class="add_breed">Add Breed</button></a>
    <h1>Admin Display Panel</h1>
    <div class="buttons">
    <a href="pending_orderr.php"><button class="order">Orders</button></a>
    <a href="admin_logout.php"><button class="logout">Logout</button></a>
    </div>
</header>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Breed</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Color</th>
                <th>Image</th>
                <th>Price</th>
                <th colspan="2">Action</th>
             
               
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['breed_name'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['size'] ?></td>
                    <td><?= $row['color'] ?></td>
                    <td><img src="uploads/<?= $row['image'] ?>" width="50" alt="" class="src"></td>
                    <td><?= $row['price'] ?></td>
                    <td><a href="update.php?id=<?= $row['id'] ?>"><button class="update-btn">Update</button></a></td>
                    <td><a href="admin_delete.php?id=<?= $row['id'] ?>"><button class="delete-btn">Delete</button></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
