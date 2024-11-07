<?php
    session_start();
    unset($_SESSION['loginid']);
    unset($_SESSION['logintype']);
    header("Location: ../admin/");
?>