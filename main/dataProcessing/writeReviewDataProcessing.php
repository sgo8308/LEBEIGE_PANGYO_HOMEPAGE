<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
$title = $_POST['writeReviewTitle'];
$detail = $_POST['editordata'];
$writer = $_SESSION['userId'];
global $reviewDbConnection;
$db= $reviewDbConnection;

if($edit = $_POST['edit']){
    $id = $_POST['reviewId'];
    $update = $db->query("
                             UPDATE Review SET `title` = '$title', detail = '$detail' WHERE (`id` = '$id');
                        ");
    
    if($update){
        echo '<script>
                alert("리뷰가 수정되었습니다.")
                location.href=\'../main/review.php?reviewid='.$id.'\'
              </script>';
    }else{
        echo '<script>
                alert("리뷰를 수정하는데 실패했습니다. 내용을 점검해주세요.")
                history.back();
              </script>';
    }
}else{
    if(isset($_POST["submit"])){

        $insert = $db->query("
                        INSERT into Review 
                        (title,detail,date,writer) 
                        VALUES 
                        ('$title','$detail',NOW(),'$writer')
                        ");

        if($insert){
            echo '<script>
                alert("리뷰가 등록되었습니다.")
                location.href=\'../main/reviewList.php\'
              </script>';
        }else{
            echo '<script>
                alert("리뷰를 등록하는데 실패했습니다. 내용을 점검해주세요.")
                history.back();
              </script>';
        }
    }
}
?>