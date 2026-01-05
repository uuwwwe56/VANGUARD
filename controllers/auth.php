<?php
session_start();

require_once __DIR__ . '/../models/User.php';

$userModel = new User();

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] === 'register') {

    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($nama === '' || $email === '' || $password === '') {
        $_SESSION['error'] = 'Semua field wajib diisi';
        header("Location: ../views/auth/register.php");
        exit;
    }

    $result = $userModel->register([
        'nama'     => $nama,
        'email'    => $email,
        'password' => $password,
        'role'     => 'user'
    ]);

    if ($result) {
        $_SESSION['success'] = 'Registrasi berhasil, silakan login';
        header("Location: ../views/auth/login.php");
        exit;
    } else {
        $_SESSION['error'] = 'Email sudah terdaftar';
        header("Location: ../views/auth/register.php");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] === 'login') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        $_SESSION['error'] = 'Email dan password wajib diisi';
        header("Location: ../views/auth/login.php");
        exit;
    }

    $user = $userModel->login($email, $password);

    if ($user) {
        $_SESSION['login']   = true;
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role'];

        $_SESSION['alert'] = 'Login berhasil, selamat datang ' . $user['nama'];

        if ($user['role'] === 'admin') {
            header("Location: ../views/admin/dashboard.php");
        } else {
            header("Location: ../views/user/dashboard.php");
        }
        exit;
    } else {
        // ❌ INI YANG KURANG
        $_SESSION['error'] = 'Email atau password salah atau belum terdaftar';
        header("Location: ../views/auth/login.php");
        exit;
    }
}
