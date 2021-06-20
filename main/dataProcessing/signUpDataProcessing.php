<?php
include_once '../etc/dbConnection.php';

$userId = $_POST['userId'];
$name = $_POST['name'];
$email = $_POST['email'];
$pw = $_POST['pw'];
$pwConfirm = $_POST['pwConfirm'];
$idConfirm = $_POST['idConfirm'];
$checkBox1 = $_POST['checkBox1'];
$checkBox2 = $_POST['checkBox2'];

if ($idConfirm == "ok"){

    if (strlen($pw)<6 || $pw!=$pwConfirm){
        echo '<script>
              alert("비밀번호를 확인해주세요.")
              history.back();
            </script>';
    }else{
        if ($checkBox1 == "on" && $checkBox2 == "on"){
            global $memberDbConnection;
            $conn= $memberDbConnection;
            $result = mysqli_query($conn, "
        INSERT INTO Member
            (userId,name,email,pw)
            VALUE(
            '$userId',
            '$name',
            '$email',
            '$pw'
            )
        ");
            if ($result){
                echo "<script>
                    alert( '회원가입에 성공했습니다' );
                    location.href='../main/logIn.php'
                </script>";
            }else{
                echo "<script>
                    alert( '회원가입에 실패했습니다' );
                    history.back();
                </script>";
                mysqli_error($conn);
            }
        }else{
            echo '<script>
              alert("동의여부를 확인해주세요.")
             history.back();
            </script>';
        }
    }
}else{
    echo '<script>
            alert("아이디 중복확인을 해주세요")
            history.back();
        </script>';
}
?>
