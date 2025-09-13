<?php
include "koneksi.php";
ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["usernameid"]) && isset($_POST["pass"])) {
        $usernameid = trim($_POST["usernameid"]);
        $password = ($_POST["pass"]);

        $query = "
            SELECT p.email, p.username, p.password 
            FROM user u
            JOIN pengguna p ON u.usernameid = p.username 
            WHERE u.usernameid = ? AND u.pass = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $usernameid, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['usernameid'] = $usernameid;

            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('Incorrect username or password.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Log In</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Inter:wght@400;700&display=swap" rel="stylesheet"/>

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

    .box {
      background: #fff;
      border: 3px solid #FF8C00;
      border-radius: 8px;
      padding: 30px;
      height: 320px;
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
      background-color: #e07a00;
    }

    .bg-img {
      background: url('images/top-view-table-full-food.png') no-repeat center center/cover;
      height: 100vh;
    }
  </style>
</head>

<body>
  <div class="d-flex">
    <div class="col-6 bg-img"></div>
    <div class="col-6 d-flex flex-column justify-content-start align-items-center p-4">
      <div class="w-100 d-flex justify-content-end gap-4 px-4">
        <a href="index.php" class="nav-link text-dark">Home</a>
        <a href="signin.php" class="nav-link text-dark">Sign Up</a>
        <a href="loginculina.php" class="nav-link text-dark active">Log In</a>
        <a href="contactus.php" class="nav-link text-dark">Contact Us</a>
      </div>
      <h2 class="mt-5 mb-4 fw-bold">Log In</h2>
      <div class="box">
        <!-- tambahin autocomplete="off" di form -->
        <form method="post" action="" autocomplete="off">
          <div class="mb-3">
            <label class="form-label fs-5">Username</label>
            <input type="text" class="form-control field" name="usernameid" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Password</label>
            <input type="password" class="form-control field" name="pass" required autocomplete="new-password">
          </div>
          <button type="submit" class="btn btn-orange w-100 mt-3">Log In</button>
        </form>
      </div>
    </div>
  </div>
</body>
<?php
mysqli_close($conn);
ob_end_flush();
?>
</html>
