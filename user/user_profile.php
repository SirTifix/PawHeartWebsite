<?php
function validate_field($value, $pattern, $title) {
  return preg_match($pattern, $value) ? $value : '';
}

// user_profile.php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have the user's ID after login, replace $user_id with the actual user ID.

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other desired location
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Fetch user data from the 'paw' table using prepared statement
$sql = "SELECT * FROM paw WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Display user data
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $name = htmlentities($row["name"]);
  $email = htmlentities($row["email"]);
  $contact = htmlentities($row["contact"]);
  $petName = htmlentities($row["petName"]);
  $petType = htmlentities($row["petType"]);
  $petAge = htmlentities($row["petAge"]);

  // Validate fields
  $contact = validate_field($contact, '/^[0-9]+$/', 'Only numbers are allowed');
  $petName = validate_field($petName, '/^[A-Za-z0-9\s]+$/', 'Only letters, numbers, and spaces are allowed');
  $petType = validate_field($petType, '/^[A-Za-z\s]+$/', 'Only letters and spaces are allowed');
  $petAge = validate_field($petAge, '/^[0-9]+$/', 'Only numbers are allowed');

?>

    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='preconnect' href='https://fonts.gstatic.com'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='../vendor/bootstrap-5.0.2/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' />
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>    
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
        <script src='../assets/js/java.js' defer></script>    
        <link rel='stylesheet' href='../assets/css/style.css'>
        <link rel='stylesheet' href='../assets/css/services.css'>
        <title> User Account </title>
        <style>
            body {
                background-color: #f8f9fa;
            }
            .profile-container {
                background-color: #ffffff;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                border-radius: 10px;
                margin: 20px auto;
                max-width: 600px;
                text-align: center;
            }
            .profile-image-container {
                background-color: #ffffff;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                border-radius: 10px;
                margin: 20px auto;
                max-width: 400px;
                text-align: center;
            }
            .profile-details {
                margin-bottom: 15px;
            }
            .profile-details strong {
                font-weight: bold;
                color: #F78CA2;
            }
            .profile-details input {
                border: 1px solid #dee2e6;
                border-radius: 5px;
                padding: 8px;
                width: 80%;
                margin-top: 5px;
            }
            .btn-pink {
                background-color: #F78CA2;
                color: #fff;
                margin-top: 10px;
            }
        </style>
    </head>

    <?php
 // Output HTML
 echo "

 <!DOCTYPE html>
 <html lang='en'>
 <head>
     <!-- ... (your existing head content) ... -->
 </head>
 <body>";

 // Include header
 require_once('../include/header.loggedin.php');

 echo "
        <div class='container profile-container'>
            <h2 class='mb-4'>Profile</h2>
            <form method='post' action='update_profile.php'>
                <div class='container profile-image-container'>
                    <h2 class='mb-4'>Profile Image</h2>
                    <img src='../assets/img/default.png' alt='Profile Image' class='img-fluid' style='max-width: 100%; max-height: 150px;'>
                </div>
                <div class='profile-details'>
                    <strong>Username:</strong>
                    <input type='text' name='name' value='" . $name . "' readonly>
                </div>
                <div class='profile-details'>
                    <strong>Email:</strong>
                    <input type='email' name='email' value='" . $email . "' readonly>
                </div>
                <div class='profile-details'>
                    <strong>Contact No.:</strong>
                    <input type='text' name='contact' value='" . $contact . "' readonly>
                </div>
                <div class='profile-details'>
                    <strong>Pet Name:</strong>
                    <input type='text' name='petName' value='" . $petName . "' readonly>
                </div>
                <div class='profile-details'>
                    <strong>Pet Type:</strong>
                    <input type='text' name='petType' value='" . $petType . "' readonly>
                </div>
                <div class='profile-details'>
                    <strong>Pet Age:</strong>
                    <input type='text' name='petAge' value='" . $petAge . "' readonly>
                </div>
                <button type='button' class='btn btn-pink' id='editButton'>Edit</button>
                <button type='submit' class='btn btn-pink' id='saveButton' style='display: none;'>Save</button>
            </form>
        </div>

        <script>
            document.getElementById('editButton').addEventListener('click', function() {
                // Enable editing by removing readonly attribute
                document.querySelectorAll('.profile-details input').forEach(function(input) {
                    input.removeAttribute('readonly');
                });
                // Show the Save button
                document.getElementById('saveButton').style.display = 'inline-block';
            });
        </script>

        <?php require_once('../include/footer.php'); ?>
    </body>
    </html>";
?>

    <?php
} else {
    echo "User data not found";
}

$conn->close();
?>

<body>
    

  <?php
  require_once ('../include/footer.php')
  ?>
</body>
</html>