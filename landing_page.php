<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Organify</title>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Mingzat&family=Mitr:wght@200;300;400;500;600;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!-- LEAFLET MAP -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Mitr";
}
body {
  background-color: #f3f5f2;
  color: #333;
}

/* HERO SECTION */
.hero {
  background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('assets/img/welcome.jpg') center/cover no-repeat;
  height: 60vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: white;
  position: relative;
}
.hero h1 {
  font-size: 5rem;
  z-index: 2;
  font-weight: 500;
}
.hero p {
  z-index: 2;
  max-width: 600px;
  font-size: 1rem;
  margin-top: 10px;
  font-family: "Mingzat";
}

.user-logo {
  position: absolute;
  width: 50px; /* ukuran logo */
  height: 50px;
  top: 30px; /* jarak dari atas hero */
  right: 30px; /* jarak dari kanan */
  border-radius: 50%; /* biar bulat */
  object-fit: cover; /* agar proporsional */
  cursor: pointer; /* opsional, biar terlihat klikable */
  z-index: 10; /* biar di atas elemen lain */
}

/* SEARCH BOX */
.search-box {
  background: #E1EFE0;
  width: 600px;
  height: 100px;
  border-radius: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  margin: -50px auto 10px auto;
  position: relative;
  z-index: 10;
}
.search-box input {
  padding: 18px 25px;
  width: 400px;
  background: white;
  border: none;
  outline: none;
  border-radius: 50px;
  font-size: 1rem;
}
.search-box button {
  background-color: #124d25;
  color: white;
  padding: 18px 35px;
  border-radius: 50px;
  border: none;
  font-size: 1rem;
  cursor: pointer;
}

/* MAP */
#map {
  width: 90%;
  height: 450px;
  margin: 20px auto;
  border-radius: 15px;
  overflow: hidden;
  background-color: #d9d9d9;
}

/* BUTTON SETOR */
.btn-setor {
  display: block;
  width: 90%;
  margin: 0 auto 30px auto;
  background-color: #124d25;
  color: white;
  text-align: center;
  padding: 15px;
  border-radius: 30px;
  font-weight: 500;
  font-size: 18px;
  transition: transform 0.5s ease;
}

.btn-setor:hover {
  transform: scale(1.04);
}

/* STATS */
.stats {
  background: white;
  width: 90%;
  margin: 0 auto 20px;
  padding: 20px;
  border-radius: 15px;
}

.stats h3{
  font-weight: 500;
}

.stats h2{
  text-align: center;
  font-weight: 600;
  font-size: 30px;
}

.stats-container {
  display: flex;
  justify-content: space-around;
  gap: 20px;
}

/* ACTIVITY */
.activity {
  background: white;
  width: 90%;
  margin: 0 auto 20px;
  padding: 20px;
  border-radius: 15px;
}

.activity h3{
  font-weight: 500;
}

.activity-item b{
  font-weight: 400;
}
.activity-item {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid #eee;
  padding: 10px 0;
}
.activity-item:last-child {
  border-bottom: none;
  color: #3c3c3c;
}

.lihat-semua{
  text-align: center;
  color: #0a4d1b;
  text-decoration: none;
  margin-top: 15px;
  display: block;
}

