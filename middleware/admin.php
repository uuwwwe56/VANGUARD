<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: /VANGUARD/views/auth/login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: /VANGUARD/views/user/dashboard.php");
    exit;
}
