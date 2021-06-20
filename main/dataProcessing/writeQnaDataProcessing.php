<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
$description = $_POST['description'];
$userId = $_SESSION['userId'];
$postId = $_POST['postId'];
global $qnaDbConnection;
$conn= $qnaDbConnection;
//$i = 1;
//while($i <50){
//    $result = mysqli_query($conn, "
//    INSERT INTO Question
//    (status, description, writer, date)
//    VALUES (
//        '미답변',
//        '테스트',
//        'test',
//        NOW());
//");
//    $i = $i + 1;
//}

if (empty($postId)){ //수정으로 넘어온게 아니면
    $result = mysqli_query($conn, "
    INSERT INTO Question
    (status, description, writer, date)
    VALUES (
        '미답변',
        '$description',
        '$userId',
        NOW());
");
}else{ // 수정으로 넘어왔다면
    $result = mysqli_query($conn, "
    UPDATE `Qna`.`Question` SET `description` = '$description' WHERE (`id` = '$postId');
");
}

echo mysqli_error($conn);

echo "<script>window.opener.location.reload();</script>";
echo "<script>window.close();</script>"
?>
