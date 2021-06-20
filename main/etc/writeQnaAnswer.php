<?php
function writeAndEditAnswer(){
    $questionId = $_GET["questionid"];
    $answerId = $_GET["answerid"];
    if (!empty($questionId)){ // 답변 작성
        echo '<div class="writeQnaContainer">
        <div class="writeQnaHeader">답변 작성하기</div>
        <form action="..\dataProcessing\writeQnaAnswerDataProcessing.php" method="post" class="writeQnaBody">
            <textarea name="description" maxlength="1000" placeholder="답변내용을 입력해주세요" required="required"></textarea>
            <div class="button">
                <input type="button" onclick="window.close();" value="취소" class="buttonItems" ></input>
                ';
        echo   '<input type="hidden" value="'.$questionId.'" name="questionId"></input>';
        echo '   <input type="submit" value="등록" class="buttonItems" style="color: white;background: black"></input>
            </div>
        </form>
    </div>';
    }else{ // 수정
        echo '<div class="writeQnaContainer">
                <div class="writeQnaHeader">답변 작성하기</div>
                <form action="..\dataProcessing\writeQnaAnswerDataProcessing.php" method="post" class="writeQnaBody">
                    <textarea id="descriptionArea" name="description" maxlength="1000" placeholder="답변내용을 입력해주세요" required="required"></textarea>
                    <script>
                        document.getElementById("descriptionArea").value = window.opener.document.getElementById("qnaAnswerDescription'.$answerId.'").innerHTML;
                    </script> 
                    <div class="button">
                        <input type="button" onclick="window.close();" value="취소" class="buttonItems" ></input>
                        ';
        echo   '<input type="hidden" value="'.$answerId.'" name="answerId"></input>';
        echo'   <input type="submit" value="등록" class="buttonItems" style="color: white;background: black"></input>
                    </div>
                </form>
            </div>';
    }
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?15">
</head>
<style>
    .writeQnaContainer{
        width: 100%;
        height: 100%;
    }
    .writeQnaHeader{
        display: block;
        padding: 15px 30px;
        background-color: #353b4c;
        font-size: 18px;
        letter-spacing: -1px;
        color: #ffffff;
        font-weight: normal;
    }
    .writeQnaBody{
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    textarea{
        width: 90%;
        height: 115px;
        border: 1px solid #cfcfcf;
        padding: 5%;
    }
    .wirteQnaBody input[type="button"]{
        width: 50px;
    }
    .button{
        margin-top: 10px;
        width: 100%;
        display: flex;
        justify-content: center;
        column-gap: 10px;
    }
    .buttonItems{
        display: inline-block;
        min-width: 90px;
        height: 38px;
        padding: 0 15px;
        border: 1px solid #c3c3c3;
        background-color: #ffffff;
        font-size: 14px;
        color: #000000;
        line-height: 38px;
        vertical-align: top;
    }
</style>
<body>
<?php
writeAndEditAnswer();
?>

</body>
</html>
