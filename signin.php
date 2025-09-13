<?php
include "koneksi.php";
ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields exist before using them
    if (
        isset($_POST["email"]) &&
        isset($_POST["username"]) &&
        isset($_POST["password"])
    ) {
        $email = trim($_POST["email"]);
        $username = trim($_POST["username"]); 
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!empty($email) && !empty($username) && !empty($password)) {
            $check = $conn->prepare("SELECT username FROM pengguna WHERE username = ?");
            $check->bind_param("s", $username);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                echo "<script>alert('Username already exists!');</script>";
            } else {
                // Insert into pengguna
                $insertpengguna = $conn->prepare("INSERT INTO pengguna (email, username, password) VALUES (?, ?, ?)");
                $insertpengguna->bind_param("sss", $email, $username, $password);
                $insertpengguna->execute();

                // Insert into user
                $insertuser = $conn->prepare("INSERT INTO user (usernameid, pass) VALUES (?, ?)");
                $insertuser->bind_param("ss", $username, $password);
                $insertuser->execute();

                // Redirect to prevent form resubmission
               // echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
               // exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>

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
        <a href="signin.php" class="nav-link text-dark active">Sign Up</a>
        <a href="loginculina.php" class="nav-link text-dark">Log In</a>
        <a href="contactus.php" class="nav-link text-dark">Contact Us</a>
      </div>
      <h2 class="mt-5 mb-4 fw-bold">Sign Up</h2>
      <div class="box">
        <form method="post" action="" autocomplete="off">
          <div class="mb-3">
            <label class="form-label fs-5">Email</label>
            <input type="text" class="form-control field" name="email" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Username</label>
            <input type="text" class="form-control field" name="username" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label fs-5">Password</label>
            <input type="password" class="form-control field" name="password" required autocomplete="new-password">
          </div>
          <button type="submit" class="btn btn-orange w-100 mt-3">Sign Up</button>
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
