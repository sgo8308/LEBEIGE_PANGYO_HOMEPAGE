<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?17">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <link rel="stylesheet" href="..\css\review.css">
    <style>
        .reviewBigContainer{
            width: 960px;
        }
        .reviewContainer{
            margin-top: 20px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            font-size: 12px;
            border-bottom: 1px solid #777777;

        }
        .reviewContainer input[type="button"]{
            float: right;
            height: 30px;
            color: #fff;
            background: #111;
            border: 1px solid #111 !important;
            text-align: center;
        }
        .reviewHeader{
            margin-top: 20px;
            border-top: 2px solid black;
            border-bottom: 1px solid #777777;
            display: flex;
            padding: 20px;
            font-weight: bold;

        }
        #reviewHeaderTitle{
            flex-basis: 700px;
            text-align: center;
            margin-left: 20px;
        }
        #reviewHeaderWriter{
            margin-left: auto;
        }
        #reviewHeaderDate{
            margin-left: 45px;
            margin-right: 30px;
        }

        .reviewBodyItems{
            padding: 20px;
            display: flex;
            flex-direction: row;
            flex: none;
        }
        #reviewBodyStatus{
            margin-left: 7px;
            width: 92px;
        }
        .reviewBodyTitle{
            margin-left: 20px;
            flex-basis: 670px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        #reviewBodyWriter{
            margin-left: auto;
            width: 88px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #reviewBodyDate{
            width: 100px;
            text-align: center;
        }
        .reviewBodyDetailAndCommentContainer{
            display: flex;
            flex-direction: column;
            border-top: 1px solid #eaeced;
            background-color: #f7f8fa;
            padding: 20px;
        }
        .reviewBodyDetailAndComment{
            display: flex;
            flex-direction: row;
            flex: none;
        }
        #reviewBodyDetail{
            margin-left: 20px;
            flex-basis: 700px;
            word-break:break-all;
            line-height: 20px;
            margin-bottom: 10px;
        }
        }
    </style>
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/reviewListTemplete.php';

class main extends Layout{

    public function drawRightOfMain(){
        $list = new ReviewLayout();
        $list->drawReviewLayout();
    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
