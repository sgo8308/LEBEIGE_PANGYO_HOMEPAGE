<?php
abstract class ListLayout{


    public abstract function accessClothesTable();

    public function drawListLayout(){
        echo '<script src="../admin/deleteClothes.js"></script>';

        $clothesTableResult = $this->accessClothesTable();

        echo '<div class="everyClothesContainer1" >
                <div class="location"></div>
                <h3 id="navTitle"></h3>
                <div class="everyClothesContainer2" >';
                while($row = mysqli_fetch_array($clothesTableResult)){
                echo'    <div class="clothes">                        
                            <div class="clothesItem">';
                if ($_SESSION['userId'] == "admin123"){
                    echo'           <div class="clothesItemEditDel" style="display: flex;flex-direction: row; margin-bottom: 5px">
                                        <form action="../admin/editClothes.php" method="post" style="display: flex;">
                                            <input type="hidden" value="'.$row['id'].'" name="clothesId">
                                            <input type="submit" value="상품 정보 수정">
                                        </form>
                                        <input type="submit" value="상품 삭제" onclick="deleteClothes('.$row['id'].');">
                                        <h3 style="font-size: 14px;margin-left: 30px;margin-top: 5px">조회수 '.$row['view'].'</h3>
                                    </div>';
                }
                echo' 
                                <a href="..\clothes\clothes.php?clothesid='.$row['id'].'">
                                    <div id="mainImageContainer">
                                        <img class="clothesItemChilds" id="mainImage" src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['mainImage']).'" />
                                    </div>
                                    <div class="clothesItemChilds" style="font-size: 16px">'.$row['name'].'</div>
                                    <div class="clothesItemChilds" style="font-style: normal;line-height: 28px;color: #5b1eaa;font-size: 16px;">'.number_format($row['price']).'원</div>
                                </a>
                            </div>
                    </div>';
                }
    echo'            </div>
            </div>';
    }
}
?>


