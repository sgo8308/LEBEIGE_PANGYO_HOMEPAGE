<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
$name = $_POST['addClothesClothesName'];
$price = $_POST['addClothesClothesPrice'];
$category1 = $_POST['addClothesClothesCategory1'];
$category2 = $_POST['addClothesClothesCategory2'];
$category3 = $_POST['addClothesClothesCategory3'];
$detail = $_POST['editordata'];

global $clothesDbConnection;
$db = $clothesDbConnection;
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
            $insert = $db->query("
                                INSERT into Clothes 
                                (name, price, category1,category2,category3,mainImage,detail,date) 
                                VALUES 
                                ('$name','$price','$category1','$category2','$category3','$imgContent','$detail' ,NOW())
                                ");

            if($insert){
                echo '<script>
                        alert("상품이 등록되었습니다.")
                        location.href=\'../leftMenu/everyClothes.php\'
                      </script>';
            }else{
                echo '<script>
                        alert("상품을 등록하는데 실패했습니다. 내용을 점검해주세요.")
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
        echo '<script>
                alert("메인이미지를 선택해주세요.")
                history.back();
                </script>';
    }
}
?>