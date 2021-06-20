<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?15">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010011">
    <style>
        .mypageContainer{
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            width: 960px;
            align-items: center;
        }
        .mypageItems{
            box-sizing: border-box;
            width: 300px;
            height: 50px;
            border: 1px solid #777777;
            text-align: center;
            padding-top: 18px;
            margin-top: 10px;
        }

    </style>
</head>

<body>
<?php
include_once '../templete/mainTemplete.php';

class main extends Layout{
    public function drawRightOfMain(){
        if($_SESSION['userId'] == null){
            echo '<script>
                    location.href = "../main/logIn.php"
                </script>';
        }
        echo '<h3 style="font-size: 32px; margin-top: 130px">관리자 페이지</h3>';
        echo '<div class="mypageContainer">';

        echo '
                <div class="mypageItems" onclick="location.href = \'../main/myPage.php\'" style="cursor: pointer">내정보 수정</div>
                <div class="mypageItems" onclick="location.href = \'../admin/addClothes.php\'" style="cursor: pointer">상품 등록</div>
                <div class="mypageItems" onclick="location.href = \'../admin/memberAdministrate.php\'" style="cursor: pointer">회원 관리</div>';
        echo '</div>';


    }
}
$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
