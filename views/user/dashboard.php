<?php
require_once '../../middleware/auth.php';
?>

<?php if (isset($_SESSION['alert'])): ?>
    <script>
        alert("<?= $_SESSION['alert']; ?>");
    </script>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Vanguard</title>
    <link rel="icon" type="image/png" href="../../assets/img/Home/L_Vg.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/dasboard.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg nav-custom sticky-top ">
        <div class="container-fluid">

            <h4 class="user">Halo, <?= $_SESSION['nama']; ?></h4>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ">
                    <li class="nav-item px-1">
                        <a class="nav-link " href="#home">Home</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#promo">Promo</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="produk/index.php">Produk</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="transaksi/index.php">Transaksi</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>

            <a href="../../controllers/logout.php"
                onclick="return confirm('Yakin ingin logout?')"
                class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>
    </nav>

    <!-- SLIDER HOME       -->
    <div class="slider" id="home">
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <figure></figure>
        <div class="content">
            <h1 data-aos="fade-up">Vanguard</h1>
            <p data-aos="fade-up">
                Simplicity meets style. Pilihan pakaian premium untuk look yang soft,
                rapi, dan aesthetic
            </p>
        </div>
    </div>

    <!-- ABOUT  -->
    <div class="container py-5" id="about">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <p
                    class=" mb-4 fs-4 "
                    style="font-size: 1.05rem; line-height: 1.7"
                    data-aos="fade-up">
                    Vanguard adalah brand streetwear yang menggabungkan simplicity,
                    comfort, dan karakter. Kita bikin outfit yang gampang dipake kemana
                    aja — nongkrong, kuliah, kerja, atau sekedar jalan malam di kota.
                    Clean, effortless, tapi tetap standout.
                </p>

                <!-- 3 Feature Mini Box -->
                <div class="row mt-3">
                    <div class="col-md-4" data-aos="fade-left">
                        <div class="p-3 rounded shadow-sm h-100 card-1">
                            <h5 class="fw-semibold mb-1">Effortless Style</h5>
                            <p class="small mb-0">
                                Simple, rapi, dan nyaman dipake harian.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up">
                        <div class="p-3 rounded shadow-sm h-100 card-1">
                            <h5 class="fw-semibold mb-1">Detail-Oriented</h5>
                            <p class="small text mb-0">
                                Detail kecil yang bikin look lo beda.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 " data-aos="fade-right">
                        <div class="p-3 rounded shadow-sm h-100 card-1">
                            <h5 class="fw-semibold mb-1">Authentic Vibes</h5>
                            <p class="small mb-0">
                                Nggak ikut arus — lo bikin arusnya sendiri.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- BLOG -->
    <div class="container-fluid py-5" id="blog">
        <div class="container" data-aos="fade-down"
            data-aos-easing="linear">

            <h2 class="text-center text-white font-monospace mt-4 pb-2 fw-bold">BLOG</h2>
            <div class="blog-card ft">
                <h5>Tips Memilih Outfit Kasual untuk Kuliah</h5>
                <p>Tampil rapi dan tetap santai ke kampus? Bisa banget! Simak tips memilih outfit kasual yang nyaman tapi tetap stylish buat aktivitas harianmu di kelas. Mulai dari mix and match kemeja, kaos, jeans, hingga sneakers yang pas untuk gaya kuliahmu.</p>
                <a href="https://glints.com/id/lowongan/outfit-kuliah/" target="_blank">Baca selengkapnya »</a>
            </div>

            <div class="blog-card ft">
                <h5>Inspirasi Fashion Pria Minimalis ala Korea</h5>
                <p>
                    Gaya simpel tapi tetap stylish? Temukan inspirasi fashion minimalis ala Korea yang cocok buat kamu yang suka tampil effortless tapi tetap memikat. Pilihan outfit dengan warna netral dan potongan clean akan bikin tampilanmu makin elegan!
                </p>
                <a href="https://id.pinterest.com/adinindya/outfit-cowok-korea/" target="_blank">Baca selengkapnya »</a>
            </div>

            <div class="blog-card ft">
                <h5>5 Tren Fashion Musim Panas 2025 yang Wajib Kamu Coba!</h5>
                <p>
                    Musim panas identik dengan warna cerah dan bahan ringan. Yuk, intip 5 tren fashion terkini yang siap bikin penampilanmu makin segar dan fashionable di tahun 2025!
                </p>
                <a href="https://www.fimela.com/fashion/read/5967333/tren-fashion-yang-wajib-kamu-ikuti-di-tahun-2025?page=2" target="_blank">Baca selengkapnya »</a>
            </div>

            <div class="blog-card ft">
                <h5>Gaya Kasual Pria untuk Weekend yang Nyaman dan Trendy</h5>
                <p>
                    Akhir pekan adalah waktu yang pas untuk tampil gaya tanpa ribet. Mulai dari look santai hingga semi-formal, temukan 5 outfit keren yang cocok untuk jalan-jalan, nongkrong, atau hangout bareng teman!
                </p>
                <a href="https://www.houseofcuff.com/blog/8235/gaya-kasual-pria-untuk-weekend-yang-nyaman-dan-trendy-houseofcuff?srsltid=AfmBOoqtMuhvg_p4ltTMDXyqal7gEPOt0pIxKiYxL0MxeFmm1OWX-udl" target="_blank">Baca selengkapnya »</a>
            </div>
        </div>
    </div>

    <!-- PROMO -->
    <div class="container-fluid py-5" id="promo">
        <div class="container">
            <div id="carouselExampleFade" class="carousel slide carousel-fade pt-5">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../assets/img/Home/promo1.png" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/Home/promo2.png" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/Home/promo3.png" class="d-block w-100" alt="..." />
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- PRODUK -->
    <div class="container-fluid py-5" id="produk">
        <div class="container py-4">
            <h3 class="mb-2 text-center mt-5 fs-2 fw-bold">Produk</h3>

            <!-- BAJU -->
            <div id="baju">
                <h2 class="text-center pb-1 font-monospace"
                    data-aos-anchor-placement="center-bottom">Baju</h2>
                <div class="row">
                    <div class="card-slider produk d-flex overflow-auto gap-3 pb-3">

                        <div class="col-lg-3 col-md-4 col-6 HP my-4">
                            <div class="card card-hover-scale">
                                <img src="gambar/b1.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <p>
                                        <span class="fs-5 fw-bold">Best Seller</span>
                                        <span class="fw-bold">Vanguard</span> - DRAGON WAR
                                    </p>
                                    <div class="">
                                        <span>Rp.170.000</span>
                                        <del class="text-muted">Rp.250.000</del>
                                    </div>
                                    <div class="rating">
                                        ★★★★★
                                        <span class="text-muted">5780</span>
                                        <span class="text-dark">terjual</span>
                                    </div>
                                    <p class="mt-2"><i class="bi bi-geo-alt"></i> Cianjur</p>
                                    <a href="#" class="btn btn-primary beli-btn">Beli</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- ====================================== -->

    <!-- DROPDOWN M -->
    <div class="contaner-fluid">
        <div class="container">
            <div class="col-md-12 d-block m-auto">
                <h2 class="pt-5 pb-3 text-center ">
                    Kenapa Harus Belanja di Vanguard ?
                </h2>
                <!-- ACCRODION -->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne">
                                Desain Premium
                            </button>
                        </h2>
                        <div
                            id="collapseOne"
                            class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Vanguard Synergy menghadirkan koleksi pakaian kasual dengan desain yang minimalis, modern, dan tahan tren.
                                    Setiap potongan kami dibuat dengan memperhatikan proporsi dan detail yang presisi, sehingga nyaman dipakai dan tetap terlihat stylish
                                    dalam berbagai situasi dari ngopi santai hingga acara kasual semi-formal. Gaya kasualmu jadi lebih elegan tanpa perlu usaha berlebih.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo">
                                Bahan Nyaman & Berkualitas Tinggi
                            </button>
                        </h2>
                        <div
                            id="collapseTwo"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Kenyamanan adalah prioritas utama kami. Semua koleksi kami dibuat menggunakan bahan pilihan yang lembut, adem, dan tahan lama — cocok dipakai seharian penuh.
                                    Mulai dari katun combed, linen, hingga bahan stretch berkualitas tinggi, setiap material telah melalui proses kurasi agar bisa menyatu dengan aktivitas harianmu, tanpa mengorbankan gaya.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree">
                                Pilihan Produk Lengkap & Variatif
                            </button>
                        </h2>
                        <div
                            id="collapseThree"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Kami memahami bahwa setiap orang punya gaya berbeda. Itulah mengapa Vanguard Synergy menghadirkan beragam jenis pakaian kasual:
                                <ul>
                                    <li>Baju</li>
                                    <li>Kemeja</li>
                                    <li>Celana</li>
                                    <li>Aksesori</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapsefour"
                                aria-expanded="false"
                                aria-controls="collapsefour">
                                Gaya Kasual yang Tetap Stylish
                            </button>
                        </h2>
                        <div
                            id="collapsefour"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Kami percaya bahwa kasual bukan berarti membosankan. Koleksi Vanguard Synergy didesain untuk memberikan kesan santai tapi tetap fashionable, membuatmu tampil percaya diri di berbagai momen.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapsefive"
                                aria-expanded="false"
                                aria-controls="collapsefivee">
                                Harga Terjangkau, Nilai Maksimal
                            </button>
                        </h2>
                        <div
                            id="collapsefive"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Kami percaya bahwa fashion berkualitas tidak harus mahal. Di Vanguard Synergy, kamu bisa mendapatkan pakaian kasual premium dengan harga yang masuk akal.
                                    Kami mengutamakan keseimbangan antara kualitas bahan, desain, dan harga agar kamu bisa tampil maksimal tanpa harus merogoh kocek dalam-dalam.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapsesix"
                                aria-expanded="false"
                                aria-controls="collapsesix">
                                Pelayanan Pelanggan yang Responsif & Ramah
                            </button>
                        </h2>
                        <div
                            id="collapsesix"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>
                                    Pengalaman belanja kamu adalah prioritas kami. Tim customer service kami siap membantu dengan cepat dan ramah,
                                    mulai dari pemilihan ukuran hingga proses pengiriman.
                                    Belanja online jadi lebih mudah, aman, dan menyenangkan bersama Vanguard Synergy.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER M -->
    <section class="pt-5" id="contact">
        <div class="container">
            <div class="row g-4 pt-3">

                <!-- Lokasi Kami -->
                <div class="col-lg-6 col-12" style="height: 300px;">
                    <div class="text-center mb-3">
                        <h2 class="fw-bold">Lokasi Kami</h2>
                        <p class=" small">Kunjungi kami di pusat Kota Cianjur</p>
                    </div>

                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14741.943121595636!2d107.13505880882387!3d-6.813671020706946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6853fe89e13e4b%3A0xf5c73ee519462879!2sKopi%20Nako%20Cianjur!5e0!3m2!1sid!2sid!4v1763282379401!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Ikuti & Hubungi Kami -->
                <div class="col-lg-6 col-12">
                    <div class="text-center mb-3">
                        <h2 class="fw-bold footer-ikuti">Ikuti & Hubungi Kami</h2>
                        <p class=small">Terhubung dengan kami melalui platform berikut</p>
                    </div>

                    <div class="d-flex flex-column gap-3">

                        <!-- Instagram -->
                        <a href="#" target="_blank" class="btn btn-lg text-white rounded-4 py-3 social-btn" style="background:#ff3b64;">
                            <i class="bi bi-instagram me-2"></i> Instagram
                        </a>

                        <!-- Facebook -->
                        <a href="#" target="_blank" class="btn btn-lg text-white rounded-4 py-3 social-btn" style="background:#0095ff;">
                            <i class="bi bi-facebook me-2"></i> Facebook
                        </a>

                        <!-- TikTok -->
                        <a href="#" target="_blank" class="btn btn-lg text-white rounded-4 py-3 social-btn" style="background:#000;">
                            <i class="bi bi-tiktok me-2"></i> Tiktok
                        </a>

                        <!-- Whatsapp -->
                        <a href="#" target="_blank" class="btn btn-lg text-white rounded-4 py-3 social-btn" style="background:#128c0e;">
                            <i class="bi bi-whatsapp me-2"></i> Whatsapp
                        </a>

                    </div>
                </div>

            </div>

            <!--  -->
            <div class="row justify-content-center pt-5">

                <div class="col-lg-3 col-md-6 mb-4 footerr text-center">
                    <h3>The Vanguard</h3>
                    <p class="mx-auto" style="max-width: 250px;">
                        Pakaian kasual modern dengan desain simpel, nyaman, dan penuh karakter. Tampil santai, tetap standout gaya sehari-hari yang nggak pernah membosankan.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footerr text-center">
                    <h3>Komunitas</h3>
                    <ul class="list-unstyled">
                        <li>Lookbook</li>
                        <li>Style Guide</li>
                        <li>Kolaborasi</li>
                        <li>Ulasan Pelanggan</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footerr text-center">
                    <h3>Layanan Kami</h3>
                    <ul class="list-unstyled">
                        <li>Tentang Kami</li>
                        <li>Kontak & Bantuan</li>
                        <li>Kebijakan Privasi</li>
                        <li>Syarat & Ketentuan</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footerr text-center">
                    <h3>Hubungi Kami</h3>
                    <ul class="list-unstyled">
                        <li>thevanguard@gmail.comi</li>
                        <li>0812-3456-7890</li>
                        <li>www.TheVanguard.com</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="text-center">&copy; THE VANGUAR 2025</p>
                </div>
            </div>

        </div>
    </section>





    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1500,

        });
    </script>
    <script>
        // Cegah tombol back browser
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            // Paksa logout jika tekan back
            window.location.href = "../../controllers/logout.php";
        };
    </script>

</body>

</html>