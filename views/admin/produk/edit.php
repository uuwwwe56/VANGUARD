<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Produk.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$model  = new Produk();
$produk = $model->find($_GET['id'], 'id_produk');

if (!$produk) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit - Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/dasboard.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #020617;
            --card: rgba(15, 23, 42, .9);
            --border: rgba(148, 163, 184, .25);
            --text: #e5e7eb;
            --muted: #94a3b8;
            --accent: #38bdf8;
        }

        /* RESET */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Inter, Segoe UI, Arial, sans-serif;
            background: navy;
            color: var(--text);
        }

        /* CENTER PAGE */
        .page-center {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 14px;
            padding: 20px;
        }

        /* TITLE */
        h3 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: .4px;
            text-align: center;
        }

        /* FORM CARD */
        form {
            width: 100%;
            max-width: 580px;
            background: var(--card);
            border-radius: 18px;
            padding: 32px;
            border: 1px solid var(--border);
            box-shadow:
                0 30px 60px rgba(2, 6, 23, .6),
                inset 0 1px 0 rgba(255, 255, 255, .04);
            animation: fadeUp .5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form>div {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
            letter-spacing: .4px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            background: rgba(2, 6, 23, .75);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: .25s;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, .25);
            background: rgba(2, 6, 23, .9);
        }

        small {
            display: inline-block;
            margin-top: 6px;
            font-size: 12px;
            color: #64748b;
        }

        /* IMAGE */
        .preview-img {
            display: block;
            margin: 10px auto 0;
            width: 90px;
            height: 90px;
            object-fit: contain;
            background: #020617;
            border-radius: 10px;
            border: 1px solid var(--border);
            padding: 6px;
        }

        /* FILE INPUT */
        input[type="file"] {
            padding: 12px;
            cursor: pointer;
            color: var(--muted);
        }

        input[type="file"]::-webkit-file-upload-button {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: none;
            border-radius: 999px;
            padding: 8px 14px;
            color: #fff;
            font-weight: 600;
            margin-right: 12px;
            cursor: pointer;
            transition: .25s;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background: linear-gradient(135deg, var(--accent), #22d3ee);
            color: #020617;
        }

        /* ACTIONS */
        .form-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            margin-top: 10px;
        }

        button {
            padding: 14px 26px;
            border-radius: 999px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            color: #020617;
            background: linear-gradient(135deg, var(--accent), #22d3ee);
            box-shadow: 0 16px 35px rgba(56, 189, 248, .45);
            transition: .3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 50px rgba(56, 189, 248, .6);
        }

        a {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
        }

        a:hover {
            color: var(--accent);
            /* text-decoration: underline; */
        }

        .icon {
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            margin-left: 20px;
            color: aliceblue;

        }
    </style>
</head>

<body>
    <br>
    <a href="../produk/index.php" class="icon">
        <i class="bi bi-chevron-double-left"></i> Back
    </a>
    <div class="page-center">
        <h3>Edit Produk</h3>

        <form action="../../../controllers/produk.php"
            method="POST"
            enctype="multipart/form-data">

            <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

            <div>
                <label>Nama Produk</label>
                <input type="text" name="nama_produk"
                    value="<?= $produk['nama_produk'] ?>" required>
            </div>

            <div>
                <label>Kategori</label>
                <input type="number" name="id_kategori"
                    value="<?= $produk['id_kategori'] ?>" required>
                <small>(sementara pakai ID kategori)</small>
            </div>

            <div>
                <label>Harga</label>
                <input type="number" name="harga"
                    value="<?= $produk['harga'] ?>" required>
            </div>

            <div>
                <label>Stok</label>
                <input type="number" name="stok"
                    value="<?= $produk['stok'] ?>" required>
            </div>

            <div>
                <label>Gambar Lama</label>
                <?php if ($produk['gambar']): ?>
                    <img src="../../../assets/img/produk/<?= $produk['gambar'] ?>"
                        class="preview-img">
                <?php else: ?>
                    <small>Tidak ada gambar</small>
                <?php endif; ?>
            </div>

            <div>
                <label>Ganti Gambar (opsional)</label>
                <input type="file" name="gambar">
            </div>

            <div class="form-actions">
                <button type="submit" name="update">Update</button>
                <a href="index.php">Kembali</a>
            </div>

        </form>
    </div>

</body>

</html>