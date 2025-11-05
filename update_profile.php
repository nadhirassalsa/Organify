<?php
session_start();
include 'config.php';

// Ambil id user dari session
$id_user = $_SESSION['id_user'] ?? null;

if ($id_user) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $query = "UPDATE users SET 
                nama='$nama', 
                email='$email', 
                no_hp='$no_hp', 
                alamat='$alamat',
                tanggal_lahir='$tanggal_lahir'
              WHERE id_user='$id_user'";

    if (mysqli_query($conn, $query)) {
        header("Location: profile.php?status=success");
    } else {
        echo "Gagal memperbarui profil: " . mysqli_error($conn);
    }
} else {
    echo "Session tidak ditemukan. Silakan login kembali.";
}
?>
