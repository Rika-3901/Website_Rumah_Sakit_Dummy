<?php
// Memulai session
session_start();

// Menghapus semua data session
session_unset();

// Menghancurkan session yang aktif
session_destroy();

// Mengarahkan kembali ke halaman login (sesuaikan nama file login kamu, misal: login.php atau index.php)
echo "<script>
    alert('Anda telah berhasil logout');
    window.location='login_page.php'; 
</script>";
exit;
?>