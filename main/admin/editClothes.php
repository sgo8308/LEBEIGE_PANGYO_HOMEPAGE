<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
if ($_SESSION['userId'] !== "admin123"){
    echo '<script>
                alert("옳바르지 않은 접근입니다.");
                history.back()
                </script>';
}
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>LEBEIGE PANGYO</title>
    <link rel="stylesheet" href="..\css\forAll.css?16">
    <link rel="stylesheet" href="..\css\mainTemplete.css?1010010">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="..\summernote\summernote-lite.css">
    <script src="..\summernote\summernote-lite.js"></script>
    <script src="..\summernote\lang\summernote-ko-KR.js"></script>
</head>
<style>
    .addClothesBigContainer{
        width: 960px;
        height: 1400px;
        margin-top: 20px;
        border: 1px solid #d9dadc;
        font-size: 12px;
        display: flex;

    }
    .addClothesContainerLeft{
        width: 15%;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #d9dadc;
        background: #f5f3f4;
    }
    .addClothesContainerRight{
        width: 85%;
        display: flex;
        flex-direction: column;
    }
    .addClothesLeftBody{
        box-sizing: border-box;
        flex-basis: 56px;
        border-bottom: 1px solid #d9dadc;
        padding: 20px;
    }
    #addClothesLeftMainImage{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 160px;
    }
    #addClothesLeftDetail{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 370px;
        border-bottom: none;
    }
    .addClothesRightBody{
        padding-top: 18px;
        padding-left: 10px;
        box-sizing: border-box;
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 56px;
        border-bottom: 1px solid #d9dadc;
    }
    #addClothesRightMainImage{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 160px;
    }
    #addClothesRightDetail{
        flex-grow: 0;
        flex-shrink: 0;
        flex-basis: 370px;
        border-bottom: none;

    }
    input[type="text"]{
        margin: 0;
        width: 95%;
    }
    img{
        max-width: 100%;
        height: auto;
    }
    #delink{
        display: none;
    }
    input[type="submit"]{
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
    #chatAdmin{
        font-size: 12px;
        position: fixed;
        bottom: 18px;
        right: 0px;
        width: 70px;
        height: 40px;

        background-color: #353b4c;
        letter-spacing: -1px;
        color: #ffffff;
        font-weight: normal;
    }
</style>
<body>
<?php
include_once '../templete/mainTemplete.php';
global $clothesDbConnection;

class main extends Layout{

