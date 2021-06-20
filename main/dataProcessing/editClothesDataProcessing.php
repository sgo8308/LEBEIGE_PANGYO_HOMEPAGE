<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
$name = $_POST['addClothesClothesName'];
$price = $_POST['addClothesClothesPrice'];
$category1 = $_POST['addClothesClothesCategory1'];
$category2 = $_POST['addClothesClothesCategory2'];
$category3 = $_POST['addClothesClothesCategory3'];
$detail = $_POST['editordata'];
$id = $_POST['clothesId'];
global $clothesDbConnection;
$db= $clothesDbConnection;
$status = $statusMsg = '';
if(isset($_POST["submit"])){
    $status = 'error';
    if(!empty($_FILES["addClothesImage"]["name"])) {
        // Get file info
        $fileName = basename($_FILES["addClothesImage"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            $image = $_FILES['addClothesImage']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            // Insert image content into database
            $update = $db->query("
                                UPDATE Clothes SET 
                                `name` = '$name', 
                                `price` = '$price', 
                                `mainImage` = '$imgContent', 
                                `category1` = '$category1', 
                                `category2` = '$category2', 
                                `category3` = '$category3', 
                                `detail` = '$detail' 
                                 WHERE (`id` = '$id');
                                ");
            echo mysqli_error($db);
            if($update){
                echo '<script>
                        alert("상품이 수정되었습니다..")
                        location.href=\'../clothes/clothes.php?clothesid='.$id.'\'
                      </script>';
            }else{
                echo '<script>
                        alert("상품을 수정하는데 실패했습니다. 내용을 점검해주세요.")
                        history.back();
                      </script>';
            }
        }else{
            echo '<script>
                    alert("메인이미지는 JPG, JPEG, PNG, & GIF 파일만 업로드 가능합니다.")
                    history.back();
                    </script>';
        }
    }else{
        $update = $db->query("
                                UPDATE Clothes SET 
                                `name` = '$name', 
                                `price` = '$price', 
                                `category1` = '$category1', 
                                `category2` = '$category2', 
                                `category3` = '$category3', 
                                `detail` = '$detail' 
                                 WHERE (`id` = '$id');
                                ");
        echo mysqli_error($db);
        if($update){
            echo '<script>
                        alert("상품이 수정되었습니다..")
                        location.href=\'../clothes/clothes.php?clothesid='.$id.'\'
                      </script>';
        }else{
            echo '<script>
                        alert("상품을 수정하는데 실패했습니다. 내용을 점검해주세요.")
                        history.back();
                      </script>';
        }
    }
}
?>