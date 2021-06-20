<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?1">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010011">
    <link rel="stylesheet" href="..\css\clothesTemplete.css?21">
</head>
<style>
    .chatButton{
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
include_once '../templete/clothesTemplete.php';

class main extends Layout{

    public function drawRightOfMain(){
        $list = new ClothesLayout();
        $list->drawClothesLayout();
    }
}
$main = new main();
$main->drawMainLayout();
?>
</body>
</html>