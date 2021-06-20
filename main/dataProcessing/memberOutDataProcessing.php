<?php
include_once '../etc/sessionStartAndLogInCheck.php';
?>

<?php
$id = $_POST['id'];
$conn = mysqli_connect("192.168.35.17", "jiwoo", "rnsrus0914*", "Member");
$result = mysqli_query($conn, "
        DELETE FROM Member WHERE (`userId` = '$id');
            ");
if ($_SESSION['userId'] != 'admin123'){
    session_start();
    session_destroy();
    $_SESSION['userId'] = '';
    setcookie('sessionId', '', time() - 3600, '/');
    echo "<script>window.location.replace(\"../index.php\")</script>";
}

echo "<script>window.location.replace(\"../admin/memberAdministrate.php\")</script>";
?>