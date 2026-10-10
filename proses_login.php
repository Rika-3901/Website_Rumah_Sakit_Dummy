<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,
"SELECT * FROM users
WHERE username='$username'
AND password='$password'");

if(mysqli_num_rows($query) > 0){

    $data = mysqli_fetch_assoc($query);

    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama']    = $data['nama'];
    $_SESSION['role']    = $data['role'];

    if($data['role']=="admin"){

        header("Location: dashboard.php");

    }else{

        header("Location: beranda.php");

    }

    exit();

}else{

    echo "<script>
        alert('Username atau Password salah!');
        window.location='login_page.php';
    </script>";

}
?>