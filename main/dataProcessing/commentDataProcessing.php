<?php
include_once '../etc/sessionStartAndLogInCheck.php';
include_once '../etc/dbConnection.php';
?>

<?php
$reviewId = $_POST['reviewId'];
$writer = $_SESSION['userId'];
$detail = $_POST['commentDetail'];

global $reviewDbConnection;
$db= $reviewDbConnection;
$status = $statusMsg = '';


// Insert image content into database
$insert = $db->query("
                    INSERT into Comment 
                    (writer,detail,date,reviewId) 
                    VALUES 
                    ('$writer','$detail',NOW(),'$reviewId')
                    ");

$select = $db->query("
                    SELECT * FROM Comment ORDER BY id DESC LIMIT 1;
                    ");

$select2 = $db->query("
                    SELECT * FROM Comment WHERE (reviewId = '$reviewId');
                    ");
    $row = mysqli_fetch_array($select);
    $data['date'] = $row['date'];
    $data['id'] = $row['id'];
    $data['detail'] = $row['detail'];
    $data['commentNum'] = mysqli_num_rows($select2);
    echo json_encode($data);
?>