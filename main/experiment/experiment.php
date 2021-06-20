<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8"/>
    <title>CKEditor 4 설치하기</title>
    <script  src="../ckeditor4/ckeditor.js"></script>
    <script >
        //<![CDATA[
        function LoadPage() {
            CKEDITOR.replace('contents');
        }
        function FormSubmit(f) {
            CKEDITOR.instances.contents.updateElement();
            if(f.contents.value == "") {
            alert("내용을 입력해 주세요.");
            return false;
        }
            alert(f.contents.value);
            //전송은 하지 않습니다.
            return false;
        }
        //]]>
    </script>
</head>
<body onload="LoadPage();">
<form id="EditorForm" name="EditorForm" onsubmit="return FormSubmit(this);">
    <div>
        <label for="title">제목</label>
        <input type="text" id="title" name="title" size="40"/>
    </div>
    <div>
        <label for="contents">내용</label>
        <textarea id="contents" name="contents"></textarea>
    </div>
    <div><input type="submit" value="전송"></div>
</form>

<?php
class testest{
    public function test(){
        echo 1;
    }
}

?>


<script>
    CKEDITOR.instances.contents.
</script>
</body>
</html>


<!---->
<?php
////include_once('../PHPMailer/PHPMailerAutoload.php');
//include_once('/usr/local/apache2.4/htdocs/PHPMailer/PHPMailerAutoload.php');
//
//function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
//{
//    if ($type != 1) $content = nl2br($content);
//    // type : text=0, html=1, text+html=2
//    $mail = new PHPMailer(); // defaults to using php "mail()"
//    $mail->IsSMTP();
//    //   $mail->SMTPDebug = 2;
//    $mail->SMTPSecure = "ssl";
//    $mail->SMTPAuth = true;
//    $mail->Host = "smtp.naver.com";
//    $mail->Port = 587;
//    $mail->Username = "sgo8308";
//    $mail->Password = "thswldn123!";
//    $mail->CharSet = 'UTF-8';
//    $mail->From = $fmail;
//    $mail->FromName = $fname;
//    $mail->Subject = $subject;
//    $mail->AltBody = ""; // optional, comment out and test
//    $mail->msgHTML($content);
//    $mail->addAddress($to);
//    if ($cc)
//        $mail->addCC($cc);
//    if ($bcc)
//        $mail->addBCC($bcc);
//    if ($file != "") {
//        foreach ($file as $f) {
//            $mail->addAttachment($f['path'], $f['name']);
//        }
//    }
//    if ( $mail->send() ) echo "성공";
//    else echo "실패";
//}
//
//mailer("르베이지판교","sgo8308@naver.com","sgo8308@gmail.com","인증번호입니다","내용" );
//?>