    public function accessQusetionTable(){
        $clothesId = $_POST['clothesId'];
        global $clothesDbConnection;
        $conn = $clothesDbConnection;
        $query = "SELECT * FROM Clothes WHERE (id = $clothesId)";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function drawRightOfMain(){
        $result = $this->accessQusetionTable();
        $row = mysqli_fetch_array($result);

        echo '<script> 
                var img;
                function setThumbnail(event) {
                    var reader = new FileReader(); 
                    reader.onload = function(event) {
                        var img = document.createElement("img");
                        img.setAttribute("src", event.target.result);
                        img.setAttribute("id", "thumbnail");
                        document.querySelector("#image_container").appendChild(img); 
                    };
                    reader.readAsDataURL(event.target.files[0]); 
                } 
                </script>
                
                 ';
        echo '<script> 
                function deleteThumbnail() { 
                    if (document.getElementById("thumbnail")){
                        document.querySelector("#image_container").removeChild(document.getElementById("thumbnail"));                     
                    }
                } 
                </script>';
        echo '       
                <h3 style="font-size: 32px;margin-top: 130px; ">상품 수정</h3>
                <form action="../dataProcessing/editClothesDataProcessing.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="clothesId" value="'.$row['id'].'"/>
                    <div class="addClothesBigContainer">
                        <div class="addClothesContainerLeft">
                            <div class="addClothesLeftBody">상품명</div>
                            <div class="addClothesLeftBody">가격</div>
                            <div class="addClothesLeftBody">카테고리</div>
                            <div class="addClothesLeftBody" id="addClothesLeftMainImage">대표 이미지</div>
                            <div class="addClothesLeftBody" id="addClothesLeftDetail">상품 설명</div>
                        </div>
                        <div class="addClothesContainerRight">
                            <div class="addClothesRightBody" style="vertical-align: center">
                                <input type="text" name="addClothesClothesName" id="addClothesClothesName">                                
                            </div>
                            <div class="addClothesRightBody">
                                <input type="number" name="addClothesClothesPrice" ></input>  원
                            </div>
                            <div class="addClothesRightBody">
                                <select name="addClothesClothesCategory1" style="width: 100px; display: inline;">
                                    <option value="아우터">아우터</option>
                                    <option value="재킷/베스트">재킷/베스트</option>
                                    <option value="티셔츠">티셔츠</option>
                                    <option value="셔츠/블라우스">셔츠/블라우스</option>
                                    <option value="니트">니트</option>
                                    <option value="원피스">원피스</option>
                                    <option value="팬츠">팬츠</option>
                                    <option value="스커트">스커트</option>dom child 교체하기
                                    <option value="가방/지갑">가방/지갑</option>
                                    <option value="패션잡화">패션잡화</option>
                                    <option value="신발">신발</option>
                                    <option value="비치웨어">비치웨어</option>
                                </select>
                                <select name="addClothesClothesCategory2" style="width: 100px; display: inline; margin-left: 10px">
                                    <option value="신상품">신상품</option>
                                    <option value="선택안함">선택안함</option>                  
                                </select>
                                <select name="addClothesClothesCategory3" style="width: 100px; display: inline; margin-left: 10px">
                                    <option value="인기상품">인기상품</option>                  
                                    <option value="선택안함">선택안함</option>                  
                                </select>
    
                            </div>
                            <div class="addClothesRightBody" id="addClothesRightMainImage">
                                <div id="image_container" style="width: 101px; height: 134px;border: 1px solid black; display: inline-block; float: left"></div>
                                     <div style="margin-left: 100px; padding-left: 10px"> - 권장이미지 300px * 400px</div>
                                <input type="file" name="addClothesImage" id="image" accept="image/*" onclick="deleteThumbnail()" onchange="setThumbnail(event);" style="margin-left: 10px; margin-top: 100px"/>
                                <span style="font-size: 12px">* 파일을 선택하지 않으면 기존 대표 이미지가 적용됩니다.</span>
                            </div>
                            <textarea id="summernote" name="editordata">'.$row['detail'].'</textarea>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="수정 완료" style="margin-left:400px;margin-top: 10px;cursor: pointer"/>
                </form>
            ';
        echo '<script>
                $(document).ready(function() {
                    //여기 아래 부분
                    $(\'#summernote\').summernote({
                        height: 1010,                 // 에디터 높이
                        minHeight: null,             // 최소 높이
                        maxHeight: null,             // 최대 높이
                        lang: "ko-KR",					// 한글 설정
                        placeholder: \'\',	//placeholder 설정
                        fontNames: ["Arial", "Arial Black", "Comic Sans MS", "Courier New","맑은 고딕","궁서","굴림체","굴림","돋음체","바탕체"],
                        fontSizes: ["8","9","10","11","12","14","16","18","20","22","24","28","30","36","50","72"]
                    });
                });
            </script>';
        $test = $row['detail'];
        echo '<script>
                document.getElementsByName("addClothesClothesName")[0].value = "'.$row['name'].'";
                document.getElementsByName("addClothesClothesPrice")[0].value = "'.$row['price'].'";
                document.getElementsByName("addClothesClothesCategory1")[0].value = "'.$row['category1'].'";
                document.getElementsByName("addClothesClothesCategory2")[0].value = "'.$row['category2'].'";
                document.getElementsByName("addClothesClothesCategory3")[0].value = "'.$row['category3'].'";
                document.getElementById("image_container").text = 123;
                document.getElementsByName("addClothesImage")[0]
              </script>';
    }
}

$main = new main();
$main->drawMainLayout();
?>
</body>
</html>

