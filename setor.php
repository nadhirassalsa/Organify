<?php
session_start();
include 'config.php';

// Pastikan user udah login
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

// Cek apakah form disubmit
if (isset($_POST['submit'])) {
  $jenis_sampah = $_POST['jenis_sampah'];
  $berat = $_POST['berat'];
  $bank = $_POST['bank'];
  $poin = $berat * 50;

  // Simpan ke tabel setoran
  $insert = mysqli_query($conn, "INSERT INTO setoran (id_user, jenis_sampah, berat, bank, poin) 
                                 VALUES ('$id_user', '$jenis_sampah', '$berat', '$bank', '$poin')");

  // Update total di tabel users
  if ($insert) {
    mysqli_query($conn, "
      UPDATE users 
      SET total_setor = total_setor + 1,
          total_berat = total_berat + '$berat',
          total_poin = total_poin + '$poin'
      WHERE id_user = '$id_user'
    ");
    header("Location: profile.php");
    exit();
  } else {
    echo "<script>alert('Gagal menyimpan data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setor Sampah Organik</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500;600&family=Mingzat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/setor.css" />
  </head>

  <body>
    <!-- HERO SECTION -->
    <header class="hero">
      <a href="landing_page.php" class="back-btn">←</a>
      <div class="hero-text">
        <h1>Setor Sampah Organik</h1>
        <p>Setorkan sampahmu sekarang dan raih hadiahnya.</p>
      </div>
    </header>

    <!-- MAIN SECTION -->
    <main class="container">
      <form action="" method="POST" enctype="multipart/form-data">
        <h2>Pilih jenis sampah organik</h2>

        <div class="waste-grid">
          <div class="waste-card red" onclick="selectWaste(this, 'Sampah Sisa Makanan')">
            <img src="assets/img/sampah1.jpg" alt="Sampah Sisa Makanan" />
            <p>Sampah Sisa Makanan</p>
          </div>

          <div class="waste-card green" onclick="selectWaste(this, 'Sampah Sisa Buah & Sayur')">
            <img src="assets/img/sampah2.jpg" alt="Sampah Sisa Buah dan Sayur" />
            <p>Sampah Sisa Buah & Sayur</p>
          </div>

          <div class="waste-card yellow" onclick="selectWaste(this, 'Sampah Hewani')">
            <img src="assets/img/sampah3.jpg" alt="Sampah Hewani" />
            <p>Sampah Hewani</p>
          </div>

          <div class="waste-card pink" onclick="selectWaste(this, 'Sampah Pertanian')">
            <img src="assets/img/sampah4.jpg" alt="Sampah Pertanian" />
            <p>Sampah Pertanian</p>
          </div>

          <div class="waste-card cyan" onclick="selectWaste(this, 'Sampah Kotoran Hewan')">
            <img src="assets/img/sampah5.jpg" alt="Sampah Kotoran Hewan" />
            <p>Sampah Kotoran Hewan</p>
          </div>

          <div class="waste-card purple" onclick="selectWaste(this, 'Sampah Daun & Ranting Kering')">
            <img src="assets/img/sampah6.jpg" alt="Sampah Daun dan Ranting Kering" />
            <p>Sampah Daun & Ranting Kering</p>
          </div>
        </div>

        <!-- input tersembunyi untuk kirim jenis sampah ke PHP -->
        <input type="hidden" name="jenis_sampah" id="jenis_sampah" required>

        <label for="berat">Berat Sampah (kg)</label>
        <input type="number" id="berat" name="berat" placeholder="0.0" min="0" step="0.1" required />

        <label for="bank">Pilih bank sampah terdekat</label>
        <select id="bank" name="bank" required>
          <option value="">-- Pilih Bank Sampah --</option>
          <option>Bank Sampah Hijau Segar - Jl. Kampus Udayana XI No. 20</option>
          <option>Bank Sampah Citra Bersih - Jl. Melati No. 15</option>
          <option>Bank Sampah Harapan Lestari - Jl. Kenanga No. 9</option>
        </select>

        <label for="foto">Upload Foto</label>
        <div class="upload-box">
          <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" />
          <div class="upload-placeholder">
            <div class="circle">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#555" viewBox="0 0 24 24">
                <path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm8-3h-2.586l-1.707-1.707A1 1 0 0 0 15 4h-6a1 1 0 0 0-.707.293L6.586 6H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm0 12H4V8h3.586l1.707-1.707L10 6h4l0.707.293L16.414 8H20v10Z"/>
              </svg>
            </div>
            <p>Klik untuk upload foto sampah</p>
            <small>Format: JPG, JPEG, PNG (Max. 5MB)</small>
          </div>
        </div>

        <button type="submit" name="submit" class="submit-btn">SETOR</button>
      </form>
    </main>

    <!-- SCRIPT -->
    <script>
      function selectWaste(el, value) {
        document.querySelectorAll(".waste-card").forEach(card => card.classList.remove("active"));
        el.classList.add("active");
        document.getElementById("jenis_sampah").value = value;
      }
    </script>
  </body>
</html>
