<?php
session_start();
include 'config.php'; // file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email terdaftar
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan data penting ke session
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];

            // Arahkan ke halaman profil
            header("Location: profile.php");
            exit;
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
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
    .left p { font-size: 16px; line-height: 1.6; color: #ddd; font-family: 'Mingzat'; }

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
      font-size: 16px; cursor: pointer; border-radius: 4px; align-self: center;
    }
    .btn:hover { background: #009900; }

    .right a { text-align: center; color: #4CAF50; text-decoration: none; padding-top: 15px; }
    .forgot-password { text-align: center; margin-top: 10px; font-size: 14px; font-family: 'Mingzat'; }
    .forgot-password a:hover { text-decoration: underline; }

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
      <p>Yuk lanjutkan aksi baikmu untuk bumi — masih banyak reward seru menantimu!</p>
    </div>

    <div class="right">
      <h2>Log In</h2>
      <form action="POST" action="">
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="password" name="password" placeholder="Your Password" required />
        <button type="submit" class="btn">Log In</button>
      </form>
      <a href="register.php">or Sign Up</a>
      <p class="forgot-password">Forgot Password?</p>
    </div>
  </div>
</body>
</html>
