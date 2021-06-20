<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
    $pw = $_POST['pw'];
    $pwConfirm = $_POST['pwConfirm'];
    $id = $_SESSION['userId'];
    global $memberDbConnection;
    $conn= $memberDbConnection;

    $result = mysqli_query($conn, "
              UPDATE Member SET `pw` = '$pw' WHERE (`userId` = '$id');
         ");
    if (strlen($pw)<6 || $pw!=$pwConfirm){
        echo '<script>
                  alert("비밀번호를 확인해주세요.")
                  history.back();
                </script>';
    }else{
        if($result){
            echo '<script>
                alert("비밀번호가 변경되었습니다.")
                location.href = "/main/myPage.php";
            </script>';
        }else{
            echo '<script>
                alert("비밀번호를 확인해주세요.")
                history.back();
            </script>';
        }
    }


?>

