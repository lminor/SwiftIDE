<?php
    session_start();

    /* CLEAR USER SESSION */
    unset($_SESSION['member']);
    session_regenerate_id(true);

    header ('location: index.php');
    exit;
?>