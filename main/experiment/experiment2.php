<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8"/>
    <title>CKEditor 4 설치하기</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
hello
<?php
$who = 'sgo8308@naver.com';
$title = 'How to send a email to subscribers?';
$content = 'Take a look at this example. Deathly simple it is!';
$optionValue = 'From: who <sgo8308@gmail.com> \r\n';
$header = "MIME-Version: 1.0";
$header.= "Content-Type: text/html; charset=utf-8";
$header.= "X-Mailer: PHP";

$result = mail( $who, $title, $content, $optionValue);
if($result){echo "성공";}else{echo "실패";}
//
//$to = "sgo8308@naver.com";
//$subject = "PHP 메일 발송";
//$contents = "PHP mail()함수를 이용한 메일 발송 테스트";
//$headers = "From: sgo8308@gmail.com\r\n";
//
//$result = mail($to, $subject, $contents);
//if($result){echo "성공";}else{echo "실패";}
?>
hello
</body>


</html>



