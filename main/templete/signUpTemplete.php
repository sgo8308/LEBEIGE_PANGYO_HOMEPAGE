<?php
class SignUpLayout{
    public function drawSignUpLayout(){
        echo '<script>
                function checkid(){
                    var userid = document.getElementById("userId").value;
                    if(userid)
                    {
                        url = "../dataProcessing/idCheckDataProcessing.php?userid="+userid;
                            window.open(url,"chkid","width=300,height=100");
                        }else{
                            alert("아이디를 입력하세요");
                        }
                    }
                </script>';
        echo '
               
            <div class="signUpBigContainer">
                <h3 style="font-size: 32px; margin-top: 130px">회원가입</h3>
                    <div class="signUpContainer">
                        <form action="..\dataProcessing\signUpDataProcessing.php" method="post">
                        <div class="signUpItems">
                            <div class="necessaryForSignUp">
                                <div class="necessaryForSignUpItems signUpItemTitle">아이디</div>
                                <input type="text" class="necessaryForSignUpItems" name="userId" id="userId" onchange="document.getElementById(\'idConfirm\').value = false;"style="width: 80%">
                                <input type="button" class="necessaryForSignUpItems" value="중복확인" onclick="checkid(); return false;" style="height: 30px">
                            </div>
                            <div class="necessaryForSignUp"><div class="necessaryForSignUpItems signUpItemTitle">이름</div><input type="text"  class="necessaryForSignUpItems" name="name"></div>
                            <div class="necessaryForSignUp">
                                <div class="necessaryForSignUpItems signUpItemTitle">이메일</div>
                                <input type="email"  class="necessaryForSignUpItems" name="email">
                            </div>
                            <div class="necessaryForSignUp"><div class="necessaryForSignUpItems signUpItemTitle">비밀번호</div><input type="password"  class="necessaryForSignUpItems" name="pw" placeholder="6자 이상 입력해주세요"></div>
                            <div class="necessaryForSignUp"><div class="necessaryForSignUpItems signUpItemTitle">비밀번호 확인</div><input type="password"  class="necessaryForSignUpItems" name="pwConfirm"></div>
                            <div class="necessaryForSignUp" style="color: #777777">
                            <input type="checkbox" name="checkBox1" />
                            (필수)<a href="../etc/policy.php" style="margin-left: 5px;color: black" onclick="window.open(this.href,\'_blank\',\'width=550px,height=700px\');return false;"> 이용 약관</a>
                            과 <a href="../etc/personalInfoPolicy.php" style="margin-left: 5px;color: black;" onclick="window.open(this.href,\'_blank\',\'width=550px,height=700px\');return false;">개인정보 수집 및 이용</a>
                            에 동의합니다.</div>
                            <div class="necessaryForSignUp" style="color: #777777"><input type="checkbox" name="checkBox2"/>(필수) 만 14세 이상입니다.</div>
                            <input type="hidden" name="idConfirm" id="idConfirm" value="notOk"/>
                            
                        </div>
                        <div class="signUpItems">
                            <input type="submit" value="회원가입"></input>
                        </div>
                        </form>
                    </div>
            </div>
                
                ';
    }
}
?>
