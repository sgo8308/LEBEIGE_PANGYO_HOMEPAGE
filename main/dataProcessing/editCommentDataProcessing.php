<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
$id = $_POST['commentId'];
$detail = $_POST['commentDetail'];

global $reviewDbConnection;
$db= $reviewDbConnection;

        $update = $db->query("
                                UPDATE Comment SET 
                                `detail` = '$detail'                                
                                 WHERE (`id` = '$id');
                                ");

?>