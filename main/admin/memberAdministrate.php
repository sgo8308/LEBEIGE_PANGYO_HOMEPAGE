<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="..\css\forAll.css?15">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <style>
        .memberAdContainer{
            width: 600px;
            /*border-top: 1px solid #eaeced;*/
            border-bottom: 2px solid black;
            border-top: 2px solid black;
            margin-top: 30px;
            padding: 20px 0 20px 20px;
        }
        h3{
            font-size: 32px;
            margin-top: 130px;
        }
        .memberAdItems{
            display: flex;
            flex-direction: row;
        }
        .memberAdItemsHeaderItems{
            width: 200px;
            margin-bottom: 30px;
        }
        .memberAdItemsBodyItems{
            width: 200px;
            margin-bottom: 30px;
            padding-top: 5px;

        }
        #memberOutButton{
            display: inline;
            margin-left: 20px;
            font-size: 13px;
            height: 30px;
            width: 120px;
            line-height: 25px;
            color: #444;
            text-align: center;
            border: 1px solid #e5e5e5;
            background: #fff;
            cursor: pointer;
        }

    </style>
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';

class Paging {
    public $dataNum ;
    public $dataNumForPage ;
    public $pageNumForBlock ;
    public $page ;
    public $pageNum ; // 총 페이지
    public $blockNum ; // 총 블록
    public $nowBlock;
    public $s_page ;
    public $e_page ;
    public $startPoint;

    public function accessMemberTableForDataNum()
    {
        global $memberDbConnection;
        $conn = $memberDbConnection;
        $query = "SELECT * FROM Member ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function setPagingVariable($dataNumForPage,$pageNumForBlock){
        $this->dataNum = mysqli_num_rows($this->accessMemberTableForDataNum());
        $this->dataNumForPage = $dataNumForPage ;
        $this->pageNumForBlock = $pageNumForBlock;
        $this->page = ($_GET['page'])?$_GET['page']:1;
        $this->pageNum = ceil($this->dataNum/$dataNumForPage);
        $this->blockNum = ceil($this->pageNum/$pageNumForBlock);
        $this->nowBlock = ceil($this->page/$pageNumForBlock);
        $this->s_page = ($this->nowBlock * $pageNumForBlock) - ($pageNumForBlock - 1);
        $this->e_page = $e_page = $this->nowBlock*$pageNumForBlock;
        $this->startPoint = ($this->page-1) * $dataNumForPage;

        if ($this->s_page <= 1) {
            $this->s_page = 1;
        }
        if ($this->pageNum <= $e_page) {
            $this->e_page = $this->pageNum;
        }
    }

    public function makePagingNum(){
        echo '<div style="display: flex;flex-direction: row;justify-content: center;width: 600px">';
        echo '<div style="margin-left: auto;margin-right: auto; margin-top: 50px">';
        if ($this->nowBlock != 1){
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($this->s_page-1).'" style="font-size: 12px" >이전</a>';
        }
        for ($p=$this->s_page; $p<=$this->e_page; $p++) {
            echo'   <a class="qnaPageNum" id="page'.$p.'" href="'.$_SERVER['PHP_SELF'].'?page='.$p.'" style="display: inline-block; color: black; font-weight: bold; width: 20px; height: 20px; text-align:center;padding-top:6px">'.$p.'</a>';
        }
        if ($this->blockNum !== $this->nowBlock){
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($this->e_page+1).'" style="margin-left: 5px; font-size: 12px">다음</a>';
        }
        echo '</div>';
        echo '</div>';
    }

    public function colorPageNum(){
        echo '<script>
                document.getElementById("page'.$this->page.'").style.background = "black";
                document.getElementById("page'.$this->page.'").style.color = "white";
            </script>';
    }

    public function accessMemberTable()
    {
        global $memberDbConnection;
        $conn = $memberDbConnection;
        $query = "SELECT * FROM Member ORDER BY id DESC LIMIT $this->startPoint,$this->dataNumForPage  ";
        $result = mysqli_query($conn, $query);
        return $result;
    }
}

class main extends Layout{

    public function drawRightOfMain(){
        echo '<script src="../etc/deleteMember.js"></script>';
        $list = new Paging();
        $list->setPagingVariable(10,3);
        $result = $list->accessMemberTable();
        echo '<h3>회원 관리</h3>';
        echo '<div class="memberAdContainer">
                <div class="memberAdItems" id="memberAdItemsHeader">
                    <div class="memberAdItemsHeaderItems" >회원 아이디</div>
                    <div class="memberAdItemsHeaderItems" style="width: 145px;" >회원 이름</div>
                    <div class="memberAdItemsHeaderItems" >회원 이메일</div>
                </div>';
        while($row = mysqli_fetch_array($result)) {
            if ($row['userId'] != 'admin123'){
                echo '
                <div class="memberAdItems" id="memberAdItemsBody">
                    <div class="memberAdItemsBodyItems" id="memberId_'.$row['userId'].'" style="width: 280px" >'.$row['userId'].'</div>
                    <div class="memberAdItemsBodyItems" >'.$row['name'].'</div>
                    <div class="memberAdItemsBodyItems" >'.$row['email'].'</div>
                    <input type="button" id="memberOutButton" value="강제 탈퇴" onclick="forceDeleteMember($(\'#memberId_'.$row['userId'].'\').text());">
                </div>';
            }
        }
        
            echo'



             </div>';
        $list->makePagingNum();
        $list->colorPageNum();





    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
