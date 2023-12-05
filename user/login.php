<?php
session_start();
require_once('../tools/user_functions.php');
require_once('../classess/db.php'); // Correct the path to db.php

// Create an instance of the dbConnect class
$db = new dbConnect();
$conn = $db->connect(); // Get the connection from the class

$error = ""; // Variable to store the error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $stmt = $conn->prepare("SELECT * FROM paw WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Start a new session or resume the existing one
        session_start();

        // Store user information in the session
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        // Redirect to the user's dashboard or another page
        header("Location: ./appointment_form.php");
        exit();
    } else {
        // Set the error message
        $error = "Invalid email or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href=".no-bg-bg-48.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/signup.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/f584623432.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Login | Vetcare</title>

    <style>
        #footer {
            margin-top: -200px;
        }

        @media only screen and (max-width: 1400px) and (min-width: 1000px) {
            #footer {
                margin-top: -250px;
            }
        }

        @media only screen and (max-width: 1000px) and (min-width: 600px) {
            #footer {
                margin-top: -340px;
            }
        }

        @media only screen and (max-width: 600px) and (min-width: 200px) {
            #footer {
                margin-top: -340px;
            }
        }
    </style>
</head>
    <body>
    <?php
  require_once('../include/header.php');
?>
    <!-- Navbar Start -->
    <div class="containerII">
      <div class="innerContainer">
          <div class="box1">
              <h1>Login to your account</h1>
              <form method="post">
                  <label for="email">Email</label>
                  <input type="email" placeholder="Enter email" id="email" name="email" required>
                  <label for="password">Password</label>
                  <input type="password" placeholder="Enter password" id="password" name="password" required>
                  <input type="submit" id="submit" value="Login">
                  <?php if ($error) : ?>
                  <div style="color: red;"><?php echo $error; ?></div>
                  <?php endif; ?>
                  <p class="link">Create a new account <a href="./signup.php">Sign Up</a></p>
                  <p style="margin-top: 20px; margin-bottom: 5px;">Login as <a href="../admin/admin_login.php" target="_blank">Admin</a></p>
              </form>
            </div>
            <div class="box2">
                <img src="./assets/Petting.svg" alt="">
            </div>
        </div>
    </div>
    <?php
    require_once('../include/footer.php')  

    ?>
</body>

</html>

