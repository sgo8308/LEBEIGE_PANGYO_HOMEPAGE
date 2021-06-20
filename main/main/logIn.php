<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?15">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <link rel="stylesheet" href="..\css\logIn.css?5">
</head>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/logInTemplete.php';

if ($_SESSION['userId'] !=''){
    echo '<script>location.href = "../index.php"</script>';
}

class main extends Layout{

    public function drawRightOfMain(){
        $list = new LogInLayout();
        $list->drawLogInLayout();
    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
