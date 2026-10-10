<?php
include "koneksi.php";

// Jumlah Dokter
$dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
$total_dokter = mysqli_num_rows($dokter);

// Jumlah Pasien
$pasien = mysqli_query($koneksi, "SELECT * FROM pendaftaran");
$total_pasien = mysqli_num_rows($pasien);

// Jumlah Layanan
$layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
$total_layanan = mysqli_num_rows($layanan);

date_default_timezone_set("Asia/Jakarta");
$persen = min($total_pasien * 10, 100);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - MediCare Hospital</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #eef3f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /*=========================
        SIDEBAR NAVIGATION
        ==========================*/
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #2563EB, #1D4ED8, #1E3A8A);
            color: white;
            box-shadow: 5px 0 20px rgba(0,0,0,.15);
        }
        .sidebar h3 {
            padding: 25px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 22px;
            font-weight: bold;
        }
        .sidebar h3 i {
            font-size: 28px;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            padding: 28px 20px;
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }
        .logo i {
            font-size: 24px;
            color: #dbeafe;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            transition: .3s;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,.2);
            padding-left: 35px;
        }

        /*=========================
        MAIN CONTENT & CARDS
        ==========================*/
        .content {
            margin-left: 270px;
            padding: 30px;
        }
        .banner {
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            color: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,.15);
            margin-bottom: 30px;
        }
        .stat-link {
            text-decoration: none;
            display: block;
        }
        .stat-card {
            border: none;
            border-radius: 18px;
            transition: .3s;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,.15);
        }
        .stat-card i {
            font-size: 45px;
        }
        .number {
            font-size: 38px;
            font-weight: bold;
        }

        /*=========================
        INFORMATION BOXES
        ==========================*/
        .box {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
            margin-top: 25px;
        }
        .progress {
            height: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-hand-holding-medical"></i>
            MediCare Hospital
        </div>
        <hr>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="kelola_dokter.php"><i class="bi bi-person-badge"></i> Kelola Dokter</a>
        <a href="kelola_layanan.php"><i class="bi bi-heart-pulse"></i> Kelola Layanan</a>
        <a href="kelola_pendaftaran.php"><i class="bi bi-clipboard2-pulse"></i> Kelola Pendaftaran</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Banner -->
        <div class="banner">
            <h2>
                <i class="fa-solid fa-house-medical text-white"></i>
                Dashboard Admin
            </h2>
            <p>Selamat Datang Admin</p>
            <p><?php echo date("l, d F Y"); ?></p>
        </div>

        <!-- Kartu Statistik Utama -->
        <div class="row">
            <!-- Kartu Jumlah Dokter (Menuju kelola_dokter.php) -->
            <div class="col-md-4">
                <a href="kelola_dokter.php" class="stat-link">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge-fill"></i>
                            <h5 class="mt-3">Jumlah Dokter</h5>
                            <div class="number"><?php echo $total_dokter; ?></div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kartu Jumlah Pasien (Menuju kelola_pendaftaran.php) -->
            <div class="col-md-4">
                <a href="kelola_pendaftaran.php" class="stat-link">
                    <div class="card stat-card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-people-fill"></i>
                            <h5 class="mt-3">Jumlah Pasien</h5>
                            <div class="number"><?php echo $total_pasien; ?></div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kartu Jumlah Layanan (Menuju kelola_layanan.php) -->
            <div class="col-md-4">
                <a href="kelola_layanan.php" class="stat-link">
                    <div class="card stat-card bg-danger text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-heart-pulse-fill"></i>
                            <h5 class="mt-3">Jumlah Layanan</h5>
                            <div class="number"><?php echo $total_layanan; ?></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Detail Data & Info Sistem -->
        <div class="row">
            <!-- Progress Pendaftaran -->
            <div class="col-md-6">
                <div class="box">
                    <h4>
                        <i class="fa-solid fa-chart-simple text-primary"></i>
                        Statistik Pendaftaran
                    </h4>
                    <div class="progress mt-4">
                        <div class="progress-bar bg-success" style="width: <?php echo $persen; ?>%">
                            <?php echo $persen; ?>%
                        </div>
                    </div>
                    <p class="mt-4">
                        Total pasien terdaftar : <b><?php echo $total_pasien; ?></b>
                    </p>
                </div>
            </div>

            <!-- Status Sistem -->
            <div class="col-md-6">
                <div class="box">
                    <h4>
                        <i class="fa-solid fa-circle-info text-primary"></i>
                        Informasi Sistem
                    </h4>
                    <hr>
                    <p><i class="fa-solid fa-square-check text-primary"></i> Database Terhubung</p>
                    <p><i class="fa-solid fa-anchor-circle-check text-primary"></i> Login Admin Berhasil</p>
                    <p><i class="fa-solid fa-house-medical-circle-check text-primary"></i> Sistem Informasi Rumah Sakit Aktif</p>
                    <p><i class="fa-solid fa-calendar-check text-primary"></i> Update Terakhir : <?php echo date("d-m-Y"); ?></p>
                </div>
            </div>
        </div>

        <!-- Ringkasan Global -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <h4>
                        <i class="bi bi-calendar2-check-fill text-primary"></i>
                        Ringkasan Hari Ini
                    </h4>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h2 class="text-primary"><?php echo $total_dokter; ?></h2>
                            <p>Dokter Aktif</p>
                        </div>
                        <div class="col-md-4">
                            <h2 class="text-success"><?php echo $total_pasien; ?></h2>
                            <p>Pasien Terdaftar</p>
                        </div>
                        <div class="col-md-4">
                            <h2 class="text-danger"><?php echo $total_layanan; ?></h2>
                            <p>Layanan Rumah Sakit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>