<?php
include_once '../etc/dbConnection.php';

$id = $_GET["id"];
global $qnaDbConnection;
$conn= $qnaDbConnection;
$result = mysqli_query($conn, "
    DELETE FROM `Qna`.`Question` WHERE (`id` = $id);
");
$result = mysqli_query($conn, "
    DELETE FROM `Qna`.`Answer` WHERE (`question_id` = $id);
");
echo "<script>window.location.replace(\"../main/qna.php\")</script>";

?>