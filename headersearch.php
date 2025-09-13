<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FCF5C7;
      margin: 0;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 15px 40px;
      background-color: #FCF5C7;
      flex-wrap: wrap;
      flex-direction: row;
    }

    .logo {
      font-size: 28px;
      font-weight: 600;
      color: black;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 40px;
      right: 30px;
    }

    .nav-link {
      font-size: 20px;
      color: black;
      text-decoration: none;
      font-weight: 300;
    }

    .nav-link.active,
    .nav-link:hover {
      border-bottom: 3px solid #FF8C00;
      font-weight: 500;
    }

    .search-form {
      position: relative;
    }

    .search-form input[type="text"] {
      padding: 10px 40px 10px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      width: 250px;
    }

    .search-form button {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      border: none;
      background: none;
      font-size: 16px;
      cursor: pointer;
      color: #333;
    }

    .fa-magnifying-glass {
      font-size: 18px;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">Culina</div>

    <div class="nav-links">
      <a href="welcome.php" class="nav-link">Welcome</a>
      <a href="explore.php" class="nav-link active"><i class="fas fa-magnifying-glass"></i> Explore</a>

      <form class="search-form" action="search.php" method="get">
        <input type="text" name="search" placeholder="Search" required>
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>

      <a href="mealplan.php" class="nav-link">Meal Plan</a>
      <a href="index.php" class="nav-link">Log Out</a>
    </div>
  </div>

</body>
</html>
