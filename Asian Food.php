<?php
session_start();
include "koneksi.php";

$selected_kategori = $_GET['namakategori'] ?? 'Asian Food';

$kategori_result = $conn->query("SELECT DISTINCT namakategori FROM resep");

$stmt = $conn->prepare("SELECT foto, namaresep FROM resep WHERE namakategori = ?");
$stmt->bind_param("s", $selected_kategori);
$stmt->execute();
$recipes_result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Explore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
      padding: 20px;
    }

    .logo {
      font-size: 28px;
      font-weight: 600;
      color: black;
      position: absolute;
      top: 16px;
      left: 37px;
    }

    .nav {
      position: absolute;
      top: 5px;
      right: 30px;
      display: flex;
      gap: 40px;
      align-items: center;
      font-size: 24px;
      font-weight: 300;
    }

    .nav-bar {
      padding-top:-20px;
    }

    .nav-link.active,
    .nav-link:hover {
      border-bottom: 3px solid #FF8C00;
      color: black;
    }

    .category-title {
      font-size: 70px;
      font-weight: 600;
    }

    .category-button {
      background-color: #FF8C00;
      color: white;
      border: none;
      padding: 12px 90px;
      font-size: 18px;
      font-weight: 500;
      border-radius: 8px;
      margin: 10px 40px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .recipes-title {
      font-size: 28px;
      font-weight: 600;
      margin-top: 50px;
      margin-bottom: 30px;
    }

    a {
  text-decoration: none !important;
  color: black !important;
}

a:hover,
a:focus,
a:visited {
  text-decoration: none !important;
  color: black !important;
}


.recipe-card {
  text-align: center;
  margin-bottom: 40px;
  transition: transform 0.3s ease;
  color: black;
  width: 350px; 
}

.recipe-card:hover {
  transform: scale(1.05);
}

.recipe-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  transition: transform 0.3s ease;
}

.recipe-card h5 {
  margin-top: 12px;
  font-weight: 600;
  color: black;
}

.recipe-scroll {
  display: flex;
  gap: 30px;
  flex-wrap: nowrap;
  overflow-x: auto;
  padding: 10px;
}

.recipe-link {
  flex: 0 0 auto;
  width: auto; 
  text-decoration: none;
  color: black;
}




  </style>
</head>
<body>


<?php include("headersearch.php"); ?>


<div class="text-start ps-3">
  <h2 class="category-title">Categories</h2>
    <button class="category-button">Asian Food</button>
</div>


<div class="px-4">
  <h4 class="recipes-title">Recipes</h4>
  <div class="recipe-scroll">
    <?php while ($row = $recipes_result->fetch_assoc()): ?>
      <a href="<?= ($row['namaresep']) ?>.php" class="recipe-link">
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
