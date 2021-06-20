<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?16">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="..\summernote\summernote-lite.css">
    <script src="..\summernote\summernote-lite.js"></script>
    <script src="..\summernote\lang\summernote-ko-KR.js"></script>
</head>
<style>
    .writeReviewBigContainer{
        width: 960px;
        height: 610px;
        margin-top: 20px;
        border: 1px solid #d9dadc;
        font-size: 12px;
        display: flex;

    }
    .writeReviewContainerLeft{
        width: 15%;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #d9dadc;
        background: #f5f3f4;
    }
    .writeReviewContainerRight{
        width: 85%;
        display: flex;
        flex-direction: column;
    }
    .writeReviewLeftBody{
        box-sizing: border-box;
        flex-basis: 56px;
        border-bottom: 1px solid #d9dadc;
        padding: 20px;
    }

    #writeReviewLeftDetail{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 370px;
        border-bottom: none;
    }
    .writeReviewRightBody{
        padding-top: 18px;
        padding-left: 10px;
        box-sizing: border-box;
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 56px;
        border-bottom: 1px solid #d9dadc;
    }

    #writeReviewRightDetail{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 370px;
        border-bottom: none;

    }
    input[type="text"]{
        margin: 0;
        width: 95%;
    }


    input[type="submit"]{
        color: #fff;
        background: #111;
        border: 1px solid #111 !important;
        text-align: center;
        display: inline-block;
        width: 160px;
        height: 50px;
        padding: 10px;
        margin-right: auto;
        margin-left: auto;
        align-content: center;
        margin-top: 30px;
    }
    #chatUser, #chatAdmin{
        font-size: 12px;
        position: fixed;
        bottom: 18px;
        right: 0px;
        width: 70px;
        height: 40px;

        background-color: #353b4c;
        letter-spacing: -1px;
        color: #ffffff;
        font-weight: normal;
    }
</style>
<body>
<?php
include_once '../templete/mainTemplete.php';

class main extends Layout{
    public function accessReviewTable(){
        $id = $_POST['reviewid'];
        global $reviewDbConnection;
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Review WHERE (id = '$id')";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function drawRightOfMain(){
        $row = mysqli_fetch_array($this->accessReviewTable());

        echo '       
                <h3 style="font-size: 32px;margin-top: 130px; ">리뷰 수정</h3>
                <form action="../dataProcessing/writeReviewDataProcessing.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="수정" name="edit">
                    <input type="hidden" value="'.$row['id'].'" name="reviewId">
                    <div class="writeReviewBigContainer">
                        <div class="writeReviewContainerLeft">
                            <div class="writeReviewLeftBody">제목</div>
                            
                            <div class="writeReviewLeftBody" id="writeReviewLeftDetail">상세 내용</div>
                        </div>
                        <div class="writeReviewContainerRight">
                            <div class="writeReviewRightBody" style="vertical-align: center">
                                <input type="text" name="writeReviewTitle" id="writeReviewTitle">                               
                            </div>                           
                            <textarea id="summernote" name="editordata">'.$row['detail'].'</textarea>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="수정 완료" style="margin-left:400px;margin-top: 10px;cursor: pointer"/>
                </form>
            ';
        echo '<script>
                $(document).ready(function() {
                    //여기 아래 부분
                    $(\'#summernote\').summernote({
                        height: 500,                 // 에디터 높이
                        minHeight: null,             // 최소 높이
                        maxHeight: null,             // 최대 높이
                        lang: "ko-KR",					// 한글 설정
                        placeholder: \'\',	//placeholder 설정
                        fontNames: ["Arial", "Arial Black", "Comic Sans MS", "Courier New","맑은 고딕","궁서","굴림체","굴림","돋음체","바탕체"],
                        fontSizes: ["8","9","10","11","12","14","16","18","20","22","24","28","30","36","50","72"]
                    });
                });
            </script>';

        echo '<script>
                document.getElementById("writeReviewTitle").value = "'.$row['title'].'";
            </script>';
    }
}

$main = new main();
$main->drawMainLayout();
?>

</body>
</html>