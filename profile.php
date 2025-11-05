<?php
session_start();
include 'config.php'; // pastikan file ini benar dan koneksi $conn aktif

// Ambil ID user dari session (misalnya diset saat login)
$id_user = $_SESSION['id_user'] ?? null;

// Jika user sudah login, ambil datanya
if ($id_user) {
    $query = mysqli_query($conn, "SELECT nama, email, alamat, no_hp, tanggal_lahir FROM users WHERE id_user = '$id_user'");
    $user = mysqli_fetch_assoc($query);
} else {
    // Jika belum login, isi nilai default biar tidak error
    $user = [
        'nama' => '',
        'email' => '',
        'alamat' => '',
        'no_hp' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya</title>
    <link rel="stylesheet" href="assets/css/profile.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header class="navbar">
      <button class="back-btn">←</button>
      <h1>Profil Saya</h1>
      <button class="logout-btn">⎋</button>
    </header>

    <main class="container">
      <!-- Profil Atas -->
      <section class="profile-card">
        <div class="profile-header">
          <div class="profile-icon">
            <img src="assets/img/default-user.png" alt="Foto Profil Pengguna">
          </div>
          <div>
            <h2><?= htmlspecialchars($user['nama']); ?></h2>
            <p><?= htmlspecialchars($user['email']); ?></p>
          </div>
          <button class="btn-save" form="formProfile">SIMPAN</button>
        </div>

        <div class="stats">
          <div class="stat-box blue">
            <div class="icon">⭐</div>
            <h3>120</h3>
            <p>Total Setor</p>
          </div>
          <div class="stat-box green">
            <div class="icon">⚖️</div>
            <h3>50Kg</h3>
            <p>Total Berat</p>
          </div>
          <div class="stat-box yellow">
            <div class="icon">🪙</div>
            <h3>2.500</h3>
            <p>Total Poin</p>
          </div>
          <div class="stat-box purple">
            <div class="icon">🏆</div>
            <h3>5</h3>
            <p>Pencapaian</p>
          </div>
        </div>
      </section>

      <!-- Info Profil -->
      <section class="info-card">
        <h2 class="info-title">👤 Info Profil</h2>

        <form id="formProfile" action="update_profile.php" method="POST">
          <div class="info-grid">
            <div class="info-item">
              <label>Nama Lengkap</label>
              <input
                type="text"
                name="nama"
                value="<?= htmlspecialchars($user['nama']); ?>"
                placeholder="Masukkan nama lengkap"
              />
            </div>

            <div class="info-item">
              <label>Email</label>
              <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($user['email']); ?>"
                placeholder="Masukkan email"
              />
            </div>

            <div class="info-item">
              <label>No. Telepon</label>
              <input
                type="text"
                name="no_hp"
                value="<?= htmlspecialchars($user['no_hp']); ?>"
                placeholder="Masukkan nomor telepon"
              />
            </div>

            <div class="info-item">
               <label>Tanggal Lahir</label>
               <input
                type="date"
                name="tanggal_lahir"
                value="<?= htmlspecialchars($user['tanggal_lahir'] ?? ''); ?>"
                />
            </div>


            <div class="info-item full">
              <label>Alamat</label>
              <textarea
                name="alamat"
                placeholder="Masukkan alamat lengkap"
              ><?= htmlspecialchars($user['alamat']); ?></textarea>
            </div>
          </div>
        </form>
      </section>
    </main>
  </body>
</html>
