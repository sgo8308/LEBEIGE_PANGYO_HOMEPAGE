<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
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
        }
        #memberOutButton{
            color: #111;
            background: #fff;
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
        echo '<script src="../etc/deleteMember.js"></script>';
        echo '<h3 style="font-size: 32px; margin-top: 130px">내 정보</h3>';
        echo '<div class="mypageContainer">';
        if($_SESSION['userId'] == null){
            echo '<script>
                    location.href = "../main/logIn.php"
                </script>';
        }else{
            echo '
                <div class="myPageBigContainer">
                    <div class="myPageContainer">
                        <form action="..\dataProcessing\myPageDataProcessing.php" method="post">
                        <div class="myPageItems">
                            <div class="necessaryForMyPage">
                                <div style="margin-right: 100px">아이디</div>
                                <div ">'.$_SESSION['userId'].'</div>
                            </div>
                            <div class="necessaryForMyPage">
                                <div class="necessaryForMyPageItems myPageItemTitle">
                                    이름 *
                                </div>
                                <input type="text" class="necessaryForMyPageItems" name="name" value="'.$row['name'].'">
                            </div>
                            <div class="necessaryForMyPage">
                                <div class="necessaryForMyPageItems myPageItemTitle">이메일 *</div>
                                <input type="email"  class="necessaryForMyPageItems" name="email" value="'.$row['email'].'">
                            </div>
                            <div class="necessaryForMyPage">
                                <div class="necessaryForMyPageItems myPageItemTitle">
                                    비밀번호
                                </div>
                                <input type="password"  class="necessaryForMyPageItems" name="pw" value="12341234" disabled="disabled" style="border-bottom: none;width: 70%">
                                <input type="button" id="changePw" value="비밀번호 변경" onclick="location.href =\'changePassword.php\'">
                            </div>
                            
                        </div>
                        <div class="myPageItems">
                            <input type="submit" value="정보 수정">
                            <input type="button" id="memberOutButton" value="회원 탈퇴" onclick="deleteMember(\''.$_SESSION['userId'].'\')">
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
