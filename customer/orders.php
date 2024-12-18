<?php
session_start();
require('../connection.php'); 

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
} else {
    $id = $_SESSION['user_id'];
}

$sql = "SELECT orders.*, dogs.image, dogs.breed_id, breed.breed_name FROM orders 
        JOIN dogs ON orders.dog_id = dogs.id 
        JOIN breed ON dogs.breed_id = breed.id 
        WHERE orders.customer_id = $id";
$result = mysqli_query($conn, $sql);
$orderItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orderItems[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-container {
            margin: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            text-align: center;
        }

        th {
            background-color: #34495e;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        .status {
            display: flex;
            gap: 10px;
        }

        .submit {
            position: relative;
            background-color: green;
            border: none;
            color: wheat;
            padding: 10px 15px;
            border-radius: 5px;
        }

        button {
            background-color: rgb(62, 68, 68);
            color: white;
            border: none;
            padding: 20px 25px;
            border-radius: 10px;
            left: 10px;
            top: 10px;
        }

        .cancel {
            background-color: red;
        }

        .cancel:hover {
            background-color: rgb(172, 59, 59);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Breed</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($orderItems as $row): ?>
                    <tr>
                        <td><?= ++$i ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['breed_name'] ?></td>
                        <td><img src="../admin/uploads/<?= $row['image'] ?>" width="50" alt="" class="src"></td>
                        <td class="status"><?= $row['status'] ?></td>
                        <td>
                            <?php if ($row['status'] != 'canceled' && $row['status'] != 'completed'): ?>
                                <a href="cancel_order.php?id=<?= $row['id'] ?>">
                                    <button class="cancel" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</button>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="customer_index.php"><button>Back</button></a>
</body>
</html>
