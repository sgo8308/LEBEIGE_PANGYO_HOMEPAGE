<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?18">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010011">
    <link rel="stylesheet" href="..\css\everyClothes.css?9">

</head>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/listTemplete.php';

class shirtsBlouseLayOut extends ListLayout{
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

    public function accessClothesTableForDataNum()
    {
        global $clothesDbConnection;
        $conn= $clothesDbConnection;
        $query = "SELECT * FROM Clothes ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function setPagingVariable($dataNumForPage,$pageNumForBlock){
        $this->dataNum = mysqli_num_rows($this->accessClothesTableForDataNum());
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
        echo '<div style="margin-left: auto;margin-right: auto; margin-top: 150px">';
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
    }

    public function colorPageNum(){
        echo '<script>
                document.getElementById("page'.$this->page.'").style.background = "black";
                document.getElementById("page'.$this->page.'").style.color = "white";
            </script>';
    }
    public function accessClothesTable()
    {
        global $clothesDbConnection;
        $conn= $clothesDbConnection;
        $query = "SELECT * FROM Clothes WHERE (category1 = '셔츠/블라우스') ORDER BY id DESC LIMIT $this->startPoint,$this->dataNumForPage";
        $result = mysqli_query($conn, $query);
        return $result;
    }

}

class main extends Layout{

    public function drawRightOfMain(){
        $list = new shirtsBlouseLayOut();
        $list->setPagingVariable(60,10);
        $list->drawListLayout();
        $list->makePagingNum();
        $list->colorPageNum();
    }

}
$main = new main();
$main->drawMainLayout();
?>
<script>
    document.getElementById("navTitle").textContent = "셔츠/블라우스";
</script>
</body>
</html>