/* REWARD */
.reward {
  background: linear-gradient(to right, #1b8f3a, #0a4d1b);
  color: white;
  border-radius: 15px;
  width: 90%;
  margin: 20px auto;
  padding: 20px;
}

.reward h4{
  font-weight: 500;
}
.reward-content {
  display: flex;
  justify-content: space-around;
  gap: 15px;
}

.reward-content h2{
  font-weight: 500;
  text-align: center;
}

.reward-content p{
  text-align: center;
}

/* TUTORIAL */
.tutorial {
  background: #eef5ee;
  width: 90%;
  margin: 30px auto;
  padding: 20px;
  border-radius: 15px;
}

.tutorial h2{
  font-weight: 500;
}
.step {
  display: flex;
  align-items: center;
  background: white;
  margin: 10px 0;
  padding: 15px;
  border-radius: 10px;
  gap: 15px;
}
.step-num {
  width: 30px;
  height: 30px;
  background: #124d25;
  color: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 400;
}

.step b{
  font-weight: 500;
}

@media (max-width: 600px) {
  .hero h1 { font-size: 2rem; }
  .hero p { font-size: 0.85rem; padding: 0 10px; }
  .search-box input { width: 70%; }
}
</style>

</head>
<body>

<!-- HERO -->
<section class="hero">
  <h1>ORGANIFY</h1>
  <p>Langkah kecilmu mengelola sampah bisa membawa dampak besar — termasuk untuk dompetmu.</p>

  <img src="assets/img/user icon.png" alt="User" class="user-logo">
</section>

<!-- SEARCH -->
<div class="search-box">
  <input type="text" id="search" placeholder="🔍 Bank Sampah Terdekat" />
  <button id="btn-search">Tampilkan</button>
</div>

<!-- MAP -->
<div id="map"></div>

<!-- BUTTON SETOR -->
<div class="btn-setor">♻️ SETOR SAMPAH</div>

<!-- STATS -->
<section class="stats">
  <h3>Statistik Hari Ini</h3>
  <div class="stats-container">
    <div class="stat">
      <h2 style="color:#0C8712;">12</h2>
      <p>Bank Sampah</p>
    </div>
    <div class="stat">
      <h2 style="color:#2C5CC5;">15Kg</h2>
      <p>Total Sampah</p>
    </div>
  </div>
</section>

<!-- ACTIVITY -->
<section class="activity">
  <h3>Aktivitas Terbaru</h3>

  <div class="activity-item">
    <div><b>Setor Sampah Sisa Makanan</b><br><small>5 jam yang lalu</small></div>
    <span style="color:#124d25;">+100</span>
  </div>

  <div class="activity-item">
    <div><b>Setor Sampah Sisa Buah dan Sayur</b><br><small>2 hari yang lalu</small></div>
    <span style="color:#124d25;">+240</span>
  </div>

  <div class="activity-item">
    <div><b>Setor Sampah Daun Pertanian</b><br><small>1 minggu yang lalu</small></div>
    <span style="color:#124d25;">+3000</span>
  </div>

  <a href="#" class="lihat-semua">LIHAT SEMUA</a>
</section>

<!-- REWARD -->
<section class="reward">
  <h4>Reward Poin</h4>
  <div class="reward-content">
    <div><h2>12Kg</h2><p>Sampah Organik</p></div>
    <div><h2>100</h2><p>Poin</p></div>
  </div>
</section>

<!-- TUTORIAL -->
<section class="tutorial">
  <h2>TUTORIAL</h2>
  <small>4 langkah mudah untuk mulai kontribusi Anda!</small>

  <div class="step"><div class="step-num">1</div><div><b>Cari Lokasi</b><br><small>Temukan bank sampah terdekat</small></div></div>
  <div class="step"><div class="step-num">2</div><div><b>Setor Sampah</b><br><small>Bawa sampah organik</small></div></div>
  <div class="step"><div class="step-num">3</div><div><b>Dapat Poin</b><br><small>Dapatkan poin reward</small></div></div>
  <div class="step"><div class="step-num">4</div><div><b>Tukar Poin</b><br><small>Tukarkan poin ke e-wallet</small></div></div>
</section>

<!-- ============================= -->
<!-- ✅ DATA BANK SAMPAH -->
<!-- ============================= -->
<script>
const bankSampahData = [
  {
    nama_bank: "Bank Sampah Karya Mandiri",
    alamat: "Jl. Pulau Kawe No.10",
    kota_kabupaten: "Denpasar",
    kontak: "08123456789",
    latitude: -8.665,
    longitude: 115.216
  },
  {
    nama_bank: "Bank Sampah Hijau Lestari",
    alamat: "Jl. Mertanadi No. 88",
    kota_kabupaten: "Badung",
    kontak: "08123999123",
    latitude: -8.67,
    longitude: 115.19
  }
];
</script>

<!-- ============================= -->
<!-- ✅ MAP SCRIPT -->
<!-- ============================= -->
<script>
// Inisialisasi Map
const map = L.map("map").setView([-8.65, 115.22], 12);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

const markers = [];

bankSampahData.forEach((bank) => {
  const googleMapsLink = `https://www.google.com/maps/dir/?api=1&destination=${bank.latitude},${bank.longitude}`;

  const marker = L.marker([bank.latitude, bank.longitude]).addTo(map)
  .bindPopup(`
    <b>${bank.nama_bank}</b><br>
    ${bank.alamat}<br>
    ${bank.kota_kabupaten}<br>
    <a href="${googleMapsLink}" target="_blank" style="color:#1553a3;font-weight:bold;">Petunjuk Arah</a>
  `);

  markers.push({ marker, bank });
});

// SEARCH
function searchBank() {
  const keyword = document.getElementById("search").value.toLowerCase().trim();
  if (!keyword) return alert("Ketik alamat atau kota/kabupaten");

  const found = markers.filter(
    (m) =>
      m.bank.alamat.toLowerCase().includes(keyword) ||
      m.bank.kota_kabupaten.toLowerCase().includes(keyword)
  );

  if (found.length === 0) return alert("Tidak ditemukan.");

  const group = new L.featureGroup(found.map(m => m.marker));
  map.fitBounds(group.getBounds().pad(0.2));

  found.forEach(m => m.marker.openPopup());
}

// Button & Enter Event
document.getElementById("btn-search").addEventListener("click", searchBank);
document.getElementById("search").addEventListener("keydown", e => {
  if (e.key === "Enter") searchBank();
});

// Zoom ke semua marker awal
if (markers.length > 0) {
  const group = new L.featureGroup(markers.map(m => m.marker));
  map.fitBounds(group.getBounds().pad(0.2));
}
</script>

</body>
</html>
