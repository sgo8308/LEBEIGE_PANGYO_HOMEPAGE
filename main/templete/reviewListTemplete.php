<?php
class ReviewLayout{

    public function accessReviewTableForDataNum(){
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Review";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function accessReviewTable($startPoint,$dataNumForPage){
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Review ORDER BY id DESC LIMIT $startPoint,$dataNumForPage";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    

    public function drawReviewLayout(){
        //페이징을 위한 변수 만들기
        $resultForDataNum = $this->accessReviewTableForDataNum();
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

        $questionTableResult = $this->accessReviewTable(($page-1) * $dataNumForPage,$dataNumForPage);

        /*---*/

        echo '<script src="../etc/deleteWriting.js"></script>';

        echo '
            <div class="reviewBigContainer">
                <h3 style="font-size: 32px; margin-top: 130px; ">매장 리뷰</h3>
                    <div class="reviewContainer">
                        <div style="margin-top: 15px">
                            <h1 style="font-size: 20px;display: inline-block">Total : '.mysqli_num_rows($this->accessReviewTableForDataNum()).'</h1>';
                            if ($_SESSION['userId']){
                            echo '<input type="button" value="리뷰 작성하기" onclick="location.href = \'../etc/writeReview.php\'" style="cursor:pointer;"/>';
                            }
        echo '          </div>

                        <div class="reviewHeader">
                            <div class="reviewHeaderItems" id="reviewHeaderStatus">번호</div>
                            <div class="reviewHeaderItems" id="reviewHeaderTitle">제목</div>
                            <div class="reviewHeaderItems" id="reviewHeaderWriter">작성자</div>
                            <div class="reviewHeaderItems" id="reviewHeaderDate">작성일</div>
                        </div>
                        ';
        while($row = mysqli_fetch_array($questionTableResult)){
            echo       '<div class="reviewBodyItems">
                            <div id="reviewBodyStatus">'.$row["id"].'</div>
                            <div style="cursor: pointer" onclick="location.href = \'review.php?reviewid='.$row['id'].'\'" class="reviewBodyTitle" id="reviewBodyTitle'.$row["id"].'">'.$row["title"].'</div>
                            <div id="reviewBodyWriter">'.$row["writer"].'</div>
                            <div id="reviewBodyDate">'.$row["date"].'</div>
                        </div>';
        }
        echo'
                    </div>';
        echo '<div style="margin-left: 400px; margin-top: 20px">';
        if ($nowBlock != 1){
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($s_page-1).'" style="font-size: 12px" >이전</a>';
        }
        for ($p=$s_page; $p<=$e_page; $p++) {
            echo'   <a class="reviewPageNum" id="page'.$p.'" href="'.$_SERVER['PHP_SELF'].'?page='.$p.'" style="display: inline-block; color: black; font-weight: bold; width: 20px; height: 20px; text-align:center;padding-top:6px">'.$p.'</a>';
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
