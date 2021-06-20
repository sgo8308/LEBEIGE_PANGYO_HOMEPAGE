<?php
include_once 'etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="css\forAll.css?15">
    <link rel="stylesheet" href="css\mainTemplete.css?13">

</head>
<body>
<?php
include_once 'templete/mainTemplete.php';
class main extends Layout{
    public function drawRightOfMain(){
        echo '<img id="mainImage" src="image\shopImage22.jpg">';
    }
}
$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
