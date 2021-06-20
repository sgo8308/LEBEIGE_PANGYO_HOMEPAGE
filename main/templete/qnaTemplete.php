<?php
include_once '../etc/dbConnection.php';

class QnaLayout{

    public function qnaAnswer($answerArray,$questionArray){
    echo                    '<div class="qnaCommentContainer" id="qnaCommentContainer">
                                <div class="qnaCommentTop">
                                    <div class="qnaCommentItems" style="font-size: 16px; color: #a3a9b3">└</div>
                                    <div class="qnaCommentItems" style="background:#a3a9b3;color: #ffffff; padding: 4px; width: 24px; margin-left: 3px">답변</div>
                                    <div class="qnaAnswerDescription" id="qnaAnswerDescription'.$answerArray["id"].'">'.$answerArray['answer'].'</div>
                                    <div class="qnaCommentItems" id="qnaAnswerWriter">르베이지 판교점</div>
                                    <div class="qnaCommentItems" id="qnaAnswerDate">'.$answerArray['date'].'</div>
                                </div>';
        if($_SESSION['userId'] === "admin123"){
            echo'               <div class="qnaCommentBottom">
                                    <div class="qnaBodyAnswerEditDeleteItems" id="qnaBodyQuestionEdit">
                                        <a href="../etc/writeQnaAnswer.php?answerid='.$answerArray['id'].'" onclick="
                                            window.open(this.href, \'_blank\', \'width=550,height=400,location=no,status=no,scrollbars=yes\');
                                            return false;">
                                            수정
                                        </a>
                                    </div>
                                    <div class="qnaBodyAnswerEditDeleteItems" id="qnaBodyQuestionDelete" onclick="deleteAnswer('.$answerArray['id'].','.$questionArray['id'].')" style="cursor: pointer">
                                        삭제
                                    </div>
                                </div>
                            ';
        }
        echo '</div>';
    }

    public function accessQusetionTableForDataNum(){
        global $qnaDbConnection;
        $conn= $qnaDbConnection;
        $query = "SELECT * FROM Question";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function accessQusetionTable($startPoint,$dataNumForPage){
        global $qnaDbConnection;
        $conn= $qnaDbConnection;
        $query = "SELECT * FROM Question ORDER BY id DESC LIMIT $startPoint,$dataNumForPage";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function accessAnswerTable($questionId){
        global $qnaDbConnection;
        $conn= $qnaDbConnection;
        $query = "SELECT * FROM Answer WHERE question_id = $questionId ORDER BY id DESC ";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function showQuestionEditDelete($row){
        echo '  <div class="qnaBodyQuestionEditDelete">';
        if ($row['writer'] === $_SESSION['userId'] || $_SESSION['userId'] === "admin123"){
            if ($row['writer'] === $_SESSION['userId']){
                echo'
                            <div class="qnaBodyQuestionEditDeleteItems" id="qnaBodyQuestionEdit">
                                <a href="../etc/writeQna.php?postid='.$row["id"].'" onclick="
                                    window.open(this.href, \'_blank\', \'width=550,height=400,location=no,status=no,scrollbars=yes\');
                                    return false;">
                                    수정
                                </a>
                            </div>
                            <div class="qnaBodyQuestionEditDeleteItems" id="qnaBodyQuestionDelete" onclick="deleteQuestion('.$row['id'].')" style="cursor: pointer">삭제</div>
                            ';
            }else{
                echo'       <div class="qnaBodyQuestionEditDeleteItems" id="qnaBodyQuestionDelete" onclick="deleteQuestion('.$row['id'].')" style="cursor: pointer">삭제</div>
                            <div class="qnaBodyQuestionEditDeleteItems" id="qnaBodyDoAnswer" onclick="
                                window.open(\'../etc/writeQnaAnswer.php?questionid='.$row["id"].'\',\'test\',\'width=550,height=400,location=no,status=no,scrollbars=yes\');"
                                style="cursor: pointer">
                                답변하기
                            </div>';
            }

        }
        echo '</div>';
    }

    public function drawQnaLayout(){
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

        $questionTableResult = $this->accessQusetionTable(($page-1) * $dataNumForPage,$dataNumForPage);

        /*---*/
        echo '<script>
                function doDisplay(id){
                    var con = document.getElementById(id);
                    if(con.style.display=="none"){
                        con.style.display = "flex";
                    }else{
                        con.style.display = "none";
                    }
                }
            </script>';

        echo '<script src="../etc/deleteWriting.js"></script>';
        echo '
            <div class="qnaBigContainer">
                <h3 style="font-size: 32px; margin-top: 130px; ">Q&A</h3>
                    <div class="qnaContainer">
                        
                        <div style="margin-top: 15px">
                            <h1 style="font-size: 20px;display: inline-block">Total : '.mysqli_num_rows($this->accessQusetionTableForDataNum()).'</h1>';
                            if ($_SESSION['userId']){
                            echo '<input type="button" value="질문 작성하기" onclick="window.open(\'../etc/writeQna.php\',\'test\',\'width=550,height=400,location=no,status=no,scrollbars=yes\');"/>';
                            }
       echo '           </div>

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

?>
