<?php
session_start();
require_once __DIR__ . '/../models/DetailProduk.php';

$model = new DetailProduk();

if ($_POST['action'] === 'create') {
    $model->create($_POST);
}

if ($_POST['action'] === 'update') {
    $model->update($_POST['id_produk'], $_POST);
}

if (isset($_GET['delete'])) {
    $model->delete($_GET['delete']);
}

header("Location: ../views/admin/produk/index.php");
exit;
