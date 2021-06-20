<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_SESSION['userId'];
    $userId = $_POST['userId'];
    global $memberDbConnection;
    $conn= $memberDbConnection;
//    if(isset($userId)){
//        $result = mysqli_query($conn, "
//              UPDATE Member SET userId = '$userId',`name` = '$name',email = '$email' WHERE (`userId` = '$id');
//         ");
//    }else{
//        $result = mysqli_query($conn, "
//              UPDATE Member SET `name` = '$name',email = '$email' WHERE (`userId` = '$id');
//         ");
//    }
    $result = mysqli_query($conn, "
                 UPDATE Member SET `name` = '$name',email = '$email' WHERE (`userId` = '$id');
             ");
    if($result){
        echo '<script>
                alert("내 정보가 수정되었습니다.")
                location.href = "/main/myPage.php";
            </script>';
    }else{
        echo '<script>
                alert("내 정보를 수정하는데 실패했습니다.내용을 점검해주세요")
                history.back();
            </script>';
    }

?>

