<?php
    session_start();
    $message = "Vui long dang nhap";
    if(isset($_SESSION['LAST_ACTIVITY'])) {
        if(time() - $_SESSION['LAST_ACTIVITY'] > 30) {
            session_unset();
            session_destroy();
            header("Location: ../login.php?error=$message");
        } else {
            $_SESSION['LAST_ACTIVITY'] = time();
        }
    } else {
        header("Location: ../login.php?error=$message");
    }
?>