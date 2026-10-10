<?php
include "koneksi.php";

/*=========================
SIMPAN DATA PENDAFTARAN
==========================*/

if (isset($_POST['daftar'])) {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $nohp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat  = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $dokter  = $_POST['id_dokter'];
    $layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal'];
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);

    mysqli_query($koneksi, "INSERT INTO pendaftaran
    (nama_pasien, no_hp, alamat, id_dokter, id_layanan, tanggal, keluhan, status)
    VALUES
    ('$nama', '$nohp', '$alamat', '$dokter', '$layanan', '$tanggal', '$keluhan', 'Menunggu')");

    echo "<script>
    alert('Pendaftaran berhasil! Silakan menunggu konfirmasi.');
    window.location='pendaftaran.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Online - MediCare Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef4f9;
            font-family: Segoe UI, sans-serif;
        }

        /*=========================
        HEADER
        ==========================*/
        header {
            background: #355CDE;
            padding: 12px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 10px rgba(0,0,0,.12);
        }
        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
        }
        .logo i {
            margin-right: 10px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-weight: 500;
            transition: .3s;
        }
        nav a:hover {
            color: #dbeafe;
        }

        /*=========================
        JUDUL
        ==========================*/
        .page-title {
            font-size: 34px;
            font-weight: 700;
            color: #355CDE;
            margin-bottom: 8px;
        }
        .page-subtitle {
            color: #6b7280;
            font-size: 17px;
        }

        /*=========================
        CARD FORM
        ==========================*/
        .form-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,.08);
            overflow: hidden;
        }
        .form-header {
            background: #355CDE;
            color: white;
            padding: 22px 30px;
        }
        .form-header h3 {
            margin: 0;
            font-weight: bold;
        }
        .form-body {
            padding: 35px;
        }

        /*=========================
        FORM
        ==========================*/
        .form-label {
            font-weight: 600;
            color: #374151;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #355CDE;
            box-shadow: 0 0 0 .15rem rgba(53,92,222,.25);
        }

        /*=========================
        BUTTON
        ==========================*/
        .btn-medicare {
            background: #355CDE;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
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
            margin-bottom: 18px;
        }
        .footer-container p {
            color: #ddd;
            line-height: 28px;
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
            <i class="fa-solid fa-hand-holding-medical"></i> MediCare
        </div>
        <nav>
            <a href="beranda.php">Beranda</a>
            <a href="daftar_layanan.php">Layanan</a>
            <a href="daftar_dokter.php">Daftar Dokter</a>
            <a href="pendaftaran.php">Pendaftaran</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container mt-4 mb-4">
        <h2 class="page-title">Pendaftaran Online</h2>
        <p class="page-subtitle">Silakan isi formulir berikut untuk melakukan pendaftaran pemeriksaan di MediCare Hospital.</p>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-header">
                        <h3><i class="fa-solid fa-notes-medical me-2"></i> Formulir Pendaftaran</h3>
                    </div>
                    <div class="form-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Dokter</label>
                                    <select name="id_dokter" class="form-select" required>
                                        <option value="">-- Pilih Dokter --</option>
                                        <?php
                                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
                                        while ($d = mysqli_fetch_array($dokter)) {
                                        ?>
                                            <option value="<?= $d['id_dokter']; ?>">
                                                <?= $d['nama_dokter']; ?> - <?= $d['spesialis']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Layanan</label>
                                    <select name="id_layanan" class="form-select" required>
                                        <option value="">-- Pilih Layanan --</option>
                                        <?php
                                        $layanan = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
                                        while ($l = mysqli_fetch_array($layanan)) {
                                        ?>
                                            <option value="<?= $l['id_layanan']; ?>">
                                                <?= $l['nama_layanan']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Berobat</label>
                                    <input type="date" name="tanggal" class="form-control" min="<?= date('Y-m-d');?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Keluhan</label>
                                    <textarea name="keluhan" class="form-control" rows="1" placeholder="Contoh: Demam, Batuk, Sakit Kepala..." required></textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-grid">
                                <button type="submit" name="daftar" class="btn btn-medicare">
                                    <i class="fa-solid fa-calendar-check me-2"></i> Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div>
                <h3><i class="fa-solid fa-hand-holding-medical"></i> MediCare Hospital</h3>
                <p>Rumah Sakit MediCare berkomitmen memberikan pelayanan kesehatan yang profesional, aman, nyaman, dan terpercaya untuk seluruh masyarakat.</p>
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