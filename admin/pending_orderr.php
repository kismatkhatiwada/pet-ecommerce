<?php
session_start();
require('../connection.php'); 

// if (!isset($_SESSION['user_id'])) {
//     die("User is not logged in.");
// }

if (isset($_POST['complete_order']) && isset($_POST['id'])) {
    $order_id = $_POST['id'];
    $query = "UPDATE orders SET status = 'completed' WHERE id = $order_id";
    $res = mysqli_query($conn, $query);
}

// Filter orders based on status
$statusFilter = isset($_POST['status_filter']) ? $_POST['status_filter'] : 'Pending';
$sql = "SELECT orders.*, dogs.image, dogs.breed_id, breed.breed_name FROM orders 
        JOIN dogs ON orders.dog_id = dogs.id 
        JOIN breed ON dogs.breed_id = breed.id 
        WHERE orders.status = '$statusFilter'";
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
    <title>Order Management</title>
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

        .button-container {
            margin: 20px;
            display: flex;
            justify-content: flex-start;
        }

        button, .button-container select {
            background-color: rgb(62, 68, 68);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
        }

        .button-container select {
            background-color: #34495e;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }

        .button-container select option {
            background-color: #fff;
            color: #000;
        }

        .button-container select:focus {
            border: 2px solid #2c3e50;
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

        .submit, .cancel {
            background-color: green;
            border: none;
            color: wheat;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel {
            background-color: red;
        }

    </style>
</head>
<body>
    <div class="button-container">
        <form action="" method="post">
            <select name="status_filter" onchange="this.form.submit()">
                <option value="pending" <?= $statusFilter == 'pending' ? 'selected' : '' ?>>Pending Orders</option>
                <option value="completed" <?= $statusFilter == 'completed' ? 'selected' : '' ?>>Completed Orders</option>
                <option value="canceled" <?= $statusFilter == 'canceled' ? 'selected' : '' ?>>Canceled Orders</option>
            </select>
        </form>
    </div>

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
                        <td><img src="../admin/uploads/<?= $row['image'] ?>" width="50" alt=""></td>
                        <td class="status"><?= $row['status'] ?>
                            <?php if ($row['status'] == 'pending'){ ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button class="submit" type="submit" name="complete_order">Complete</button>
                                </form>
                            <?php } if($row['status'] == 'canceled'){ ?>
                                <form action="cancel_order.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button class="cancel" type="submit" name="cancel_order">Remove Order</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="admin_display.php"><button>Back</button></a>
</body>
</html>
