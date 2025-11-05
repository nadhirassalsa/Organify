<?php
include 'config.php'; // pastikan file koneksi kamu benar dan $conn aktif

// Jalankan hanya kalau form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi kosong
    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Harap isi semua kolom!');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Password tidak cocok!');</script>";
    } else {
        // Cek apakah email sudah terdaftar
        $cekEmail = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        if (mysqli_num_rows($cekEmail) > 0) {
            echo "<script>alert('Email sudah terdaftar, silakan gunakan email lain!');</script>";
        } else {
            // Hash password biar aman
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user baru
            $query = "
                INSERT INTO user (nama, email, password, total_setor, total_berat, total_poin) 
                VALUES ('$nama', '$email', '$hashedPassword', 0, 0, 0)
            ";
            if (mysqli_query($conn, $query)) {
                echo "<script>
                        alert('Registrasi berhasil! Silakan login.');
                        window.location.href='login.php';
                      </script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat registrasi.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&family=Mingzat&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Mitr'; }
    body {
      background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), 
                  url('assets/img/welcome.jpg') no-repeat center center/cover;
      min-height: 100vh;
      display: flex; justify-content: center; align-items: center;
    }
    .container {
      width: 90%; max-width: 1000px; display: flex;
      background: rgba(0, 0, 0, 0.6); color: #fff;
      border-radius: 10px; overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    }
    .left {
      flex: 1; padding: 60px 40px; display: flex; flex-direction: column; justify-content: center;
      background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), 
                  url('assets/img/welcome.jpg') center center/cover;
    }
    .left h1 { font-size: 40px; font-weight: 500; }
    .left p { font-size: 16px; color: #ddd; line-height: 1.6; font-family: 'Mingzat'; }
    .right {
      flex: 1; background: rgba(0,0,0,0.5);
      padding: 60px 40px; display: flex; flex-direction: column; justify-content: center;
    }
    .right h2 { font-weight: 500; margin-bottom: 30px; font-size: 28px; }
    form { display: flex; flex-direction: column; gap: 20px; }
    input {
      background: transparent; border: none; border-bottom: 1px solid #ccc;
      padding: 10px; color: white; font-size: 14px; outline: none; font-family: 'Mingzat';
    }
    input::placeholder { color: #aaa; }
    input:focus { border-color: #4CAF50; }
    .btn {
      background: #006400; border: none; padding: 8px 40px; color: white;
      font-size: 16px; border-radius: 4px; cursor: pointer; align-self: center;
    }
    .btn:hover { background: #009900; }
    .login-link { text-align: center; margin-top: 10px; font-size: 14px; font-family: 'Mingzat'; }
    .login-link a { color: #4CAF50; text-decoration: none; }
    .login-link a:hover { text-decoration: underline; }
    @media (max-width: 768px) {
      .container { flex-direction: column; }
      .left, .right { text-align: center; padding: 40px 20px; }
      form { align-items: center; }
      input, .btn { width: 100%; max-width: 300px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <h1>Let’s Get Started</h1>
      <p>Mulai langkah kecilmu bersama kami untuk jaga bumi → jadi pahlawan lingkungan sambil cuan!</p>
    </div>

    <div class="right">
      <h2>Sign Up</h2>
      <form method="POST" action="">
        <input type="text" name="nama" placeholder="Your Name..." required />
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="password" name="password" placeholder="Create Password" required />
        <input type="password" name="confirm_password" placeholder="Repeat Your Password" required />
        <button type="submit" class="btn">Sign Up</button>
      </form>
      <p class="login-link">Already Have An Account? <a href="login.php">Login Here</a></p>
    </div>
  </div>
</body>
</html>
