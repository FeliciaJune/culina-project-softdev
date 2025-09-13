<?php
session_start();
include "koneksi.php";

// ambil semua nama kategori dari tabel 'kategori'
$kategori_result = $conn->query("SELECT namakategori FROM kategori");

// ambil semua nama kategori dari tabel 'kategori'
$rekomendasi_result = $conn->query("SELECT foto, namaresep FROM rekomendasi");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Explore</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
    }

    .nav {
      position: absolute;
      top: 10px;
      right: 30px;
      display: flex;
      gap: 40px;
      align-items: center;
      font-size: 24px;
      font-weight: 300;
    }

    .nav-link.active {
      font-weight: 500;
    }

    .nav-link.active,
    .nav-link:hover {
      border-bottom: 3px solid #FF8C00;
      color: black;
    }

    .logo {
      position: absolute;
      top: 16px;
      left: 37px;
      font-size: 28px;
      font-weight: 600;
      color: black;
    }

    .fa-magnifying-glass {
      margin-right: 8px;
    }

  
    .main-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 40px;
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .left-box {
      flex: 1 1 300px;
      margin: 0;
    }

    .orange-box {
      background-color: #FF8C00;
      color: white;
      padding: 40px;
      font-size: 30px;
      font-weight: 600;
      box-shadow: 5px 5px 10px #888;
      width: 500px;
      margin: 0;
    }

    .orange-box div {
      font-size: 50px;
    }

    .orange-box p {
      font-size: 16px;
      font-weight: 300;
      margin-top: 10px;
    }

    .right-box {
      flex: 1 1 300px;
      padding-right: 40px;
    }

    .category-title {
      margin-bottom: 8px;
      font-size: 24px;
      margin-top: 80px;
    }

    .categories {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin-top: 20px;
    }

    .categories button {
      background-color: #FF8C00;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      font-weight: 500;
      font-size: 20px;
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    .categories button:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.3);
      cursor: pointer;
    }

    .recommended-section {
      padding: 20px 40px;
    }

    .recommended-section h4 {
      margin-bottom: 20px;
      font-size: 24px;
    }

    .recommended-row {
      display: flex;
      flex-wrap: nowrap;
      gap: 20px;
      overflow-x: auto;
      padding-bottom: 10px;
    }

    .recipe-link {
      flex: 0 0 auto;
      text-decoration: none;
      color: black;
    }

    .recipe-card {
      text-align: center;
      transition: transform 0.3s ease;
      width: 280px;
    }

    .recipe-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    .recipe-card h5 {
      margin-top: 10px;
      font-weight: 600;
      font-size: 20px;
    }

    .recipe-card:hover {
      transform: scale(1.05);
    }

    a {
      text-decoration: none !important;
      color: black !important;
      font-size: 20px;
    }

    a:hover,
    a:focus,
    a:visited {
      text-decoration: none !important;
      color: black !important;
    }
  </style>
</head>
<body>

<?php include("headersearch.php"); ?>

<div class="main-content">
  <div class="left-box">
    <div class="orange-box">
      <div>Food <br>Collections</div>
      <p>Check our variety of food <br> recipes!</p>
    </div>
  </div>
  <div class="right-box">
    <h4 class="category-title"><strong>Categories</strong></h4>
    <div class="categories">
      <?php while ($row = $kategori_result->fetch_assoc()): ?>
        <!-- tombol kategori yang mengarah ke file php sesuai nama kategori -->
        <a href="<?= htmlspecialchars($row['namakategori']) ?>.php">
          <button><?= htmlspecialchars($row['namakategori']) ?></button>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<div class="recommended-section">
  <h4><strong>Recommended Recipes</strong></h4>
  <div class="recommended-row">
    <?php while ($row = $rekomendasi_result->fetch_assoc()): ?>
      <a href="<?= htmlspecialchars($row['namaresep']) ?>.php" class="recipe-link">
        <div class="recipe-card">
          <img src="images/<?= htmlspecialchars($row['foto']) ?>" alt="<?= htmlspecialchars($row['namaresep']) ?>">
          <h5><?= htmlspecialchars($row['namaresep']) ?></h5>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
