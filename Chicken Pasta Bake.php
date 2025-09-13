<?php
session_start();
include "koneksi.php";

$idresep = $_GET['idresep'] ?? 2;
// ambil data resep dengan id resep 2

$stmt = $conn->prepare("SELECT * FROM resep WHERE idresep = ?");
$stmt->bind_param("i", $idresep);
$stmt->execute();
$result = $stmt->get_result();
$resep = $result->fetch_assoc();

// tanganin form POST sebelum query hari
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $hari = $_POST['hari']; // ambil nama hari yang dipilih user dari dropdown
    //  ambil data resep dari hasil query sebelumnya
    $id = $resep['idresep'];
    $nama = $resep['namaresep'];
    $kategori = $resep['namakategori'];
    $foto = $resep['foto'];

    // cek kalo udah ada resep di hari itu
    $check = $conn->prepare("SELECT COUNT(*) as count FROM mealplan WHERE hari = ?");
    $check->bind_param("s", $hari);
    $check->execute();
    $checkResult = $check->get_result()->fetch_assoc();

    // kalo belum ada bisa insert data resep ke hari itu
    if ($checkResult['count'] == 0) {
        $stmt = $conn->prepare("INSERT INTO mealplan (hari, idresep, namaresep, namakategori, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $hari, $id, $nama, $kategori, $foto);
        $stmt->execute();
        $_SESSION['message'] = "Recipe added to $hari";
    } else {
      // kalo udah ada resep di hari itu ditampilin pesan error
        $_SESSION['message'] = "A recipe already exists for $hari. Please choose another day.";
    }
    // refresh balik ke halaman resep
    header("Location: Chicken Pasta Bake.php?idresep=$idresep");
    exit();
}

// hari tersedia
$alldays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$useddays = $conn->query("SELECT hari FROM mealplan"); // ambil semua hari yang udah ada di mealplan
$used = [];
while ($row = $useddays->fetch_assoc()) {
    $used[] = $row['hari'];
}
$availabledays = array_diff($alldays, $used); // cari hari2 yang masih kosong buat ditampilin
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($resep['namaresep']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
      padding: 0;
    }

    .hero {
      position: relative;
      height: 300px;
      color: black;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 30px;
      overflow: hidden;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('images/<?= htmlspecialchars($resep['foto']) ?>') no-repeat center center/cover;
      opacity: 45%;
      z-index: 0;
    }

    .hero h1, .hero p, .btn-mealplan {
      position: relative;
      z-index: 1;
    }

    .hero h1 {
      font-size: 80px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 18px;
      font-weight: 500 !important;
      max-width: 700px;
    }

    .btn-mealplan {
      background-color: #FF8C00;
      color: white;
      padding: 15px 40px;
      border: none;
      border-radius: 8px;
      position: absolute;
      top: 130px;
      right: 150px;
      z-index: 1;
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    .btn-mealplan:hover {
      transform: translateY(-5px); 
      box-shadow: 0 8px 15px rgba(0,0,0,0.3);
      background-color: #FF8C00; 
      cursor: pointer;
    }

    .content-section {
      background-color: #FF8C00;
      padding: 30px;
    }

    .duration {
      font-size: 20px;
      font-weight: 600;
      color: white;
      margin-bottom: 20px;
    }

    .duration i {
      margin-left: 10px;
    }

    .ingredients-box {
      border-radius: 20px;
      background-color: #FFF9DA;
      padding: 15px 10px;
      font-size: 14px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.4);
    }

    .nutrition-box {
      background-color: white;
      width: 280px;
      padding: 15px 10px;
      font-size: 14px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.4);
    }

    .ingredients-box h5 {
      font-weight: 700;
      font-size: 40px;
      margin-bottom: 10px;
      padding-left: 25px;
    }

    .nutrition-box h5 {
      font-weight: 600;
      font-size: 30px;
      margin-bottom: 10px;
      text-align: center;
    }

    .method {
      padding: 30px;
      font-size: 16px;
      background-color: #FF8C00;
      color: white;
    }

    .method h4 {
      font-weight: 600;
      margin-bottom: 15px;
      padding-left: 20px;
    }

    .method pre {
      white-space: pre-wrap;
      font-size: 14px;
      color: white;
    }

    pre {
      white-space: pre-wrap;
      font-family: 'Poppins', sans-serif !important;
      margin-left: 20px !important;
      font-size: 16px;
      color: #000;
    }

    form select {
      z-index: 2;
      position: relative;
    }
  </style>
</head>
<body>

<?php include("headersearch2.php"); ?>

<?php if (!empty($_SESSION['message'])): ?>
  <script>alert("<?= $_SESSION['message'] ?>");</script>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="hero">
  <h1><?= htmlspecialchars($resep['namaresep']) ?></h1>
  <p><?= htmlspecialchars($resep['deskripsi']) ?></p>

  <form method="POST" style="position: absolute; top: 170px; right: 100px; display: flex; align-items: center; gap: 10px; z-index: 2;">
    <select name="hari" class="form-select w-auto" style="height: 48px;" required>
      <option value="">Choose a day</option>
      <?php foreach ($availabledays as $day): ?>
        <option value="<?= $day ?>"><?= $day ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="add" class="btn-mealplan" style="position: static;">Add to Meal Plan</button>
  </form>
</div>

<div class="content-section">
  <div class="duration">
    Cooking Duration: <?= htmlspecialchars($resep['durasi']) ?> <i class="fas fa-clock"></i>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="ingredients-box">
        <h5>Ingredients</h5>
        <pre><?= htmlspecialchars($resep['bahan']) ?></pre>
      </div>
    </div>
    <div class="col-md-6">
      <div class="nutrition-box">
        <h5><strong>Nutrition Facts</strong></h5>
        <pre><?= htmlspecialchars($resep['nutrisi']) ?></pre>
      </div>
    </div>
  </div>
</div>

<div class="method">
  <h4>Method</h4>
  <pre><?= htmlspecialchars($resep['steps']) ?></pre>
</div>

</body>
</html>
