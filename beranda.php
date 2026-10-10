<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "user") {
    header("Location: ../proses_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - MediCare Hospital</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================= RESET & GENERAL ================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f7f9ff;
            color: #333;
        }

        /* ================= HEADER ================= */
        header {
            width: 100%;
            background: #ffffff;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #355CDE;
        }

        .logo span {
            color: #111;
        }

        nav a {
            text-decoration: none;
            margin-left: 30px;
            color: #444;
            font-weight: 500;
            transition: .3s;
        }

        nav a:hover {
            color: #355CDE;
        }

        /* ================= HERO ================= */
        .hero {
            width: 100%;
            height: 750px;
            background: linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)), url("image/header_hospital.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            padding: 0 8%;
        }

        .hero-text {
            width: 650px;
            color: white;
        }

        .small-title {
            color: #8ec5ff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .hero-text h1 {
            color: white;
            font-size: 65px;
            line-height: 78px;
            margin-bottom: 25px;
        }

        .hero-text p {
            color: #f1f1f1;
            line-height: 34px;
            font-size: 18px;
            margin-bottom: 35px;
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        .btn-primary {
            background: #355CDE;
            color: white;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 30px;
            transition: .3s;
        }

        .btn-primary:hover {
            background: #2748b8;
        }

        .btn-secondary {
            display: inline-block;
            padding: 15px 35px;
            border: 2px solid white;
            border-radius: 30px;
            color: white;
            text-decoration: none;
            transition: .3s;
        }

        .btn-secondary:hover {
            background: white;
            color: #355CDE;
        }

        /* ================= QUICK MENU ================= */
        .quick-menu {
            width: 85%;
            margin: auto;
            margin-top: -70px;
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 25px;
        }

        .menu-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            transition: .3s;
            text-align: center;
        }

        .menu-card:hover {
            transform: translateY(-8px);
        }

        .menu-card h3 {
            margin-bottom: 10px;
        }

        .menu-card p {
            color: #666;
            margin-bottom: 20px;
        }

        .menu-card a {
            text-decoration: none;
            color: #355CDE;
            font-weight: bold;
        }

        .menu-icon {
            font-size: 45px;
            color: #355CDE;
            display: block;
            margin: 0 auto 25px;
        }

        /* ================= ABOUT ================= */
        .about {
            width: 85%;
            margin: 100px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 60px;
        }

        .about-image {
            width: 45%;
        }

        .about-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
        }

        .about-text {
            width: 55%;
        }

        .about-text h2 {
            color: #355CDE;
            margin-bottom: 20px;
            font-size: 36px;
        }

        .about-text p {
            color: #666;
            line-height: 30px;
            margin-bottom: 20px;
        }

        .about-list {
            list-style: none;
            margin-top: 20px;
        }

        .about-list li {
            margin-bottom: 15px;
            font-size: 17px;
        }

        .about-list i {
            color: #355CDE;
            width: 28px;
        }

        /* ================= WHY US ================= */
        .why {
            width: 100%;
            background: #EEF4FF;
            padding: 80px 8%;
        }

        .title {
            text-align: center;
            margin-bottom: 50px;
        }

        .title h2 {
            color: #355CDE;
            font-size: 38px;
            margin-bottom: 15px;
        }

        .title p {
            color: #666;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 25px;
        }

        .why-card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            text-align: center;
            transition: .3s;
            box-shadow: 0 8px 20px rgba(0,0,0,.08);
        }

        .why-card:hover {
            transform: translateY(-8px);
        }

        .why-card h3 {
            margin: 20px 0 10px;
        }

        .why-card p {
            color: #666;
            font-size: 15px;
        }

        .why-card .fa-solid {
            font-size: 40px;
            margin-bottom: 20px;
            display: block;
        }

        /* ================= SERVICES ================= */
        .services {
            width: 85%;
            margin: 100px auto;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 25px;
        }

        .service-card {
            background: white;
            padding: 35px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
            transition: .3s;
        }

        .service-card:hover {
            transform: translateY(-8px);
        }

        .service-card h3 {
            margin: 20px 0 10px;
        }

        .service-card p {
            color: #666;
            font-size: 15px;
        }

        .service-card .fa-solid {
            font-size: 40px;
            margin-bottom: 20px;
            display: block;
        }

        /* ================= OPERASIONAL ================= */
        .operasional {
            width: 85%;
            margin: 100px auto;
            background: #355CDE;
            color: white;
            border-radius: 20px;
            padding: 20px 40px;
            box-shadow: 0 15px 35px rgba(53,92,222,.25);
        }

        .operasional h2 {
            text-align: center;
            font-size: 34px;
            margin-bottom: 40px;
        }

        .jam {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .jam-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .jam-item:last-child {
            border-bottom: none;
        }

        .hari {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 500;
        }

        .hari i {
            font-size: 18px;
            color: #dfe8ff;
        }

        .waktu {
            font-size: 18px;
            font-weight: 600;
        }

        /* ================= TESTIMONI ================= */
        .testimoni {
            width: 85%;
            margin: 100px auto;
        }

        .testimoni-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 25px;
        }

        .testi-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
            transition: .3s;
        }

        .testi-card:hover {
            transform: translateY(-8px);
        }

        .testi-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .testi-card h3 {
            margin-bottom: 10px;
        }

        .testi-card p {
            color: #666;
            line-height: 28px;
        }

        /* ================= FOOTER ================= */
        footer {
            background: #355CDE;
            color: white;
            margin-top: 80px;
        }

        .footer-container {
            width: 85%;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 50px;
            padding: 60px 0;
        }

        .footer-container h3 {
            margin-bottom: 20px;
        }

        .footer-container p {
            line-height: 30px;
            color: #ddd;
        }

        .footer-container a {
            display: block;
            text-decoration: none;
            color: #ddd;
            margin-bottom: 12px;
        }

        .footer-container a:hover {
            color: white;
        }

        .footer-container i {
            margin-right: 10px;
            color: #fff;
        }

        .copy {
            text-align: center;
            border-top: 1px solid rgba(255,255,255,.2);
            padding: 20px;
            color: #ddd;
        }
    </style>
