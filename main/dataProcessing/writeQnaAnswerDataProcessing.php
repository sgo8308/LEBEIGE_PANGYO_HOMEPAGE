<?php
include_once '../etc/dbConnection.php';

$description = $_POST['description'];
$questionId = $_POST['questionId'];
$answerId = $_POST['answerId'];
global $qnaDbConnection;
$conn= $qnaDbConnection;
if (!empty($questionId)){ //수정으로 넘오온게 아니면
    $result = mysqli_query($conn, "
    INSERT INTO Answer
    (answer,question_id,date)
    VALUES (
        '$description',
        $questionId,
        NOW());
    ");

    mysqli_query($conn, "
        UPDATE `Qna`.`Question` SET `status` = '답변완료' WHERE (`id` = '$questionId');
    ");


}else{ // 수정으로 넘어왔다면
    $result = mysqli_query($conn, "
    UPDATE `Qna`.`Answer` SET `answer` = '$description' WHERE (`id` = '$answerId');
");
}
echo mysqli_error($conn);

echo "<script>window.opener.location.reload();</script>";
echo "<script>window.close();</script>"
?>
