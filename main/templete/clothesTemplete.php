<?php
    class ClothesLayout{
        public function accessClothesTable(){
            $clothesId = $_GET['clothesid'];
            $conn= $clothesDbConnection;
            $query = "SELECT * FROM Clothes WHERE (id = $clothesId)";
            $result = mysqli_query($conn, $query);
            return $result;
        }

        public function drawClothesLayout(){
            $result = $this->accessClothesTable();
            $row = mysqli_fetch_array($result);

            if (!empty($_COOKIE[ "clothesList" ])){
                $cookie = json_decode( $_COOKIE[ "clothesList" ] );
                $expiry = $cookie->expiry;
                $data = $cookie->data;
                $clothesList = $data->clothesList;

                if (strpos($clothesList,$row['id'].$row['name']) === false){
                    $cookie = json_decode( $_COOKIE[ "clothesList" ] );
                    $expiry = $cookie->expiry;
                    $data = $cookie->data;
                    $clothesList = $cookie->data->clothesList;
                    $newClothesList = $clothesList.";".$row['id'].$row['name'];
                    $data = (object) array( "clothesList" => $newClothesList);
                    $cookieData = (object) array( "data" => $data, "expiry" => $expiry );
                    setcookie( "clothesList", json_encode( $cookieData ), $expiry,"/");

                    if (empty($row['view'])){
                        $newView =  1;
                    }else{
                        $newView = $row['view'] + 1;
                    }
                    $id = $row['id'];
                    $conn= $clothesDbConnection;
                    $result = mysqli_query($conn, "
                              UPDATE Clothes SET `view` = '$newView' WHERE (`id` = '$id');
                         ");
                    echo mysqli_error($conn); //에러나면 에러내용 출력하기
                }
            }else{
                $expiry = time() + 10; // 발표 후 하루 단위로 수정할 것 3600*24
                $data = (object) array( "clothesList" => $row['id'].$row['name']);
                $cookieData = (object) array( "data" => $data, "expiry" => $expiry );
                setcookie( "clothesList", json_encode( $cookieData ), $expiry,"/" );
                if (empty($row['view'])){
                    $newView =  1;
                }else{
                    $newView = $row['view'] + 1;
                }
                $id = $row['id'];
                $conn= $clothesDbConnection;
                $result = mysqli_query($conn, "
                              UPDATE Clothes SET `view` = '$newView' WHERE (`id` = '$id');
                         ");
            }

            echo '<div class="clothesBigContainer">
                <div class="location"></div>
                <div class="clothesTopContainer">
                
                    <div class="clothesTopItems" id="clothesMainImageContainer">
                          <img class="clothesItemChilds" id="clothesMainImage" src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['mainImage']).'" />
                    </div>
                    
                    <div class="clothesTopItems">
                            <h2 style="font-size: 24px; font-weight: bold; margin-top: 20px">'.$row['name'].'</h2><br>
                            <em id="price" style="font-size: 24px;">'.number_format($row['price']).'원</em><br>
                   
                    </div>
                    
                </div>
              
                <div class="clothesBottomContainer">
                    <h3 style="font-size: 30px; margin-top: 50px; font-weight: bold">상품 정보</h3>
                    <div class="conbox info" id="test" style="margin-top: 50px">'.$row['detail'].'</div>
                   
                </div>          
                </div>
                ';
        }
    }
?>
