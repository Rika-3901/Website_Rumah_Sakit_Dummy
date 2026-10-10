<?php
include "koneksi.php";

/*=========================
  AMBIL DATA EDIT (GET)
=========================*/
$edit = false;

$id = "";
$nama = "";
$spesialis = "";
$jadwal = "";
$telepon = "";
$foto_lama = "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $ambil = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter='$id'");
    $e = mysqli_fetch_assoc($ambil);
    
    if ($e) {
        $nama = $e['nama_dokter'];
        $spesialis = $e['spesialis'];
        $jadwal = $e['jadwal_praktik'];
        $telepon = $e['no_telepon'];
        $foto_lama = $e['foto'];
    }
}

/*=========================
  PROSES SIMPAN DATA BARU
==========================*/
if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialis = mysqli_real_escape_string($koneksi, $_POST['spesialis']);
    $jadwal = mysqli_real_escape_string($koneksi, $_POST['jadwal_praktik']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);

    // Upload Foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($foto != "") {
        $folder = "upload/dokter/";
        move_uploaded_file($tmp, $folder . $foto);
    }

    mysqli_query($koneksi, "INSERT INTO dokter (nama_dokter, spesialis, jadwal_praktik, no_telepon, foto) 
        VALUES ('$nama', '$spesialis', '$jadwal', '$telepon', '$foto')");

    echo "<script>
    alert('Data dokter berhasil ditambahkan');
    window.location='kelola_dokter.php';
    </script>";
}

/*=========================
  PROSES UPDATE DATA
==========================*/
if (isset($_POST['update'])) {
    $id = $_POST['id_dokter'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialis = mysqli_real_escape_string($koneksi, $_POST['spesialis']);
    $jadwal = mysqli_real_escape_string($koneksi, $_POST['jadwal_praktik']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);

    $fotoBaru = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if ($fotoBaru != "") {
        // Ambil nama foto lama untuk dihapus dari folder
        $ambil = mysqli_query($koneksi, "SELECT foto FROM dokter WHERE id_dokter='$id'");
        $lama = mysqli_fetch_assoc($ambil);

        if (!empty($lama['foto']) && file_exists("upload/dokter/" . $lama['foto'])) {
            unlink("upload/dokter/" . $lama['foto']);
        }

        // Upload foto baru
        move_uploaded_file($tmp, "upload/dokter/" . $fotoBaru);

        mysqli_query($koneksi, "UPDATE dokter SET 
            nama_dokter='$nama', 
            spesialis='$spesialis', 
            jadwal_praktik='$jadwal', 
            no_telepon='$telepon', 
            foto='$fotoBaru' 
            WHERE id_dokter='$id'");
    } else {
        // Jika tidak ganti foto, update data selain foto
        mysqli_query($koneksi, "UPDATE dokter SET 
            nama_dokter='$nama', 
            spesialis='$spesialis', 
            jadwal_praktik='$jadwal', 
            no_telepon='$telepon' 
            WHERE id_dokter='$id'");
    }

    echo "<script>
    alert('Data berhasil diupdate');
    window.location='kelola_dokter.php';
    </script>";
}

/*=========================
  PROSES HAPUS DATA
==========================*/
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil nama foto terlebih dahulu untuk dihapus dari folder
    $ambil = mysqli_query($koneksi, "SELECT foto FROM dokter WHERE id_dokter='$id'");
    $lama = mysqli_fetch_assoc($ambil);

    if (!empty($lama['foto']) && file_exists("upload/dokter/" . $lama['foto'])) {
        unlink("upload/dokter/" . $lama['foto']);
    }

    // Hapus data dari database
    mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter='$id'");

    echo "<script>
    alert('Data berhasil dihapus');
    window.location='kelola_dokter.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Dokter - MediCare Hospital</title>
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
        img {
            border-radius: 10px;
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

    <!-- Header Brand -->
    <div class="container mt-4">
        <div class="d-flex align-items-center mb-3">
            <i class="fa-solid fa-hand-holding-medical me-2" style="font-size: 34px; color: #355CDE;"></i>
            <h2 class="m-0 fw-bold" style="color: #355CDE;">MediCare Hospital</h2>
        </div>
    </div>

    <div class="container mt-5">
        <!-- Form Kelola Dokter -->
        <div class="card mb-5">
            <div class="card-header text-white" style="background: #355CDE;">
                <h3 class="m-0"><?= $edit ? 'Edit Data Dokter' : 'Form Kelola Dokter'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <!-- Input Hidden ID Dokter -->
                    <input type="hidden" name="id_dokter" value="<?= $id; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" name="nama_dokter" class="form-control" value="<?= $nama; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Spesialis</label>
                        <input type="text" name="spesialis" class="form-control" value="<?= $spesialis; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jadwal Praktik</label>
                        <input type="text" name="jadwal_praktik" class="form-control" placeholder="Contoh : Senin - Jumat" value="<?= $jadwal; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="<?= $telepon; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Dokter</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" <?= $edit ? '' : 'required'; ?>>
                        <?php if ($edit && !empty($foto_lama)) { ?>
                            <div class="form-text text-muted mt-2">
                                Foto saat ini: <br>
                                <img src="upload/dokter/<?= $foto_lama; ?>" width="80" class="mt-1" alt="Foto Lama">
                                <br><small>*Biarkan kosong jika tidak ingin mengubah foto</small>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if ($edit) { ?>
                        <button type="submit" name="update" class="btn btn-medicare me-2">Update</button>
                        <a href="kelola_dokter.php" class="btn btn-reset">Batal</a>
                    <?php } else { ?>
                        <button type="submit" name="simpan" class="btn btn-medicare me-2">Simpan</button>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <!-- Tabel Data Dokter -->
        <div class="card">
            <div class="card-header text-white" style="background: #355CDE;">
                <h4 class="m-0">Data Dokter</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover m-0 align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Dokter</th>
                                <th>Spesialis</th>
                                <th>Jadwal</th>
                                <th>No Telepon</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY id_dokter DESC");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center">
                                    <?php if(!empty($d['foto']) && file_exists("upload/dokter/" . $d['foto'])) { ?>
                                        <img src="upload/dokter/<?= $d['foto']; ?>" width="80" alt="Foto Dokter">
                                    <?php } else { ?>
                                        <span class="badge bg-secondary">Tidak ada foto</span>
                                    <?php } ?>
                                </td>
                                <td><?= $d['nama_dokter']; ?></td>
                                <td><?= $d['spesialis']; ?></td>
                                <td><?= $d['jadwal_praktik']; ?></td>
                                <td><?= $d['no_telepon']; ?></td>
                                <td class="text-center">
                                    <a href="kelola_dokter.php?edit=<?= $d['id_dokter']; ?>" class="btn btn-medicare btn-sm me-1">Edit</a>
                                    <a href="kelola_dokter.php?hapus=<?= $d['id_dokter']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data dokter ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>