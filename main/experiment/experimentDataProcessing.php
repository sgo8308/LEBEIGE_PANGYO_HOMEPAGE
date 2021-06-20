<?php
$image = $_POST['editordata'];

$conn= $clothesDbConnection;
$result = mysqli_query($conn, "
    INSERT INTO images
        (image,uploaded)
        VALUE(
        '$image',
        NOW()
        )
");

echo mysqli_error($conn); //에러나면 에러내용 출력하기



?>