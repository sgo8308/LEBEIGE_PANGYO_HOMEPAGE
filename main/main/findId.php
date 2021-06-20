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
</head>
<style>
    #button{
        color: #fff;
        background: #111;
        border: 1px solid #111 !important;
        text-align: center;
        display: inline-block;
        width: 77%;
        height: 39px;
        padding: 5px 16px;
    }
    .logInBigContainer{
        align-content: center;
        width: 520px;
        height: 535px;
        margin-top: 100px;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-direction: column;
    }
    .logInContainer{
        justify-content: center;
        display: flex;
        flex-direction: row;
    }
    .logInItems{
        flex-grow: 1;
    }
    .cantLogIn a{
        margin-top: 20px;
        flex-grow: 1;
        font-size: 14px;
    }
    input[type="text"],input[type="password"], input[type="text"], input[type="email"], input[type="url"], input[type="tel"]{
        margin: 0 0 10px 0;
        padding: 5px 0;
        width: 100%;
        height: 24px;
        line-height: 24px;
        border: 0;
        border-bottom: 1px solid #e5e5e5;
        box-sizing: content-box;
        appearance: none;
        font-size: 14px;
    }

</style>
<body>
<?php
include_once '../templete/mainTemplete.php';
include_once '../templete/logInTemplete.php';

if ($_SESSION['userId'] !=''){
    echo '<script>location.href = "../index.php"</script>';
}

class main extends Layout{

    public function drawRightOfMain(){
        echo '
                <h3 style="font-size: 32px; margin-top: 130px;">아이디 찾기</h3>
                
                <div class="logInBigContainer">
                        <form action="..\dataProcessing\logInDataProcessing.php" method="post">                      
                            <div class="logInContainer">
                                <div class="logInItems">
                                    <input type="text" name="userId" placeholder="이름"><br>
                                    <input type="password" name="pw" placeholder="이메일">
                                    <input type="password" name="pw" placeholder="인증번호">
                                </div>
                                <div class="logInItems">
                                    <input type="button" value="인증번호 받기" style="margin-top: 45px"></input>
                                </div>
                            </div>
                            <input type="submit" id="button" value="다음" style="margin-top: 5px"></input>
                        
                        </form>                   
                </div>
                
                ';
    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
