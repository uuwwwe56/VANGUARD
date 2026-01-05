<?php
require_once __DIR__ . '/../../../models/DetailProduk.php';
$detailModel = new DetailProduk();
$detail = isset($_GET['id']) ? $detailModel->getByProduk($_GET['id']) : null;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - Vanguard</title>
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
            --dark: #020617;
            --card: rgba(15, 23, 42, .9);
            --border: rgba(148, 163, 184, .25);
            --text: #e5e7eb;
            --muted: #94a3b8;
            --accent: #38bdf8;
            --accent-soft: rgba(56, 189, 248, .35);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: navy;
            color: var(--text);
            /* display: flex;
            align-items: center;
            justify-content: center; */
            padding: 20px;
        }

        .card {
            display: block;
            margin: 0 auto;
            width: 100%;
            max-width: 620px;
            background: var(--card);
            border-radius: 20px;
            padding: 32px;
            border: 1px solid var(--border);
            box-shadow:
                0 30px 60px rgba(2, 6, 23, .65),
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

        h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 26px;
            text-align: center;
            background: linear-gradient(90deg, #e5e7eb, var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        form>div {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        input,
        textarea {
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

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
            background: rgba(2, 6, 23, .9);
        }

        button {
            margin-top: 10px;
            width: 100%;
            padding: 14px;
            border-radius: 999px;
            border: none;
            font-weight: 700;
            letter-spacing: .4px;
            cursor: pointer;
            color: #020617;
            background: linear-gradient(135deg, var(--accent), #22d3ee);
            box-shadow: 0 18px 40px rgba(56, 189, 248, .45);
            transition: .3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 28px 55px rgba(56, 189, 248, .6);
        }

        .info {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        @media (max-width: 520px) {
            .card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <a href="../../admin/produk/index.php" class="icon">
        <i class="bi bi-chevron-double-left"></i> Back
    </a>
    <div class="card">
        <h2>Detail Produk</h2>

        <form method="POST" action="../../../controllers/detail_produk.php">

            <input type="hidden" name="action" value="<?= $detail ? 'update' : 'create' ?>">
            <input type="hidden" name="id_produk" value="<?= $_GET['id'] ?>">

            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi" required><?= $detail['deskripsi'] ?? '' ?></textarea>
            </div>

            <div>
                <label>Bahan</label>
                <input type="text" name="bahan"
                    value="<?= $detail['bahan'] ?? '' ?>" required>
            </div>

            <div>
                <label>Ukuran</label>
                <input type="text" name="ukuran"
                    value="<?= $detail['ukuran'] ?? '' ?>" required>
            </div>

            <button type="submit">
                <?= $detail ? 'Update Detail' : 'Simpan Detail' ?>
            </button>

        </form>

        <div class="info">
            Data detail produk akan tampil di halaman user
        </div>
    </div>

</body>

</html>