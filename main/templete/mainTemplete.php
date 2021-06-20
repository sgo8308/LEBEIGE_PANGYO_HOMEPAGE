<?php
abstract class Layout{
    public function drawMainLayout(){
            echo"<script>
                    function popUp(width,height){
                        window.open('','test','width='+width+',height='+height+',location=no,status=no,toolbar=no,scrollbars=no');
                        document.getElementById('chatForm').action = 'http://192.168.35.17:7777/'
                        document.getElementById('chatForm').method = 'post'
                        document.getElementById('chatForm').target = 'test'
                    }
                </script>";
            echo '<div class="container">';
                $this->drawHeader();
                echo '<div class="main">';
                    echo '<nav class="left">';
                    $this->drawLogo();
                    $this->drawMainLeftMenu();
                    echo '</nav>';
                    echo '<div class="right">';
                    $this->drawRightOfMain();
                    echo '</div>';
                echo '</div>';
                $this->drawFooter();
                if ($_SESSION['userId'] == 'admin123'){
                    echo '<form id="chatForm">';
                    echo '<input type="hidden" name="userId" value="admin123">';
                    echo '<input type="submit" class="chatButton" id="chatAdmin" value="채팅 관리" onclick="popUp(350,500)">';
                    echo '</form>';
                }else{
                    if (!empty($_SESSION['userId'])){
                        echo '<form id="chatForm">';
                        echo '<input type="hidden" name="userId" value="'.$_SESSION['userId'].'">';
                        echo '<input type="submit" class="chatButton" id="chatUser" value="채팅 문의" onclick="popUp(430,520)">';
                        echo '</form>';
                    }
                }
            echo '</div>';
    }

    public abstract function drawRightOfMain();

    public function drawHeader(){

        echo '<header>
                <div class="header_item" id="pangyo">P A N G Y O</div>
                <ol class="header_item" id="topMenu">';
                    if(!$_SESSION['userLogIn']) {
             echo  '<li ><a href = "..\main\logIn.php" > 로그인</a ></li >
                    <li ><a href = "..\main\signUp.php" > 회원가입</a ></li >';
                    }else{
             echo  '<li ><a href = "..\dataProcessing\logOutDataProcessing.php" > 로그아웃</a ></li >';
                    }
                    if ($_SESSION['userId'] == 'admin123'){
                        echo   '<li><a href="..\admin\adminPage.php">관리자 페이지</a></li>';
                    }else{
                        if (!empty($_SESSION['userId'])){
                            echo   '<li><a href="..\main\myPage.php">내 정보</a></li>';
                        }
                    }
            echo   '<li><a href="..\main\reviewList.php"> 매장 리뷰</a></li>
                    <li><a href="..\main\qna.php"> Q & A</a></li>
                </ol>
            </header>';
    }

    public function drawLogo(){
        echo '<div class="logo">
                <a href="..\index.php"><img src="..\image\logo.png" id="logo"></a>
            </div>';
    }

    public function drawMainLeftMenu(){
       echo '<ul class="leftMenu">
                <li><a href="..\leftMenu\everyClothes.php">전체 상품</a></li>
                <li><a href="..\leftMenu\outer.php">아우터</a></li>
                <li><a href="..\leftMenu\jacketVest.php">재킷/베스트</a></li>
                <li><a href="..\leftMenu\tShirts.php">티셔츠</a></li>
                <li><a href="..\leftMenu\shirtsBlouse.php">셔츠/블라우스</a></li>
                <li><a href="..\leftMenu\knit.php">니트</a></li>
                <li><a href="..\leftMenu\onePiece.php">원피스</a></li>
                <li><a href="..\leftMenu\pants.php">팬츠</a></li>
                <li><a href="..\leftMenu\skirt.php">스커트</a></li>
                <li><a href="..\leftMenu\bagWallet.php">가방/지갑</a></li>
                <li><a href="..\leftMenu\etc.php">패션잡화</a></li>
                <li><a href="..\leftMenu\shoes.php">신발</a></li>
                <li><a href="..\leftMenu\beachWear.php">비치웨어</a></li><br>
                <li><a href="..\leftMenu\newClothes.php">신상품</a></li>
                <li><a href="..\leftMenu\popularClothes.php">인기상품</a></li>
            </ul>';
    }
    public function drawFooter(){
        echo '<footer>
        <div class="companyInfo">
            <div class="company" style="display: inline-block;">
                <h5 style="margin-bottom: 18px">삼성물산 (주) 패션부문</h5>
                <span><address>경기도 성남시 분당구 백현동 판교역로146번길 20 현대백화점 2층</address></span>
                <span>대표 허옥분</span><br>
                <span>사업자 등록번호 113-05-31032 </span><br>
                <span>연락처 <tel>031-5170-1394</tel></span><br>
            </div>
            <div class="policyContainer" style="display: inline-block; float: right; margin-right: 30px">
                <a href="../etc/policy.php">이용약관</a><br>
                <a href="../etc/personalInfoPolicy.php">개인정보 처리방침 </a>
            </div>
        </div>
    </footer>';
    }
}
?>