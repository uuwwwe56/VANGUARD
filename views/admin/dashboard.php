<?php
require_once '../../middleware/admin.php';
require_once '../../core/Database.php';

$db = (new Database())->conn;

// hitung data
$total_produk    = $db->query("SELECT COUNT(*) total FROM produk")->fetch_assoc()['total'];
$total_user      = $db->query("SELECT COUNT(*) total FROM users WHERE role='user'")->fetch_assoc()['total'];
$total_kategori  = $db->query("SELECT COUNT(*) total FROM kategori")->fetch_assoc()['total'];
$total_transaksi = $db->query("SELECT COUNT(*) total FROM transaksi")->fetch_assoc()['total'];

// transaksi pending
$pending = $db->query(
    "SELECT COUNT(*) total FROM transaksi WHERE status='pending'"
)->fetch_assoc()['total'];

// testimoni
$total_testimoni      = $db->query("SELECT COUNT(*) total FROM testimoni")->fetch_assoc()['total'];
$pending_testimoni    = $db->query("SELECT COUNT(*) total FROM testimoni WHERE status='pending'")->fetch_assoc()['total'];
$approved_testimoni   = $db->query("SELECT COUNT(*) total FROM testimoni WHERE status='approved'")->fetch_assoc()['total'];

?>
<?php if (isset($_SESSION['alert'])): ?>
    <script>
        alert("<?= $_SESSION['alert']; ?>");
    </script>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>


<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/png" href="../../assets/img/Home/L_Vg.png">
    <style>
        :root {
            --navy: #0f172a;
            --navy-soft: #1e293b;
            --navy-light: #334155;
            --accent: #38bdf8;
            --bg: #f1f5f9;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: navy;
            margin: 0;
            color: var(--text);
        }

        .container {
            width: 90%;
            margin: auto;
            padding-bottom: 40px;
        }

        h1 {
            color: #fff;
            margin-top: 0;
            padding-top: 30px;
            letter-spacing: .5px;
        }

        p {
            color: #cbd5f5;
        }

        /* MENU */
        .menu {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 10px 12px 0 0;
            padding: 10px 16px;
            background: var(--navy-soft);
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 999px;
            font-size: 14px;
            transition: all .25s ease;
        }

        .menu:hover {
            background: var(--accent);
            color: #020617;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, .35);
        }

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: var(--card);
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .08);
            position: relative;
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(56, 189, 248, .08));
            opacity: 0;
            transition: .3s;
            pointer-events: none;
            /* 🔥 INI FIX NYA */
        }


        .card:hover::before {
            opacity: 1;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .15);
        }

        .card h2 {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
            color: var(--navy);
        }

        .card p {
            margin-top: 6px;
            color: var(--muted);
            font-size: 14px;
        }

        /* KHUSUS CARD STATUS (override inline background biar tetap nyatu) */
        .card[style] {
            background: linear-gradient(135deg, #e0f2fe, #f8fafc) !important;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            font-size: 13px;
            color: var(--accent);
            font-weight: 600;
        }

        .card a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            h1 {
                font-size: 22px;
            }
        }
    </style>

</head>

<body>

    <div class="container">
        <h1>Dashboard Admin Vanguard</h1>
        <p>Selamat datang, <b><?= $_SESSION['nama'] ?></b></p>

        <!-- MENU -->
        <div>
            <a class="menu" href="produk/index.php">📦 Produk</a>
            <a class="menu" href="kategori/index.php">🗂 Kategori</a>
            <a class="menu" href="transaksi/index.php">💳 Transaksi</a>

            <a href="../../controllers/logout.php"
                onclick="return confirm('Yakin ingin logout?')"
                class="btn btn-danger btn-sm menu">
                Logout
            </a>

        </div>

        <!-- RINGKASAN -->
        <div class="cards">
            <div class="card">
                <h2><?= $total_produk ?></h2>
                <p>Total Produk</p>
            </div>

            <div class="card">
                <h2><?= $total_kategori ?></h2>
                <p>Kategori</p>
            </div>

            <div class="card">
                <h2><?= $total_user ?></h2>
                <p>User</p>
            </div>

            <div class="card">
                <h2><?= $total_transaksi ?></h2>
                <p>Transaksi</p>
            </div>

            <div class="card" style="background: #ffe8a1;">
                <h2><?= $pending ?></h2>
                <p>Pending Transaksi</p>
            </div>

            <!-- Testimoni -->
            <div class="card" style="background: #d1f7c4;">
                <h2><?= $total_testimoni ?></h2>
                <p>Total Testimoni</p>
            </div>

            <div class="card" style="background: #fff3cd;">
                <h2><?= $pending_testimoni ?></h2>
                <p>Pending Testimoni</p>
                <a href="testimoni/index.php" style="color:#856404; font-weight:bold;">Lihat & Approve</a>
            </div>


            <div class="card" style="background: #cce5ff;">
                <h2><?= $approved_testimoni ?></h2>
                <p>Approved Testimoni</p>
            </div>
        </div>

    </div>


</body>
<script>
    // Cegah tombol back browser
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        // Paksa logout jika tekan back
        window.location.href = "../../controllers/logout.php";
    };
</script>


</html>