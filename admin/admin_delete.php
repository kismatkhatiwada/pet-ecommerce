 <?php
require_once '../connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id']; 

    
    $sql = "DELETE FROM dogs WHERE id='$id'";  
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Record deleted successfully.";
    } else{
        echo "Error deleting record: " . mysqli_error($conn);
    }
    header('Location:admin_display.php');

}
?> 

<?php
// require_once '../connection.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     // Delete related records in the cart table first
//     $sql_cart = "DELETE FROM cart WHERE dog_id='$id'";
//     mysqli_query($conn, $sql_cart);

//     // Then delete the record from the dogs table
//     $sql_dogs = "DELETE FROM dogs WHERE id='$id'";
//     $result = mysqli_query($conn, $sql_dogs);

//     if ($result) {
//         echo "Record deleted successfully.";
//     } else {
//         echo "Error deleting record: " . mysqli_error($conn);
//     }
//     header('Location: admin_display.php');
// }
?>
