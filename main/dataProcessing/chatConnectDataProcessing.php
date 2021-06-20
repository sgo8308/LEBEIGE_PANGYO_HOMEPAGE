<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
//$id = $_SESSION['userId'];
$id = "test";
global $chatDbConnection;
$conn= $chatDbConnection;

$result = mysqli_query($conn, "
              Insert into NowConnectId 
              (userId) 
              VALUES 
              ('$id')
                ");

?>

