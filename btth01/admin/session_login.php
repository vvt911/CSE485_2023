<?php
    session_start();
    if(!isset($_SESSION['KeyLogin'])) {
        header("Location: ../login.php");
    }
?>