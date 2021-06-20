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
    <link rel="stylesheet" href="..\css\qna.css?43">

</head>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/qnaTemplete.php';

class main extends Layout{

    public function drawRightOfMain(){
        $list = new QnaLayout();
        $list->drawQnaLayout();
    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
