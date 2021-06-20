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
        .reviewContainer{
            box-sizing: border-box;
            width: 960px;
            display: flex;
            flex-direction: column;
            padding: 52px;
            border: 1px solid rgb(215, 215, 215);
            margin-top: 50px;
        }
        .reviewItems{
            margin: 10px 0;
        }
        #reviewItemsTitle{
            font-size: 28px;
        }
        #reviewItemsWriterDate{
            border-bottom: 1px solid rgb(215, 215, 215);
            padding-bottom: 30px;
            font-size: 14px;
        }
        #reviewItemsDetail{
            margin-top : 40px;
            border-bottom: 1px solid rgb(215, 215, 215);
            padding-bottom: 50px;
        }
        .reviewCommentContainer{
            font-size: 14px;
            display: flex;
            flex-direction: column;
        }
        .comment{
            padding: 12px 12px 12px 0;
            line-height: 20px;
        }
        .commentWriter{
            font-size: 15px;
            font-weight: bold
        }
        .commentDetail{
            font-size: 13px;
            overflow: hidden;
            word-break: break-word
        }
        .dateEditDel{
            font-size: 10px;
            display: flex;
            flex-direction: row;
            margin-bottom: 5px;
        }
        textarea{
            border-radius:6px;
            border:2px solid rgb(229,229,229);
            padding: 5px;
            min-height: 50px;
            margin-top: 10px;
        }
        .editButton{
            margin-left: auto;
            margin-right: 10px;
            cursor: pointer;
        }
        .deleteButton{
            cursor: pointer;
        }
        .editContailner{
            border-top: solid 1px rgb(229,229,229);
            display: none;
        }
        .editTextArea{
            width: 100%;
        }
        .editCommentEnterButton{
            float: right;
            margin-top: 5px
        }
    </style>
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';

class main extends Layout{

