<?php
$userId = $_GET['userid'];
global $memberDbConnection;
$conn= $memberDbConnection;
$query = " SELECT * FROM Member.Member where userId = '$userId' ";
$result = mysqli_query($conn, $query);

echo mysqli_error($conn); //에러나면 에러내용 출력하기
if (strlen($userId) < 6){
    echo '6자 이상의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다.';
}else{
    if(mysqli_fetch_array($result)){
        echo "<span style='color: red'>이미 존재하는 아이디입니다.</span>";
    }else{
        echo "<span style='color: #5cdc5c'>멋진 아이디네요!</span>";
        echo "<script>window.opener.document.getElementById('idConfirm').value = 'ok';</script>";
    }
}

echo '<input type="button" value="닫기" onclick="window.close();">'
?>
