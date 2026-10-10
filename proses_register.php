<?php
include "koneksi.php";

$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Semua yang daftar otomatis menjadi user
$role = "user";

// Cek apakah username sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($cek) > 0){

    echo "<script>
        alert('Username sudah digunakan!');
        window.location='register.php';
    </script>";

}else{

    mysqli_query($koneksi,"INSERT INTO users(nama,username,password,role)
    VALUES('$nama','$username','$password','$role')");

    echo "<script>
        alert('Registrasi berhasil!');
        window.location='login_page.php';
    </script>";

}
?>