    public function accessReviewTable(){
        $id = $_GET['reviewid'];
        global $reviewDbConnection;
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Review WHERE (id = '$id')";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function accessCommentTable(){
        $id = $_GET['reviewid'];
        global $reviewDbConnection;
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Comment WHERE (reviewId = '$id')";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function accessCommentTable2(){
        $id = $_GET['reviewid'];
        global $reviewDbConnection;
        $conn= $reviewDbConnection;
        $query = "SELECT * FROM Comment WHERE (reviewId = '$id') ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function drawRightOfMain(){
        $row = mysqli_fetch_array($this->accessReviewTable());
        if (!$_GET['reviewid'] || !$row['id']){
            echo '<script>location.href="../main/reviewList.php"</script>';
        }
?>
    <h1 style="margin-top: 130px;font-size: 32px">매장 리뷰</h1>
    <div class="reviewContainer">
        <div class="reviewItems" id="reviewItemsTitle" style="font-size: 28px">
            <?=$row['title']?>
        </div>
        <div class="reviewItems" id="reviewItemsWriterDate">
            <span style="margin-right: 10px;"><?=$row['writer']?></span>
            <span><?=$row['date']?></span>
            <script src="../etc/deleteWriting.js?1"></script>

            <?php
            if($_SESSION['userId'] == $row['writer']){
            ?>
                <input type="button" value="리뷰 삭제" style="display: inline-block;float: right;font-weight: bold;color: red" onclick="deleteReview('<?=$row['id']?>')">
                <form style="display: inline-block;float: right;margin-right: 5px" action="../etc/editReview.php" method="post">
                    <input type="hidden" value="<?=$row['id']?>" name="reviewid">
                    <input type="submit" value="리뷰 수정" style="font-weight: bold"/>
                </form>
            <?php
            }else if($_SESSION['userId'] == 'admin123'){
            ?>
                <input type="button" value="리뷰 삭제" style="display: inline-block;float: right;font-weight: bold;color: red" onclick="deleteReview('<?=$row['id']?>')">
                <?php
            }
            ?>
        </div>
        <div class="reviewItems" id="reviewItemsDetail" style="font-size: 17px">
            <?=$row['detail']?>
        </div>
        <div class="reviewCommentContainer">
            <div class="reviewCommentItems">
                <div class="commentHeader" style="font-size: 17px; font-weight: bold; margin-top: 15px; margin-bottom: 15px">댓글 <?=mysqli_num_rows($this->accessCommentTable())?></div>
                <?php
                $result2 = $this->accessCommentTable();
                while($row2 = mysqli_fetch_array($result2)){
                ?>
                <div class="comment" id="comment<?=$row2['id']?>" style="margin-left: 5px">
                    <div class ="commentWriter"><?=$row2['writer']?></div>
                    <div class="commentDetail" id="commentDetail<?=$row2['id']?>"><?=$row2['detail']?></div>
                    <div class="dateEditDel">
                        <div class="commentDate"><?=$row2['date']?></div>
                        <?php
                        if($_SESSION['userId'] == $row2['writer']){
                        ?>
                        <div class="editButton" id="editButton<?=$row2['id']?>">수정</div>
                        <div class="deleteButton" id="deleteButton<?=$row2['id']?>">삭제</div>
                        <?php
                        }else if($_SESSION['userId'] == 'admin123'){
                        ?>
                            <div class="deleteButton" id="deleteButton<?=$row2['id']?>" style="margin-left: auto">삭제</div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="editContailner" id="editContainer<?=$row2['id']?>">
                        <textarea class="editTextArea" id="editTextArea<?=$row2['id']?>"><?=$row2['detail']?></textarea>
                        <input type="button" class="editCommentEnterButton" id="editCommentEnterButton<?=$row2['id']?>" value="수정">
                    </div>
                </div>
                <?php
                }
                ?>
                <textarea id="textArea" style="width: 100%;" placeholder="댓글을 남겨보세요"></textarea>
                <input type="button" id="commentEnterButton" value="등록" style="float: right; margin-top: 5px">
            </div>
        </div>
    </div>


<?php
    }
}
$main = new main();
$main->drawMainLayout();
?>
<script>
    function addComment(data){
        var $newComment = $('<div class="comment" id="comment'+data.id+'" style="margin-left: 5px"></div>');
        var $newCommentWriter = $('<div class="commentWriter"></div>')
        var $newCommentDetail = $('<div class="commentDetail" id="commentDetail'+data.id+'"></div>')
        var $newCommentDateEditDel = $('<div class="dateEditDel"></div>')
        var $newCommentDate = $('<div class="commentDate"></div>')
        var $newEditButton = $('<div class="editButton" id = "editButton'+data.id+'">수정</div>')
        var $newDeleteButton = $('<div class="deleteButton" id = "deleteButton'+data.id+'">삭제</div>')
        var $newEditContailner = $('<div class="editContailner" id="editContainer'+data.id+'"></div>')
        var $newEditTextArea = $('<textarea class="editTextArea" id="editTextArea'+data.id+'">'+data.detail+'</textarea>')
        var $newEditCommentEnterButton = $('<input type="button" class="editCommentEnterButton" id="editCommentEnterButton'+data.id+'" value="수정">')
        $newCommentWriter.text("<?=$_SESSION['userId']?>");
        $newCommentDetail.text($("#textArea").val());
        $newCommentDate.text(data.date);
        $newComment.append($newCommentWriter);
        $newComment.append($newCommentDetail);
        $newComment.append($newCommentDateEditDel);
        $newCommentDateEditDel.append($newCommentDate);
        $newCommentDateEditDel.append($newEditButton);
        $newCommentDateEditDel.append($newDeleteButton);
        $newComment.append($newEditContailner);
        $newEditContailner.append($newEditTextArea);
        $newEditContailner.append($newEditCommentEnterButton);
        $newComment.insertBefore($("#textArea"));
    }
</script>

<script>
    function setAjax(){
        $(".editButton").click(function (){
            var fullId = $(this).attr('id');
            var numId = fullId.substr(10,(fullId.length)-1);
            if ($("#editContainer"+numId).css("display") == "none"){
                $("#editContainer"+numId).show();
            }else{
                $("#editContainer"+numId).hide();
            }
        })

        $(".deleteButton").click(function(){
            conf = confirm('정말로 삭제하시겠습니까?')
            if(conf){
                var fullId = $(this).attr('id');
                var numId = fullId.substr(12,(fullId.length)-1);
                $.ajax(
                    {
                        url: '../dataProcessing/deleteCommentDataProcessing.php',
                        type: 'POST',
                        data: {'commentId': numId,
                               'reviewId': <?= $_GET['reviewid']?>
                        },
                        dataType: "JSON",
                        success: (data)=>{
                            $("#comment"+numId).hide();
                            $(".commentHeader").text("댓글 "+data.commentNum)
                        }
                    })
            }
        })

        $(".editCommentEnterButton").click(function (){
            var fullId = $(this).attr('id');
            var numId = fullId.substr(22,(fullId.length)-1);
            $("#editContainer"+numId).hide();
            $.ajax(
                {
                    url: '../dataProcessing/editCommentDataProcessing.php',
                    type: 'POST',
                    data: {'commentId': numId,
                        'commentDetail': $("#editTextArea"+numId).val()
                    },
                    success: (data)=>{
                        $("#commentDetail"+numId).text($("#editTextArea"+numId).val());
                    }
                })
        })
    }
    setAjax();
    $("#commentEnterButton").click(()=>{
        $.ajax(
            {
                url: '../dataProcessing/commentDataProcessing.php',
                type: 'POST',
                async: false,
                dataType: "JSON",
                data: {'reviewId': <?= $_GET['reviewid']?>,
                    'commentDetail': $("#textArea").val()
                },
                success: (data)=>{
                    addComment(data);
                    $("#textArea").val('');
                    $(".editCommentEnterButton").off();
                    $(".deleteButton").off();
                    $(".editButton").off();
                    setAjax();
                    $(".commentHeader").text("댓글 "+data.commentNum)
                }
            })
    })
</script>
</body>
</html>
