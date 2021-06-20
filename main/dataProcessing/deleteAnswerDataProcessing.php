<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
    $id = $_POST["id"];
    $questionId = $_POST["questionId"];
    global $qnaDbConnection;
    $conn= $qnaDbConnection;
    $result = mysqli_query($conn, "
        DELETE FROM `Qna`.`Answer` WHERE (`id` = $id);
    ");
    $result2 = mysqli_query($conn, "
        SELECT * from Answer WHERE (`question_id` = '$questionId');
    ");
    $row = mysqli_fetch_array($result2);
    if(count($row) < 2) {
        mysqli_query($conn, "
        UPDATE `Qna`.`Question` SET `status` = '미답변' WHERE (`id` = '$questionId');
    ");
    }
echo "<script>window.location.replace(\"../main/qna.php\")</script>";
?>