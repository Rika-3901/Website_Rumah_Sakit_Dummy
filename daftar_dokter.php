<?php
include "koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Dokter - MediCare Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: #eef4f9;
        }

        /*=========================
        CARDS DOKTER
        ==========================*/
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: .3s;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        .card:hover {
            transform: translateY(-8px);
        }
        .card img {
            height: 360px;
            object-fit: cover;
        }
        .badge {
            font-size: 14px;
        }
        .badge-spesialis {
            background: #355CDE;
            color: white;
            font-size: 14px;
            padding: 8px 14px;
            border-radius: 20px;
        }

        /*=========================
        HEADER & NAVIGATION
        ==========================*/
        header {
            background: #355CDE;
            padding: 12px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 10px rgba(0,0,0,.1);
        }
        .logo {
            color: white;
            font-size: 28px;
            font-weight: 700;
        }
        .logo i {
            margin-right: 10px;
        }
        .logo span {
            color: white;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-weight: 500;
            transition: .3s;
        }
        nav a:hover {
            color: #cfe2ff;
        }

        /*=========================
        HERO & BUTTONS
        ==========================*/
        .hero {
            background: #355CDE;
            color: white;
            padding: 25px 40px;
            margin-bottom: 30px;
        }
        .btn-medicare {
            background: #355CDE;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            transition: .3s;
        }
        .btn-medicare:hover {
            background: #2748b8;
            color: white;
        }

        /*=========================
        FOOTER
        ==========================*/
        footer {
            background: #1F3A8A;
            color: white;
            margin-top: 70px;
        }
        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            padding: 50px 30px;
        }
        .footer-container h3 {
            margin-bottom: 20px;
        }
        .footer-container p {
            color: #ddd;
            line-height: 30px;
        }
        .footer-container a {
            display: block;
            color: #ddd;
            text-decoration: none;
            margin-bottom: 12px;
        }
        .footer-container a:hover {
            color: white;
        }
        .copy {
            text-align: center;
            padding: 18px;
            border-top: 1px solid rgba(255,255,255,.2);
            color: #ddd;
        }
    </style>
</head>
<body>

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

    <div class="container-fluid px-4 mt-4 mb-4">
        <h2 class="page-title">Daftar Dokter</h2>
        <p class="page-subtitle">Temukan dokter spesialis terbaik sesuai kebutuhan Anda.</p>
    </div>

    <div class="container-fluid px-4">
        <div class="row">
            <?php while($d = mysqli_fetch_array($data)){ ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="upload/dokter/<?php echo $d['foto']; ?>" class="card-img-top" alt="Foto Dokter">
                        <div class="card-body">
                            <h4><?php echo $d['nama_dokter']; ?></h4>
                            <span class="badge badge-spesialis">
                                <?php echo $d['spesialis']; ?>
                            </span>
                            <hr>
                            <p>
                                <i class="bi bi-calendar-event"></i> <?php echo $d['jadwal_praktik']; ?>
                            </p>
                            <p>
                                <i class="bi bi-telephone"></i> <?php echo $d['no_telepon']; ?>
                            </p>
                            <button class="btn btn-medicare w-100">
                                <i class="bi bi-calendar-check"></i> Buat Janji
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div>
                <h3><i class="fa-solid fa-hand-holding-medical"></i> MediCare Hospital</h3>
                <p>Rumah Sakit MediCare berkomitmen memberikan pelayanan kesehatan yang profesional, aman, dan terpercaya.</p>
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
                    <i class="fa-solid fa-envelope"></i> info@medicare.com
                </p>
            </div>
        </div>
        <div class="copy">
            © 2026 MediCare Hospital | All Rights Reserved.
        </div>
    </footer>

</body>
</html>