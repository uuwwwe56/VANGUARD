<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// wajib login
if (!isset($_SESSION['login'])) {
    header("Location: /VANGUARD/views/auth/login.php");
    exit;
}

// hanya user
if ($_SESSION['role'] !== 'user') {
    header("Location: /VANGUARD/views/admin/dashboard.php");
    exit;
}
