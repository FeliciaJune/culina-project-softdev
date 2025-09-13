<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $idresep = $_POST['id'];

        if (empty($_POST['newday'])) {
            $_SESSION['message'] = "Please select a day to move the recipe.";
            header("Location: editmealplan.php");
            exit();
        }

        $newDay = $_POST['newday'];

        // ambil detail resep berdasarkan idresep
        $stmt = $conn->prepare("SELECT namaresep, namakategori, foto FROM resep WHERE idresep = ?");
        $stmt->bind_param("i", $idresep);
        $stmt->execute();
        $result = $stmt->get_result();
        $resep = $result->fetch_assoc();

        if (!$resep) {
            $_SESSION['message'] = "Recipe not found.";
            header("Location: editmealplan.php");
            exit();
        }

        $nama = $resep['namaresep'];
        $kategori = $resep['namakategori'];
        $foto = $resep['foto'];

        // Hapus entri lama berdasarkan idresep (biar resep itu keluar dari hari sebelumnya)
        $deleteOld = $conn->prepare("DELETE FROM mealplan WHERE idresep = ?");
        $deleteOld->bind_param("i", $idresep);
        $deleteOld->execute();

        // Hapus entri yang mungkin sudah ada di hari baru (biar hari barunya kosong)
        $deleteNewDay = $conn->prepare("DELETE FROM mealplan WHERE hari = ?");
        $deleteNewDay->bind_param("s", $newDay);
        $deleteNewDay->execute();

        // Masukkan resep baru ke hari yang dipilih
        $insert = $conn->prepare("INSERT INTO mealplan (hari, idresep, namaresep, namakategori, foto) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("sisss", $newDay, $idresep, $nama, $kategori, $foto);
        $insert->execute();

        $_SESSION['message'] = "Meal Plan updated successfully!";
        header("Location: editmealplan.php");
        exit();
    }

    if (isset($_POST['remove'])) {
        $idresep = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM mealplan WHERE idresep = ?");
        $stmt->bind_param("i", $idresep);
        $stmt->execute();
        $_SESSION['message'] = "Recipe removed from Meal Plan successfully!";
    }

    header("Location: editmealplan.php");
    exit();
}

// ambil hasil mealplan
$result = $conn->query("SELECT idresep, hari, namaresep FROM mealplan");
$raw_mealplans = $result->fetch_all(MYSQLI_ASSOC);

$mealplans = [];
foreach ($raw_mealplans as $row) {
    $mealplans[$row['hari']] = $row;
}

$ordered_days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Meal Plan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
  <style>

    body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #FCF5C7;
  }

  .header {
    text-align: center;
    position: relative;
    z-index: 1;
    background-color: #FCF5C7;
    padding-bottom: 160px; 
  }

  .header h1 {
    font-size: 60px;
    margin-bottom: 10px;
  }

  .image-wrapper {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: -125px;
    z-index: 2;
  }

  .image-wrapper img {
    width: 300px;
    height: auto;
    border-radius: 50%;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  }

  .container {
    background-color: #FF8C00;
    padding: 160px 40px 40px 40px; 
    min-height: 100vh;
    position: relative;
    z-index: 3;
  }

    .header img {
      width: 320px;
      border-radius: 50%;
    }

    .container {
      background-color: #FF8C00;
      padding: 40px;
      min-height: 100vh;
    }

    .message {
      background-color: #FCF5C7;
      color: #FF8C00;
      padding: 10px 20px;
      border-radius: 6px;
      margin-bottom: 20px;
      width: fit-content;
      font-weight: 600;
      text-align: center;
      margin-left: 20px;
    }

    .card {
      background-color: #FCF5C7;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      width: 250px;
    }

    .meal-day {
      font-size: 30px;
      font-weight: 700;
    }

    .meal-name {
      font-size: 24px;
      font-weight: 600;
      margin: 5px 0 15px 0;
    }

    .button-group {
  display: flex;
  align-items: center;
  gap: 5px;
}


    .button-group button {
      background-color: #FF8C00;
      color: white;
      border: none;
      padding: 8px 14px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
    }

    .edit-form {
      display: inline;
    }

    .cards-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: space-around;
    }

    select {
      padding: 6px;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body>

<?php include ("headersearch4.php") ?>

<div class="header">
  <h1>Edit Meal Plan</h1>
  <div class="image-wrapper">
    <img src="images/roasted.png" alt="Meal Image">
  </div>
</div>


<div class="container">
  <?php if (!empty($_SESSION['message'])): ?>
    <div class="message"><?= $_SESSION['message'] ?></div>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>
  <!-- buat ngecek kalo ada pesan yang disimpan di session, kalo ada dihapus biar ga muncul lagi pas di refresh -->

  <div class="cards-container">
    <?php foreach ($ordered_days as $day): ?>
  <?php if (!isset($mealplans[$day])) continue; ?>
  <?php $row = $mealplans[$day]; ?>
  <!-- ngecek di tiap hari ada isi di mealplannya ga, kalo ada dimasukkin datanya ke variabel row -->
  <div class="card">
    <div class="meal-day"><?= htmlspecialchars($row['hari']) ?></div>
    <div class="meal-name"><?= htmlspecialchars($row['namaresep']) ?></div>

    <form method="POST" class="edit-form">
      <input type="hidden" name="id" value="<?= $row['idresep'] ?>"> 
      <!-- input tersembunyi untuk nyimpan id resep yang baru yang mau diubah -->
      <div class="button-group">
  <select name="newday" required>
    <option disabled selected>Move to...</option>
    <?php
      foreach ($ordered_days as $option_day) {
        echo "<option value=\"$option_day\">$option_day</option>";
      }
      // dropdown buat milih hari baru kalo mau pindahin resep ke hari lain
    ?>
  </select>
  <button type="submit" name="update">Edit</button>
  <button type="submit" name="remove">Remove</button>
  <!-- tombol buat proses mau edit/remove -->
</div>

    </form>
  </div>
<?php endforeach; ?>

  </div>
</div>

</body>
</html>
