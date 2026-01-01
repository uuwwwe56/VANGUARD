<?php
session_start();
require_once __DIR__ . '/../models/Transaksi.php';
require_once __DIR__ . '/../models/Produk.php';

$model = new Transaksi();

/* ================= USER CHECKOUT ================= */
if (isset($_POST['checkout']) && $_SESSION['role'] === 'user') {

    $produkModel = new Produk();
    $produk = $produkModel->find($_POST['id_produk'], 'id_produk');

    $total = $produk['harga'] * $_POST['qty'];

    // status awal
    $status = ($_POST['metode_pembayaran'] === 'DANA')
        ? 'menunggu_transfer'
        : 'pending';

    $id_transaksi = $model->create([
        'id_user' => $_SESSION['id_user'],
        'tanggal' => date('Y-m-d H:i:s'),
        'total'   => $total,
        'nama'    => $_POST['nama'],          // ✅ INI YANG KURANG
        'alamat'  => $_POST['alamat'],
        'no_hp'   => $_POST['no_hp'],
        'metode_pembayaran' => $_POST['metode_pembayaran'],
        'status'  => $status
    ]);


    $model->insertDetail([
        'id_transaksi' => $id_transaksi,
        'id_produk'    => $_POST['id_produk'],
        'qty'          => $_POST['qty'],
        'harga'        => $produk['harga']
    ]);

    $model->updateStok(
        $_POST['id_produk'],
        $produk['stok'] - $_POST['qty']
    );

    header("Location: ../views/user/transaksi/index.php");
    exit;
}

/* ================= UPLOAD BUKTI TRANSFER ================= */
if (isset($_POST['upload_bukti']) && $_SESSION['role'] === 'user') {

    $id_transaksi = $_POST['id_transaksi'];

    if ($_FILES['bukti_transfer']['error'] !== 0) {
        die("Upload gagal");
    }

    $namaFile = time() . '_' . $_FILES['bukti_transfer']['name'];
    $tmp      = $_FILES['bukti_transfer']['tmp_name'];

    $folder = __DIR__ . '/../assets/img/bukti/';
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    move_uploaded_file($tmp, $folder . $namaFile);

    $model->updateStatusDanBukti(
        $id_transaksi,
        'menunggu_verifikasi',
        $namaFile
    );

    header("Location: ../views/user/transaksi/index.php");
    exit;
}


/* ================= ADMIN VERIFIKASI ================= */
if (isset($_GET['verifikasi']) && $_SESSION['role'] === 'admin') {

    $model->updateStatus($_GET['verifikasi'], $_GET['status']);

    header("Location: ../views/admin/transaksi/index.php");
    exit;
}

/* ================= CHECKOUT DARI KERANJANG ================= */
if (isset($_POST['checkout_cart']) && $_SESSION['role'] === 'user') {

    require_once __DIR__ . '/../models/Keranjang.php';

    $keranjang = new Keranjang();
    $items = $keranjang->getByUser($_SESSION['id_user']);

    $total = 0;
    foreach ($items as $i) {
        $total += $i['harga'] * $i['qty'];
    }

    $id_transaksi = $model->create([
        'id_user' => $_SESSION['id_user'],
        'tanggal' => date('Y-m-d H:i:s'),
        'total'   => $total,
        'nama'    => $_POST['nama'],
        'alamat'  => $_POST['alamat'],
        'no_hp'   => $_POST['no_hp'],
        'metode_pembayaran' => $_POST['metode_pembayaran'],
        'status'  => 'pending'
    ]);

    foreach ($items as $i) {
        $model->insertDetail([
            'id_transaksi' => $id_transaksi,
            'id_produk'    => $i['id_produk'],
            'qty'          => $i['qty'],
            'harga'        => $i['harga']
        ]);

        $model->updateStok(
            $i['id_produk'],
            $i['stok'] - $i['qty']
        );
    }

    $keranjang->clearByUser($_SESSION['id_user']);

    header("Location: ../views/user/transaksi/index.php");
    exit;
}

if (isset($_POST['checkout_cart'])) {

    $id_user = $_SESSION['id_user'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $metode = $_POST['metode_pembayaran'];

    $produk_ids = $_POST['produk_id'];
    $qtys = $_POST['qty'];
    $ukuran = $_POST['ukuran'];

    $total = 0;

    // hitung total
    foreach ($produk_ids as $i => $id_produk) {
        $subtotal = $qtys[$i] * getHargaProduk($id_produk); // fungsi getHargaProduk ambil harga
        $total += $subtotal;
    }

    // insert ke tabel transaksi
    $db->query("
        INSERT INTO transaksi (id_user, total, nama, alamat, no_hp, metode_pembayaran, status, tanggal)
        VALUES ('$id_user', '$total', '$nama', '$alamat', '$no_hp', '$metode', 'pending', NOW())
    ");
    $id_transaksi = $db->insert_id;

    // insert ke detail_transaksi
    foreach ($produk_ids as $i => $id_produk) {
        $db->query("
            INSERT INTO detail_transaksi (id_transaksi, id_produk, qty, ukuran)
            VALUES ('$id_transaksi', '{$produk_ids[$i]}', '{$qtys[$i]}', '{$ukuran[$i]}')
        ");
        // hapus dari keranjang
        $db->query("DELETE FROM keranjang WHERE id_user='$id_user' AND id_produk='{$produk_ids[$i]}'");
    }

    $_SESSION['success'] = "Checkout berhasil!";
    header("Location: ../views/user/transaksi/index.php");
    exit;


    // ambil item keranjang user
    $keranjang = $db->query("
    SELECT k.id_produk, k.qty, p.harga
    FROM keranjang k
    JOIN produk p ON k.id_produk = p.id_produk
    WHERE k.id_user = $id_user
");

    while ($k = $keranjang->fetch_assoc()) {

        $stmt = $db->prepare("
        INSERT INTO detail_transaksi
        (id_transaksi, id_produk, qty, harga)
        VALUES (?, ?, ?, ?)
    ");
        $stmt->bind_param(
            "iiii",
            $id_transaksi,
            $k['id_produk'],
            $k['qty'],
            $k['harga']
        );
        $stmt->execute();
    }
}

// Fungsi helper
function getHargaProduk($id)
{
    global $db;
    $res = $db->query("SELECT harga FROM produk WHERE id_produk='$id'");
    return $res->fetch_assoc()['harga'];
}
