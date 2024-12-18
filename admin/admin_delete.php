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