</head>
<body>

    <!-- NAVBAR HEADER -->
    <header>
        <div class="logo">
            <i class="fa-solid fa-hand-holding-medical"></i>
            <span>MediCare Hospital</span>
        </div>
        <nav>
            <a href="beranda.php">Beranda</a>
            <a href="daftar_layanan.php">Layanan</a>
            <a href="daftar_dokter.php">Daftar Dokter</a>
            <a href="pendaftaran.php">Pendaftaran</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-text">
            <div class="small-title">Your Health is Our Priority</div>
            <h1>Pelayanan Kesehatan Terbaik Untuk Anda</h1>
            <p>Rumah Sakit MediCare memberikan pelayanan kesehatan profesional dengan dokter berpengalaman, fasilitas modern, dan pelayanan yang cepat serta nyaman.</p>
            <div class="button-group">
                <a href="pendaftaran.php" class="btn-primary">Daftar Sekarang</a>
                <a href="daftar_dokter.php" class="btn-secondary">Lihat Dokter</a>
            </div>
        </div>
    </section>

    <!-- QUICK MENU SECTION -->
    <section class="quick-menu">
        <div class="menu-card">
            <i class="fa-solid fa-heart-pulse menu-icon"></i>
            <h3>Layanan</h3>
            <p>Informasi lengkap mengenai layanan kesehatan rumah sakit.</p>
            <a href="daftar_layanan.php">Lihat Selengkapnya →</a>
        </div>
        <div class="menu-card">
            <i class="fa-solid fa-user-doctor menu-icon"></i>
            <h3>Daftar Dokter</h3>
            <p>Temukan dokter spesialis sesuai kebutuhan Anda.</p>
            <a href="daftar_dokter.php">Lihat Dokter →</a>
        </div>
        <div class="menu-card">
            <i class="fa-solid fa-calendar-check menu-icon"></i>
            <h3>Pendaftaran</h3>
            <p>Daftar pemeriksaan secara online dengan mudah dan cepat.</p>
            <a href="pendaftaran.php">Daftar Sekarang →</a>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=900&q=80" alt="Rumah Sakit">
        </div>
        <div class="about-text">
            <h2>Tentang Rumah Sakit</h2>
            <p>Rumah Sakit MediCare hadir untuk memberikan pelayanan kesehatan yang profesional, cepat, dan terpercaya. Didukung oleh dokter spesialis, tenaga medis berpengalaman, serta fasilitas modern.</p>
            <ul class="about-list">
                <li><i class="fa-solid fa-check"></i> Dokter Spesialis Berpengalaman</li>
                <li><i class="fa-solid fa-check"></i> Peralatan Medis Modern</li>
                <li><i class="fa-solid fa-check"></i> Pelayanan Ramah & Cepat</li>
                <li><i class="fa-solid fa-check"></i> IGD 24 Jam</li>
            </ul>
        </div>
    </section>

    <!-- WHY US SECTION -->
    <section class="why">
        <div class="title">
            <h2>Mengapa Memilih Kami?</h2>
            <p>Pelayanan kesehatan terbaik untuk Anda dan keluarga.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <i class="fa-solid fa-user-doctor"></i>
                <h3>Dokter Profesional</h3>
                <p>Tim dokter berpengalaman dari berbagai spesialis.</p>
            </div>
            <div class="why-card">
                <i class="fa-solid fa-hospital"></i>
                <h3>Fasilitas Modern</h3>
                <p>Dilengkapi teknologi medis terkini untuk pelayanan maksimal.</p>
            </div>
            <div class="why-card">
                <i class="fa-solid fa-truck-medical"></i>
                <h3>IGD 24 Jam</h3>
                <p>Siap melayani kondisi darurat kapan saja.</p>
            </div>
            <div class="why-card">
                <i class="fa-solid fa-user-nurse"></i>
                <h3>Pelayanan Ramah</h3>
                <p>Kami mengutamakan kenyamanan seluruh pasien.</p>
            </div>
        </div>
    </section>

    <!-- LAYANAN UNGGULAN SECTION -->
    <section class="services">
        <div class="title">
            <h2>Layanan Unggulan</h2>
            <p>Kami menyediakan berbagai layanan kesehatan.</p>
        </div>
        <div class="service-grid">
            <div class="service-card">
                <i class="fa-solid fa-stethoscope"></i>
                <h3>Poli Umum</h3>
                <p>Pemeriksaan kesehatan umum oleh dokter.</p>
            </div>
            <div class="service-card">
                <i class="fa-solid fa-tooth"></i>
                <h3>Poli Gigi</h3>
                <p>Perawatan kesehatan gigi dan mulut.</p>
            </div>
            <div class="service-card">
                <i class="fa-solid fa-baby"></i>
                <h3>Poli Anak</h3>
                <p>Pelayanan kesehatan khusus anak.</p>
            </div>
            <div class="service-card">
                <i class="fa-solid fa-heart"></i>
                <h3>Poli Jantung</h3>
                <p>Pemeriksaan dan konsultasi kesehatan jantung.</p>
            </div>
            <div class="service-card">
                <i class="fa-solid fa-eye"></i>
                <h3>Poli Mata</h3>
                <p>Pemeriksaan mata dengan alat modern.</p>
            </div>
            <div class="service-card">
                <i class="fa-solid fa-brain"></i>
                <h3>Poli Saraf</h3>
                <p>Pelayanan kesehatan saraf dan neurologi.</p>
            </div>
        </div>
    </section>

    <!-- JAM OPERASIONAL SECTION -->
    <section class="operasional">
        <h2>Jam Operasional</h2>
        <div class="jam">
            <div class="jam-item">
                <div class="hari">
                    <i class="fa-solid fa-calendar-days"></i> Senin - Jumat
                </div>
                <div class="waktu">08.00 - 20.00</div>
            </div>
            <div class="jam-item">
                <div class="hari">
                    <i class="fa-solid fa-calendar-days"></i> Sabtu
                </div>
                <div class="waktu">08.00 - 17.00</div>
            </div>
            <div class="jam-item">
                <div class="hari">
                    <i class="fa-solid fa-calendar-days"></i> Minggu
                </div>
                <div class="waktu">08.00 - 12.00</div>
            </div>
            <div class="jam-item">
                <div class="hari">
                    <i class="fa-solid fa-truck-medical"></i> IGD
                </div>
                <div class="waktu">24 Jam</div>
            </div>
        </div>
    </section>

    <!-- TESTIMONI SECTION -->
    <section class="testimoni">
        <div class="title">
            <h2>Testimoni Pasien</h2>
            <p>Apa kata mereka tentang pelayanan kami.</p>
        </div>
        <div class="testimoni-grid">
            <div class="testi-card">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sarah">
                <h3>Sarah</h3>
                <p>Pelayanannya sangat cepat dan dokternya ramah. Saya merasa sangat nyaman berobat di MediCare.</p>
            </div>
            <div class="testi-card">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Andi">
                <h3>Andi</h3>
                <p>Fasilitas rumah sakit sangat bersih dan modern. Proses pendaftaran juga mudah dilakukan secara online.</p>
            </div>
            <div class="testi-card">
                <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Nabila">
                <h3>Nabila</h3>
                <p>Dokter menjelaskan kondisi saya dengan sangat jelas. Pelayanan terbaik yang pernah saya rasakan.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
    <footer>
        <div class="footer-container">
            <div>
                <h3><i class="fa-solid fa-hand-holding-medical"></i> MediCare Hospital</h3>
                <p>Rumah Sakit MediCare berkomitmen memberikan pelayanan kesehatan yang profesional, cepat, aman, dan terpercaya untuk seluruh masyarakat.</p>
            </div>
            <div>
                <h3>Menu</h3>
                <a href="beranda.php">Beranda</a>
                <a href="daftar_layanan.php">Layanan</a>
                <a href="daftar_dokter.php">Daftar Dokter</a>
                <a href="pendaftaran.php">Pendaftaran</a>
            </div>
            <div>
                <h3>Kontak</h3>
                <p>
                    <i class="fa-solid fa-location-dot"></i> Jl. Kesehatan No.123 Jakarta<br><br>
                    <i class="fa-solid fa-phone"></i> (021) 12345678<br><br>
                    <i class="fa-solid fa-envelope"></i> info@medicare.com<br><br>
                    <i class="fa-solid fa-clock"></i> Senin - Minggu
                </p>
            </div>
        </div>
        <div class="copy">
            &copy; 2026 MediCare Hospital | All Rights Reserved.
        </div>
    </footer>

</body>
</html>