<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?1">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <link rel="stylesheet" href="..\css\signUp.css?4">
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/signUpTemplete.php';

class main extends Layout{
    public function drawRightOfMain(){
        $list = new SignUpLayout();
        $list->drawSignUpLayout();
    }
}
$main = new main();
$main->drawMainLayout();
?>
</body>
</html>