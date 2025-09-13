<?php
include "koneksi.php";
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Culina</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Sofia+Sans:wght@300;500;700&display=swap" rel="stylesheet"/>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
      height: 100vh;
      overflow: hidden;
    }

    .nav-link.active {
      font-weight: 500px;
    }

    .nav-link.active,
    .nav-link:hover {
      border-bottom: 3px solid #FF8C00;
      color: black;
    }

    .main-box {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }

    .bg-img {
      position: absolute;
      width: 1468.27px;
      height: 978.6px;
      left: 557.77px;
      top: 686px;
      transform: rotate(-43deg);
      transform-origin: top left;
    }

    .shape {
      position: absolute;
      border-radius: 338.15px;
      background: #FF8C00;
      opacity: 0.5;
    }

    .title {
      position: absolute;
      top: 189px;
      left: 102px;
      font-size: 75px;
      font-weight: 600;
      color: black;
    }

    .subtitle {
      position: absolute;
      top: 280px;
      left: 105px;
      font-size: 25px;
      font-family: 'Sofia Sans', sans-serif;
      color: black;
    }

    .navbar-custom {
      position: absolute;
      top: 24px;
      right: 50px;
      z-index: 10;
    }

    .nav-underline {
      width: 77px;
      height: 0;
      outline: 3px solid #FF8C00;
      outline-offset: -1.5px;
      position: absolute;
      top: 60px;
      left: 688px;
    }
  </style>
</head>

<body>
  <div class="main-box">

    <!-- Nav Bar -->
    <div class="d-flex justify-content-end gap-4 px-4 navbar-custom">
      <a href="index.php" class="nav-link text-dark active">Home</a>
      <a href="signin.php" class="nav-link text-dark">Sign Up</a>
      <a href="loginculina.php" class="nav-link text-dark">Log In</a>
      <a href="contactus.php" class="nav-link text-dark">Contact Us</a>
    </div>

    <!-- Text Content -->
    <div class="title">Culina</div>
    <div class="subtitle">Personalized cooking, tailored to your taste.</div>

    <!-- Shapes -->
    <div class="shape" style="width: 135px; height: 500px; top: 280px; left: 70px; transform: rotate(45deg);"></div>
    <div class="shape" style="width: 135px; height: 623px; top: 400px; left: 350px; transform: rotate(45deg);"></div>
    <div class="shape" style="width: 75px; height: 600px; top: 400px; left: 180px; opacity: 0.7; transform: rotate(45deg);"></div>
    <div class="shape" style="width: 113px; height: 464px; top: -286px; left: 579px; transform: rotate(46deg); opacity: 1;"></div>
    <div class="shape" style="width: 113px; height: 464px; top: -169px; left: 676px; transform: rotate(45deg); opacity: 1;"></div>

    <!-- Right Background Bar -->
    <div style="width: 800px; height: 1000px; background: #FF8C00; position: absolute; top: -100px; left: 1400px; transform: rotate(47deg); transform-origin: top left;"></div>

    <!-- Background Image -->
    <img src="images/top-view-table-full-food.png" class="bg-img" />

    <!-- Underline (optional) -->
    <div class="nav-underline"></div>
  </div>
</body>

<?php
mysqli_close($conn);
ob_end_flush();
?>
</html>
