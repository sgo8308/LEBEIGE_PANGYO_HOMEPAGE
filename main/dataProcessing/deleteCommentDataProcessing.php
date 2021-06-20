<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
$id = $_POST["commentId"];
$reviewId = $_POST["reviewId"];

global $reviewDbConnection;
$conn= $reviewDbConnection;

$result = mysqli_query($conn, "
        DELETE FROM `Review`.`Comment` WHERE (`id` = $id);
    ");
$result2 = mysqli_query($conn, "
        SELECT * FROM Comment WHERE (reviewId = '$reviewId');
    ");

    $data['commentNum'] = mysqli_num_rows($result2);
    echo json_encode($data);
?>