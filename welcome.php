<?php
define('AKTIF', true);
include "autentikasi.php";
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&family=Sofia+Sans:wght@400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      position: absolute;
      width: 583px;
      height: 1125px;
      top: -83px;
      left: -28px;
      background: #FF8C00;
      box-shadow: 0px 4px 10px 10px rgba(0, 0, 0, 0.5);
    }

    .logo {
      position: absolute;
      top: 16px;
      left: 37px;
      font-size: 28px;
      font-weight: 600;
      color: white;
    }

    .nav {
      position: absolute;
      top: 20px;
      right: 30px;
      display: flex;
      gap: 40px;
      align-items: center;
      font-size: 24px;
      font-weight: 300;
    }


    .nav-link.active {
      font-weight: 500px;
    }

    .nav-link.active,
    .nav-link:hover {
      border-bottom: 3px solid #FF8C00;
      color: black;
    }

    .main-image {
      position: absolute;
      top: 60px;
      left: 680px;
      width: 500px;
      height: 500px;
    }

    .welcome-text {
      position: absolute;
      top: 180px;
      left: 68px;
      font-size: 65px;
      font-weight: 600;
      line-height: 70px;
      color: white;
    }

    .subtext {
      position: absolute;
      top: 340px;
      left: 68px;
      line-height: 10px;
      font-size: 28px;
      font-family: 'Sofia Sans', sans-serif;
      color: white;
      font-weight: 400;
    }

    .fa-magnifying-glass {
      margin-right: 8px;
    }

     .box {
      background: #fff;
      border: 3px solid #FF8C00;
      border-radius: 8px;
      padding: 30px;
      height: 370px;
      max-width: 400px;
    }


    .field {
      background: #FCF5C7;
      border-radius: 8px;
      border: 1px solid #D9D9D9;
    }

    .btn-orange {
      background-color: #FF8C00;
      color: #fff;
      font-weight: bold;
    }

    .btn-orange:hover {
      background-color: #FF8C00;
    }

    
  </style>
</head>
<body>
  <div class="sidebar"></div>

  <div class="logo">Culina</div>

  <div class="d-flex">
    <div class="col-6 bg-img"></div>
    <div class="col-6 d-flex flex-column justify-content-start align-items-center p-4">
      <div class="w-100 d-flex justify-content-end gap-4 px-4">
        <a href="welcome.php" class="nav-link text-dark active">Welcome</a>
        <a class="nav-link text-dark" href="explore.php"><i class="fas fa-magnifying-glass"></i>Explore</a>
        <a href="mealplan.php" class="nav-link text-dark">Meal Plan</a>
        <a href="index.php" class="nav-link text-dark">Log Out</a>
      </div>
      
    </div>
  
  </div>

  <img class="main-image" src="images/roasted.png" alt="Main Dish Image" />

  <div class="welcome-text">
    Welcome,<br />
    <?php echo htmlspecialchars($_SESSION['usernameid']); ?>!
  </div>
  <div class="subtext">What would you like to eat today?</div>
</body>
</html>
