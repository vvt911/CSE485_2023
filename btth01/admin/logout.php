<?php
    session_start();
    if(isset($_SESSION['KeyLogin'])){
        unset($_SESSION['KeyLogin']);
        // session_destroy();
        header("Location: ../index.php");
    }
?>