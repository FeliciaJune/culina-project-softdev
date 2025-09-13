<?php
include "koneksi.php";

// mengambil data dari parameter GET 'search' jika ada, atau kosong jika tidak ada
$search = $_GET['search'] ?? '';

// menyiapkan array kosong untuk menyimpan hasil pencarian resep
$recipes = [];

// kalo input pencarian tidak kosong, jalankan query pencarian
if (!empty($search)) {
    // menambahkan wildcard % untuk digunakan dalam LIKE query
    $search = "%$search%";

    // menyiapkan statement SQL untuk mencari kecocokan pada berbagai kolom
    $stmt = $conn->prepare("
        SELECT idresep, namaresep, foto 
        FROM resep 
        WHERE namaresep LIKE ? 
        OR namakategori LIKE ? 
        OR durasi LIKE ?
        OR bahan LIKE ?
        OR steps LIKE ?
        OR nutrisi LIKE ?
    ");

    // mengikat parameter ke dalam statement (semua berupa string)
    $stmt->bind_param("ssssss", $search, $search, $search, $search, $search, $search);

    // menjalankan query
    $stmt->execute();

    // mengambil hasil query
    $result = $stmt->get_result();
    
    // menyimpan hasil ke array $recipes
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Results</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #FCF5C7;
      padding: 40px;
    }

    h1 {
      font-size: 50px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    h2 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    h3 {
        font-size: 40px;
        text-align: center;
        margin-top: 90px;
        color: #FF8C00;
    }

    h4 {
        font-size: 30px;
        text-align: center;
        color: #FF8C00;
        margin-top: 0px;
    }

    .recipes {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card {
      background-color:  #FF8C00;
      border-radius: 12px;
      overflow: hidden;
      width: 220px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
      transform: translateY(-5px); 
      box-shadow: 0 8px 15px rgba(0,0,0,0.3);
      transition: transform 0.2s ease;
      cursor: pointer;
    }

    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .card .title {
      background-color: #FF8C00;
      color: white;
      font-weight: 600;
      text-align: center;
      padding: 10px 10px 17px 10px;
      font-size: 16px;
    }
  </style>
</head>
<body>

<!-- menyertakan file header (biasanya berisi navigasi & search bar) -->
<?php include("headersearch3.php"); ?>

<!-- nampilin judul hasil pencarian dengan kata kunci yang dimasukkan -->
<h1>Search Results for "<?= htmlspecialchars($_GET['search'] ?? '') ?>"</h1>

<?php if (!empty($recipes)): ?>
  <!-- kalo ditemukan hasil pencarian, tampilkan daftar resep -->
  <h2>Recipes</h2>
  <div class="recipes">
    <?php foreach ($recipes as $row): ?>
      <!-- semua resep ditampilkan dalam bentuk card dengan link ke halaman resep -->
      <a href="<?= htmlspecialchars($row['namaresep']) ?>.php" style="text-decoration: none;">
        <div class="card">
          <img src="images/<?= htmlspecialchars($row['foto']) ?>" alt="<?= htmlspecialchars($row['namaresep']) ?>">
          <div class="title"><?= htmlspecialchars($row['namaresep']) ?></div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <!-- kalo tidak ada hasil ditemukan -->
  <h3>Oh no!<br></h3>
  <h4>There are no recipes found matching your search...</h4>
<?php endif; ?>

</body>
</html>
