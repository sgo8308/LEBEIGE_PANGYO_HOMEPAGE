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
        .myPageBigContainer{
            width: 960px;
        }
        .myPageContainer{
            align-content: center;
            width: 520px;
            height: 535px;
            margin-top: 100px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
        }
        .necessaryForMyPage{
            display: flex;
            flex-direction: row;
            color: #777777;
            margin-bottom: 20px;
        }
        .necessaryForMyPageItems{
            flex-grow: 1;
        }
        .myPageItemTitle{
            display: inline-block;
            color: #8e8e8e;
            font-size: 14px;
            margin-right: 30px;
            flex-basis: 150px;
            vertical-align: middle;
            padding: 10px 0;
        }
        .myPageItems{
            display: flex;
            flex-direction: column;
        }
        .myPageItems input[type="submit"]{
            color: #fff;
            background: #111;
            border: 1px solid #111 !important;
            text-align: center;
            display: inline-block;
            width: 160px;
            height: 50px;
            padding: 10px;
            margin-right: auto;
            margin-left: auto;
            align-content: center;
            margin-top: 30px;
            cursor: pointer;
        }
        input[type="text"],input[type="password"], input[type="text"], input[type="email"]{
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
        #changePw{
            display: inline;
            margin-left: 20px;
            font-size: 13px;
            height: 30px;
            width: 120px;
            line-height: 25px;
            color: #444;
            text-align: center;
            border: 1px solid #e5e5e5;
            background: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
<?php
include_once '../templete/mainTemplete.php';

class main extends Layout{
    public function accessMemberTable(){
        $userId = $_SESSION['userId'];
        global $memberDbConnection;
        $conn= $memberDbConnection;
        $query = "SELECT * FROM Member WHERE userId = '$userId'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function drawRightOfMain(){
        $row = mysqli_fetch_array($this->accessMemberTable());

        echo '<h3 style="font-size: 32px; margin-top: 130px">비밀번호 변경</h3>';
        echo '<div class="mypageContainer">';
        if($_SESSION['userId'] == null){
            echo '<script>
                    location.href = "../main/logIn.php"
                </script>';
        }else{
            echo '
                <div class="myPageBigContainer">
                    <div class="myPageContainer">
                        <form action="..\dataProcessing\changePwDataProcessing.php" method="post">
                        <div class="myPageItems">                               
                                <div class="necessaryForMyPage">
                                    <div class="necessaryForMypageItems myPageItemTitle">
                                        새 비밀번호
                                    </div>
                                    <input type="password"  class="necessaryForMypageItems" name="pw" placeholder="6자 이상 입력해주세요">
                                </div>
                                <div class="necessaryForMyPage">
                                    <div class="necessaryForMypageItems myPageItemTitle">
                                        새 비밀번호 확인
                                    </div>
                                    <input type="password"  class="necessaryForSignUpItems" name="pwConfirm">
                                </div>             
                        </div>
                        <div class="myPageItems">
                            <input type="submit" value="확인">
                        </div>
                        </form>
                    </div>
            </div>            
                ';
        }
        echo '</div>';
    }
}
$main = new main();
$main->drawMainLayout();
?>
</body>
</html>
