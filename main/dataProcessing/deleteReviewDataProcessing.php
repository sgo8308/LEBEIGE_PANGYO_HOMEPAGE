<?php
    include_once '../etc/dbConnection.php';

    $id = $_GET["id"];
    global $reviewDbConnection;
    $conn= $reviewDbConnection;
    $result = mysqli_query($conn, "
        DELETE FROM `Review`.`Review` WHERE (`id` = $id);
    ");
    $result = mysqli_query($conn, "
        DELETE FROM `Review`.`Comment` WHERE (`reviewId` = $id);
    ");
    echo "<script>window.location.replace(\"../main/reviewList.php\")</script>";

?>