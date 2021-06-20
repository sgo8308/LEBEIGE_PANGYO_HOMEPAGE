<?php
class LogInLayout{
    public function drawLogInLayout(){
        echo '
                <h3 style="font-size: 32px; margin-top: 130px;">로그인</h3>
                
                <div class="logInBigContainer">
                        <form action="..\dataProcessing\logInDataProcessing.php" method="post">                      
                            <div class="logInContainer">
                                <div class="logInItems">
                                    <input type="text" name="userId" placeholder="아이디"><br>
                                    <input type="password" name="pw" placeholder="비밀번호">
                                </div>
                                <div class="logInItems">
                                    <input type="submit" value="로그인하기"></input>
                                </div>
                            </div>
                            <input type="checkbox" name="keepLogIn"> 로그인 상태 유지
                        </form>';
//                    <div class="cantLogIn">
//                        <a href="../main/findId.php">아이디 찾기</a>
//                        <a href="../main/findPassWord.php">비밀번호 찾기</a>
//                        <a href="..\main\signUp.php">회원가입</a>
//                    </div>
  echo '      </div>
                
                ';
    }
}

?>
