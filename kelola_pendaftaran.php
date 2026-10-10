<?php
include "koneksi.php";

/*=========================
AMBIL DATA EDIT
=========================*/

$edit = false;

$id = "";
$nama = "";
$nohp = "";
$alamat = "";
$id_dokter = "";
$id_layanan = "";
$tanggal = "";
$keluhan = "";
$status = "Menunggu";

if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $ambil = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id_pendaftaran='$id'");
    $e = mysqli_fetch_assoc($ambil);
    $nama = $e['nama_pasien'];
    $nohp = $e['no_hp'];
    $alamat = $e['alamat'];
    $id_dokter = $e['id_dokter'];
    $id_layanan = $e['id_layanan'];
    $tanggal = $e['tanggal'];
    $keluhan = $e['keluhan'];
    $status = $e['status'];
}

/*=========================
SIMPAN DATA
=========================*/

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $nohp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $dokter = $_POST['id_dokter'];
    $layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal'];
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $status = $_POST['status'];
    
    mysqli_query($koneksi, "INSERT INTO pendaftaran
    (nama_pasien, no_hp, alamat, id_dokter, id_layanan, tanggal, keluhan, status)
    VALUES
    ('$nama', '$nohp', '$alamat', '$dokter', '$layanan', '$tanggal', '$keluhan', '$status')");

    echo "<script>
    alert('Data pendaftaran berhasil ditambahkan');
    window.location='kelola_pendaftaran.php';
    </script>";
}

/*=========================
UPDATE DATA
=========================*/

if (isset($_POST['update'])) {
    $id = $_POST['id_pendaftaran'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $nohp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $dokter = $_POST['id_dokter'];
    $layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal'];
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $status = $_POST['status'];

    mysqli_query($koneksi, "UPDATE pendaftaran SET
    nama_pasien='$nama',
    no_hp='$nohp',
    alamat='$alamat',
    id_dokter='$dokter',
    id_layanan='$layanan',
    tanggal='$tanggal',
    keluhan='$keluhan',
    status='$status'
    WHERE id_pendaftaran='$id'");

    echo "<script>
    alert('Data berhasil diupdate');
    window.location='kelola_pendaftaran.php';
    </script>";
}

/*=========================
HAPUS DATA
=========================*/

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id_pendaftaran='$id'");

    echo "<script>
    alert('Data berhasil dihapus');
    window.location='kelola_pendaftaran.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pendaftaran - MediCare Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
        }
        .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        .btn-medicare {
            background: #355CDE;
            color: white;
            border: none;
        }
        .btn-medicare:hover {
            background: #2748b8;
            color: white;
        }
        .btn-reset {
            background: #d1d5db;
            color: #333;
        }
        .btn-reset:hover {
            background: #bfc5ce;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .table thead {
            background: #355CDE;
            color: white;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .logo i {
            font-size: 42px;
            color: #355CDE;
        }
        .logo h2 {
            color: #355CDE;
            font-weight: bold;
            margin: 0;
        }
        .card-header {
            background: #355CDE;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="logo">
            <i class="fa-solid fa-hand-holding-medical"></i>
            <h2>MediCare Hospital</h2>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Kelola Pendaftaran</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id_pendaftaran" value="<?= $id; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" value="<?= $nama; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="<?= $nohp; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required><?= $alamat; ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dokter</label>
                            <select name="id_dokter" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                <?php
                                $dokter = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
                                while ($d = mysqli_fetch_array($dokter)) {
                                ?>
                                    <option value="<?= $d['id_dokter'];?>" <?= ($id_dokter == $d['id_dokter']) ? "selected" : ""; ?>>
                                        <?= $d['nama_dokter']; ?> - <?= $d['spesialis']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Layanan</label>
                            <select name="id_layanan" class="form-select" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php
                                $layanan = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
                                while ($l = mysqli_fetch_array($layanan)) {
                                ?>
                                    <option value="<?= $l['id_layanan'];?>" <?= ($id_layanan == $l['id_layanan']) ? "selected" : ""; ?>>
                                        <?= $l['nama_layanan']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Berobat</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= $tanggal; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Menunggu" <?= ($status == "Menunggu") ? "selected" : ""; ?>>Menunggu</option>
                                <option value="Diterima" <?= ($status == "Diterima") ? "selected" : ""; ?>>Diterima</option>
                                <option value="Selesai" <?= ($status == "Selesai") ? "selected" : ""; ?>>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="4" required><?= $keluhan; ?></textarea>
                    </div>

                    <?php if ($edit) { ?>
                        <button type="submit" name="update" class="btn btn-medicare">
                            <i class="fa-solid fa-pen-to-square"></i> Update
                        </button>
                        <a href="kelola_pendaftaran.php" class="btn btn-reset">Batal</a>
                    <?php } else { ?>
                        <button type="submit" name="simpan" class="btn btn-medicare">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header">
                <h4>Data Pendaftaran</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT pendaftaran.*, dokter.nama_dokter, layanan.nama_layanan FROM pendaftaran INNER JOIN dokter ON pendaftaran.id_dokter = dokter.id_dokter INNER JOIN layanan ON pendaftaran.id_layanan = layanan.id_layanan ORDER BY id_pendaftaran DESC");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama_pasien']; ?></td>
                                <td><?= $d['nama_dokter']; ?></td>
                                <td><?= $d['nama_layanan']; ?></td>
                                <td><?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                                <td>
                                    <?php
                                    if ($d['status'] == "Menunggu") {
                                        echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
                                    } elseif ($d['status'] == "Diterima") {
                                        echo "<span class='badge' style='background:#355CDE;'>Diterima</span>";
                                    } else {
                                        echo "<span class='badge bg-success'>Selesai</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="kelola_pendaftaran.php?edit=<?= $d['id_pendaftaran']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="kelola_pendaftaran.php?hapus=<?= $d['id_pendaftaran']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>