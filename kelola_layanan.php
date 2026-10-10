<?php
include "koneksi.php";

/*=========================
AMBIL DATA EDIT
=========================*/

$edit = false;

$id = "";
$nama = "";
$deskripsi = "";
$harga = "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $ambil = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan='$id'");
    $e = mysqli_fetch_assoc($ambil);
    $nama = $e['nama_layanan'];
    $deskripsi = $e['deskripsi'];
    $harga = $e['harga'];
}

/*=========================
SIMPAN DATA
=========================*/

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    mysqli_query($koneksi, "INSERT INTO layanan (nama_layanan, deskripsi, harga) VALUES ('$nama', '$deskripsi', '$harga')");

    echo "<script>
    alert('Layanan berhasil ditambahkan');
    window.location='kelola_layanan.php';
    </script>";
}

/*=========================
UPDATE DATA
=========================*/

if (isset($_POST['update'])) {
    $id = $_POST['id_layanan'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    mysqli_query($koneksi, "UPDATE layanan SET nama_layanan='$nama', deskripsi='$deskripsi', harga='$harga' WHERE id_layanan='$id'");

    echo "<script>
    alert('Data berhasil diupdate');
    window.location='kelola_layanan.php';
    </script>";
}

/*=========================
HAPUS DATA
=========================*/

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM layanan WHERE id_layanan='$id'");

    echo "<script>
    alert('Data berhasil dihapus');
    window.location='kelola_layanan.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Layanan - MediCare Hospital</title>
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
            border: none;
        }
        .btn-reset:hover {
            background: #bfc5ce;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-hand-holding-medical me-3" style="font-size:42px; color:#355CDE;"></i>
            <h2 class="m-0 fw-bold" style="color:#355CDE;">MediCare Hospital</h2>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-white" style="background:#355CDE;">
                <h3>Kelola Layanan</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id_layanan" value="<?= $id; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" value="<?= $nama; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required><?= $deskripsi; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= $harga; ?>" required>
                    </div>

                    <?php if ($edit) { ?>
                        <button type="submit" name="update" class="btn btn-medicare">Update</button>
                        <a href="kelola_layanan.php" class="btn btn-reset">Batal</a>
                    <?php } else { ?>
                        <button type="submit" name="simpan" class="btn btn-medicare">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    <?php } ?>
                </form>

                <br>

                <div class="card">
                    <div class="card-header text-white" style="background:#355CDE;">
                        <h4>Data Layanan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover align-middle">
                            <thead style="background:#355CDE; color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY id_layanan DESC");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['nama_layanan']; ?></td>
                                        <td><?= $d['deskripsi']; ?></td>
                                        <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="kelola_layanan.php?edit=<?= $d['id_layanan']; ?>" class="btn btn-medicare btn-sm">Edit</a>
                                            <a href="kelola_layanan.php?hapus=<?= $d['id_layanan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>