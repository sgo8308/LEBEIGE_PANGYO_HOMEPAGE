<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?15">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <style>
        .editDelContainer{
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            width: 960px;
            align-items: center;
        }
        .editDelItems{
            width: 100%;
            display: flex;
            border-top: 1px solid #777777;
            text-align: center;
            padding-top: 18px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';

class main extends Layout{

    public function drawRightOfMain(){


        //페이징을 위한 변수 만들기
        $resultForDataNum = $this->accessQusetionTableForDataNum();
        $dataNum = mysqli_num_rows($resultForDataNum);
        $dataNumForPage = 10;
        $pageNumForBlock = 3;
        $page = ($_GET['page'])?$_GET['page']:1;
        $pageNum = ceil($dataNum/$dataNumForPage); // 총 페이지
        $blockNum = ceil($pageNum/$pageNumForBlock); // 총 블록
        $nowBlock = ceil($page/$pageNumForBlock);
        $s_page = ($nowBlock * $pageNumForBlock) - ($pageNumForBlock - 1);

        if ($s_page <= 1) {
            $s_page = 1;
        }
        $e_page = $nowBlock*$pageNumForBlock;
        if ($pageNum <= $e_page) {
            $e_page = $pageNum;
        }

//        echo $nowBlock;
        $questionTableResult = $this->accessQusetionTable(($page-1) * $dataNumForPage,$dataNumForPage);


        echo '<h3 style="font-size: 32px; margin-top: 130px">상품 수정 및 삭제</h3>';

        echo '
            <div class="qnaBigContainer">
                <h3 style="font-size: 32px; margin-top: 130px; ">Q&A</h3>
                    <div class="qnaContainer">

                        <div>
                            <input type="button" value="Q&A 작성하기" onclick="window.open(\'../etc/writeQna.php\',\'test\',\'width=550,height=400,location=no,status=no,scrollbars=yes\');"></input>
                        </div>

                        <div class="qnaHeader">
                            <div class="qnaHeaderItems" id="qnaHeaderStatus">답변상태</div>
                            <div class="qnaHeaderItems" id="qnaHeaderTitle">제목</div>
                            <div class="qnaHeaderItems" id="qnaHeaderWriter">작성자</div>
                            <div class="qnaHeaderItems" id="qnaHeaderDate">작성일</div>
                        </div>
                        ';
        while($row = mysqli_fetch_array($questionTableResult)){
            echo       '<div class="qnaBodyItems">
                            <div id="qnaBodyStatus">'.$row["status"].'</div>
                            <div style="cursor: pointer" onclick="doDisplay(\'qnaBodyDetailAndCommentContainer'.$row["id"].'\')" class="qnaBodyTitle" id="qnaBodyTitle'.$row["id"].'">'.$row["description"].'</div>
                            <div id="qnaBodyWriter">'.$row["writer"].'</div>
                            <div id="qnaBodyDate">'.$row["date"].'</div>
                        </div>';
            echo        '<div style="display:none" class="qnaBodyDetailAndCommentContainer" id="qnaBodyDetailAndCommentContainer'.$row["id"].'">
                            <div class="qnaBodyDetailAndComment">
                                <div id="qnaBodyStatus"></div>
                                <div id="qnaBodyDetail">'.$row["description"].'</div>
                                <div id="qnaBodyWriter"></div>
                                <div id="qnaBodyDate"></div>
                            </div>';

            $this->showQuestionEditDelete($row);
            $answerTableResult = $this->accessAnswerTable($row['id']);
            while($row2 = mysqli_fetch_array($answerTableResult)){
                $this->qnaAnswer($row2,$row);
            }
            echo'                </div>
                        ';
        }
        echo'
                    </div>';
        echo '<div style="margin-left: 400px; margin-top: 20px">';
        if ($nowBlock != 1){
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($s_page-1).'" style="font-size: 12px" >이전</a>';
        }
        for ($p=$s_page; $p<=$e_page; $p++) {
            echo'   <a class="qnaPageNum" id="page'.$p.'" href="'.$_SERVER['PHP_SELF'].'?page='.$p.'" style="display: inline-block; color: black; font-weight: bold; width: 20px; height: 20px; text-align:center;padding-top:6px">'.$p.'</a>';
        }
        if ($blockNum !== $nowBlock){
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($e_page+1).'" style="margin-left: 5px; font-size: 12px">다음</a>';
        }
        echo '</div>';

        echo'      </div>
                ';
        echo '<script>
            document.getElementById("page'.$page.'").style.background = "black";
            document.getElementById("page'.$page.'").style.color = "white";
        </script>';

    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
