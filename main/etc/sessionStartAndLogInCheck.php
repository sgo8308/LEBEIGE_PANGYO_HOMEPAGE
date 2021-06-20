<?php
include_once '../etc/dbConnection.php';

session_start();
$id = session_id();
$sessionId = $_COOKIE['sessionId'];
if ($sessionId != ""){
    global $memberDbConnection;
    $conn = $memberDbConnection;
    $query = "select * from Member where sessionId='$sessionId'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_array($result)){
        $_SESSION['userId'] = $row['userId'];
    }
}

if( isset( $_SESSION[ 'userId' ] ) ) {
    $_SESSION['userLogIn'] = TRUE;
}
?>