<?php
    session_start();
    session_destroy();
    $_SESSION['userId'] = '';
    setcookie('sessionId', '', time() - 3600, '/');

echo "<script>
        location.href='../main/logIn.php'
        </script>";
?>