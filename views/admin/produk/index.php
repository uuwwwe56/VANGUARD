<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Produk.php';

$model = new Produk();
$data  = $model->allWithKategori();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../assets/css/dasboard.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --navy-dark: #020617;
            --navy: #0f172a;
            --navy-soft: #1e293b;
            --accent: #22d3ee;
            --accent-glow: rgba(34, 211, 238, .45);
            --text: #e5e7eb;
            --muted: #94a3b8;
            --border: rgba(148, 163, 184, .25);
            --glass: rgba(15, 23, 42, .65);
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            background: navy;
            color: #e5e7eb;
            padding: 40px 20px;
        }


        h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 22px;
            letter-spacing: .5px;
            background: linear-gradient(90deg, #e5e7eb, var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        form {
            max-width: 560px;
            background: var(--glass);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 32px;
            border: 1px solid var(--border);
            box-shadow:
                0 30px 60px rgba(2, 6, 23, .6),
                inset 0 1px 0 rgba(255, 255, 255, .04);
            animation: fadeUp .6s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form>div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .4px;
            color: var(--muted);
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        input,
        select {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            background: rgba(2, 6, 23, .6);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: all .25s ease;
        }

        input::placeholder {
            color: #64748b;
        }

        input:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow:
                0 0 0 3px var(--accent-glow),
                inset 0 0 0 1px var(--accent);
            background: rgba(2, 6, 23, .85);
        }

        input[type="file"] {
            padding: 12px;
            cursor: pointer;
            color: var(--muted);
        }

        input[type="file"]::-webkit-file-upload-button {
            background: linear-gradient(135deg, var(--navy-soft), var(--navy));
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
            background: linear-gradient(135deg, var(--accent), #38bdf8);
            color: #020617;
        }

        button {
            margin-top: 10px;
            padding: 14px 26px;
            border-radius: 999px;
            border: none;
            font-weight: 700;
            letter-spacing: .4px;
            cursor: pointer;
            color: #020617;
            background: linear-gradient(135deg, var(--accent), #38bdf8);
            box-shadow:
                0 0 0 0 var(--accent-glow),
                0 18px 40px rgba(34, 211, 238, .45);
            transition: all .3s ease;
        }

        button:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow:
                0 0 0 8px rgba(34, 211, 238, .15),
                0 28px 60px rgba(34, 211, 238, .6);
        }

        a {
            margin-left: 16px;
            font-size: 14px;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            transition: .25s;
        }

        .img-top {
            width: 60px;
            height: 60px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        a:hover {
            color: var(--accent);

        }

        .add {
            margin-bottom: 10px;
        }

        table {
            background: var(--glass);
            backdrop-filter: blur(14px);
            border-radius: 14px;
            /* overflow: hidden; */
        }

        th {
            background: rgba(2, 6, 23, .85);
            color: var(--muted);
            font-size: 13px;
            text-transform: uppercase;
        }

        tr:hover td {
            background: rgba(34, 211, 238, .05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            /* ⬅️ INI KUNCINYA */
            vertical-align: middle;
            /* ⬅️ BIAR TENGAH KE ATAS-BAWAH */
        }



        @media (max-width: 600px) {
            form {
                padding: 24px;
            }
        }
    </style>

</head>

<body>
    <a href="../dashboard.php" class="icon">
        <i class="bi bi-chevron-double-left"></i> Back
    </a>
    <h3 style="margin-top: 20px; margin-bottom: 10px; " class="text-center">Data Produk</h3>
    <a href="create.php">+ Tambah Produk</a>

    <table border="1" cellpadding="8" style="margin-top: 10px;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data as $i => $row): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['nama_kategori'] ?? '-' ?></td>
                <td><?= number_format($row['harga']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <?php if ($row['gambar']): ?>
                        <img src="../../../assets/img/produk/<?= $row['gambar'] ?>" class="img-top" width="60">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $row['id_produk'] ?>">Edit</a>
                    <a href="../../../controllers/produk.php?delete=<?= $row['id_produk'] ?>"
                        onclick="return confirm('Hapus produk?')">Hapus</a>
                    <a href="detail_form.php?id=<?= $row['id_produk'] ?>"
                        class="btn btn-info btn-sm">
                        Detail Produk
                    </a>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>