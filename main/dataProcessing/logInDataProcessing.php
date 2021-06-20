<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
$userId = $_POST['userId'];
$pw = $_POST['pw'];
$sessionId = session_id();
$keepLogIn = $_POST['keepLogIn'];
global $memberDbConnection;
$conn= $memberDbConnection;
$query = "select * from Member where userId='$userId' and pw='$pw'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if ($row){
    $_SESSION['userId'] = $userId;
    if ($keepLogIn =='on'){
        $conn= $memberDbConnection;

        $query = "UPDATE Member set sessionId = '' where sessionId='$sessionId'";
        $result = mysqli_query($conn, $query);

        $query = "UPDATE Member set sessionId = '$sessionId' where userId='$userId' and pw='$pw'";
        $result = mysqli_query($conn, $query);
        setcookie("sessionId",$sessionId,time()+3600*24,"/");
    }
    echo "<script>
        location.href='../index.php'
        </script>";
}else{
    echo "<script>
        alert( '아이디 혹은 비밀번호를 확인해주세요' );
        location.href='../main/logIn.php'
    </script>";
}
?>
