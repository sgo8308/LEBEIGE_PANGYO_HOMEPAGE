<?php
include_once '../etc/dbConnection.php';

    $id = $_POST["id"];
    $whereCome = $_POST["whereCome"];
    global $clothesDbConnection;
    $conn= $clothesDbConnection;
    $result = mysqli_query($conn, "
        DELETE FROM `Clothes`.`Clothes` WHERE (`id` = $id);
    ");
    if ($whereCome !== "clothes")
    echo "<script>history.back()</script>";
//    echo "<script>window.location.replace(\"../main/qna.php\")</script>";
?>