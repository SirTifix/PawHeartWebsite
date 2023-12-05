<?php
session_start();
require_once '../classess/user.class.php';
require_once '../tools/functions.php';
require_once('../tools/user_functions.php');

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
    exit();
}

// User is logged in, retrieve user data
$user = new User();
$id = $_SESSION['id'];
$record = $user->fetch($id);

// If user data is not found, redirect to the appropriate page
if (!$record) {
    header("Location: ./index.php");
    exit();
}

$name = '';
$email = '';
$contact = '';
$petName = '';
$petAge = '';
$petType ='';

if (is_array($record)) {
    $name = $record['name'];
    $email = $record['email'];
    $contact = $record['contact'];
    $petName = $record['petName'];
    $petType = $record['petType'];
    $petAge = $record['petAge'];

} else {
    // Handle the case where $record is not an array
    // For example, you might set default values or display an error message
    echo "Error: User data not found.";
}

// Initialize variables with user data or form submission data
$newName = isset($_POST['name']) ? $_POST['name'] : $name;
$newEmail = isset($_POST['email']) ? $_POST['email'] : $email;
$newContact = isset($_POST['phone']) ? $_POST['phone'] : $contact;
$newPetName = isset($_POST['petType']) ? $_POST['petType'] : $petName;
$newPassword = isset($_POST['petAge']) ? $_POST['petAge'] : $petAge; // Ensure you want to clear the password on each edit
$newPetType = isset($_POST['petType']) ? $_POST['petType'] : $petType;
$newPetAge = isset($_POST['petAge']) ? $_POST['petAge'] : $petAge;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Assign form submission values to variables
    $newName = isset($_POST['name']) ? $_POST['name'] : '';
    $newEmail = isset($_POST['email']) ? $_POST['email'] : '';
    $newContact = isset($_POST['phone']) ? $_POST['phone'] : $contact;
    $newPetName = isset($_POST['petType']) ? $_POST['petType'] : '';
    $newPassword = isset($_POST['petAge']) ? $_POST['petAge'] : '';
    $newPetType = isset($_POST['petType']) ? $_POST['petType'] : '';
    $newPetAge = isset($_POST['petAge']) ? $_POST['petAge'] : '';

    // Validate the new data
    if (
        validate_field($newName) &&
        validate_field($newEmail) &&
        validate_field($newContact) &&
        validate_field($newPetName) &&
        validate_field($newPetType) &&
        validate_field($newPetAge)
    ) {
        try {
            // Update user data
            $user->insertUserData($newName, $newEmail, $newContact, $newPetName, $newPetType, $newPetAge);
            // Optionally, update the session variables with the new data
            $_SESSION['user_name'] = $newName;
            $_SESSION['user_email'] = $newEmail;
            $_SESSION['user_contact'] = $newContact;
            $_SESSION['user_petname'] = $newPetName;
            $_SESSION['user_pettype'] = $newPetType;
            $_SESSION['new_petage'] = $newPetAge;

            header("Location: ./appointment_form.php");
            exit();
        } catch (Exception $e) {
            echo "Error updating user data: " . $e->getMessage();
        }
    } else {
        // Handle validation errors
        echo "Validation failed. Please check your input.";
    }
}

?>
<!doctype html>
<html lang="en">

<head>

<style>
        .error-message {
            color: red;
            display: none;
        }
    </style>


    <title>Book Appointment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href=".no-bg-bg-48.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/appointment_form.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="../styles/appointment_form.css">
    <link rel="stylesheet" href="..frontend/assets/style.css">
    <link rel="stylesheet" href="../styles/style.css">
    


    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/f584623432.js" crossorigin="anonymous"></script>
</head>

<?php
  require_once('../include/header.loggedin.php');
?>
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="heading">
                    Appointment
                </h2>
                <form action="appointment_list.php" method="post" onsubmit=" return validateForm();">
                <div id="error-message" class="error-message">All fields are required.</div>

                    <div class="form-group row">
                        <label class="col-sm-4">
                            Name
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Enter full name" required pattern=[A-Z\sa-z]{3,20} title="Only letters and spaces are allowed" value="<?php echo $name; ?>" required>
                        </div>
                    </div>
                    <!---->
                    <div class="form-group row">
                        <label class="col-sm-4">
                            Email
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="email" id="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                    </div>
                    <!---->
                    <div class="form-group row">
    <label class="col-sm-4">
        Contact No.
    </label>
    <div class="col-sm-8 col-lg-8">
        <input type="number" id="phone" class="form-control" name="phone" placeholder="Enter contact number" required pattern="[0-9]+" title="Only numerical digits are allowed" required value="<?php echo $newContact; ?>">
    </div>
    <?php
    if(isset($_POST['phone']) && !validate_field($_POST['phone'])){
    ?>
        <p class="text-danger my-1">Contact Number is required</p>
    <?php
    }
    ?>
</div>
                    <!---->
                    <div class="form-group row">
                        <label class="col-sm-4">
                            Doctor Name
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <select name="doctor" id="doctor" class="form-control" required>
                                <option value="">select doctor</option>
                                <option value="Dr.Doofensmhirtz"<?php if(isset($_POST['section']) && $_POST['section'] == 'Dr.Doofensmhirtz') { echo 'selected'; }else if(isset($user->section) && $user->section == 'Dr.Doofensmhirtz') { echo 'selected'; } ?>>Dr.Doofensmhirtz</option>
                                <option value="Dr.Octavious" <?php if(isset($_POST['section']) && $_POST['section'] == 'Dr.Octavious') { echo 'selected'; }else if(isset($user->section) && $user->section == 'Dr.Octavious') { echo 'selected'; } ?>>Dr.Octavious</option>
                                <option value="Dr.Strange" <?php if(isset($_POST['section']) && $_POST['section'] == 'Dr.Strange') { echo 'selected'; }else if(isset($user->section) && $user->section == 'Dr.Strange') { echo 'selected'; } ?>>Dr.Strange</option>
                                <option value="Dr.Manhattan" <?php if(isset($_POST['section']) && $_POST['section'] == 'Dr.Manhattan') { echo 'selected'; }else if(isset($user->section) && $user->section == 'Dr.Manhattan') { echo 'selected'; } ?>>Dr.Manhattan</option>
                            </select>
                        </div>
                    </div>
                    <!---->
                    <div class="form-group row">
    <label class="col-sm-4">
        Pet Name
    </label>
    <div class="col-sm-8 col-lg-8">
        <input type="text" id="petName" class="form-control" name="petName" placeholder="Enter Pet Name" required pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed" required value="<?php echo $newPetName; ?>">
    </div>
    <?php
    if(isset($_POST['petName']) && !validate_field($_POST['petName'])){
    ?>
        <p class="text-danger my-1">Pet Name is required</p>
    <?php
    }
    ?>
</div>

<div class="form-group row">
    <label class="col-sm-4">
        Pet Type
    </label>
    <div class="col-sm-8 col-lg-8">
        <input type="text" id="petType" class="form-control" name="petType" placeholder="Enter Pet Type" required pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed" required value="<?php echo $newPetType; ?>">
    </div>
    <?php
    if(isset($_POST['petType']) && !validate_field($_POST['petType'])){
    ?>
        <p class="text-danger my-1">Pet Type is required</p>
    <?php
    }
    ?>
</div>

<div class="form-group row">
    <label class="col-sm-4">
        Pet Age
    </label>
    <div class="col-sm-8 col-lg-8">
        <input type="text" id="petAge" class="form-control" name="petAge" placeholder="Enter Pet Age" required pattern="[0-9]+" title="Only numerical digits are allowed" required value="<?php echo $newPetAge; ?>">
    </div>
    <?php
    if(isset($_POST['petAge']) && !validate_field($_POST['petAge'])){
    ?>
        <p class="text-danger my-1">Pet Age is required</p>
    <?php
    }
    ?>
</div>

<div class="form-group row">
    <label class="col-sm-4">
        Pet Amount
    </label>
    <div class="col-sm-8 col-lg-8">
        <input type="text" id="petAmount" class="form-control" name="petAmount" placeholder="Enter Pet Amount" required pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed">
    </div>
    <?php
    if(isset($_POST['petAmount']) && !validate_field($_POST['petAmount'])){
    ?>
        <p class="text-danger my-1">Pet Amount is required</p>
    <?php
    }
    ?>
</div>
                    <!---->
                    <div class="form-group row">
                        <label class="col-sm-4">
                            Date
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                    </div>
                    <!---->
                    <div class="form-group row">
                        <label class="col-sm-4">
                            Time
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="time" id="time" name="time" class="form-control">
                        </div>
                    </div>
                    <!---->
                    <div class="form-group row">
                        <label class="col-sm-4">
                            Symptoms
                        </label>
                        <div class="col-sm-8 col-lg-8">
                            <textarea id="symptoms" class="form-control" name="symptoms" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-5">
                            <button class="form_btn" type="submit" onclick="validateForm()">
                                Book Now
                            </button>
                        </div>
                        
                    </div>

                </form>
            </div>
            <div class="col-md-6" id="img_box">
                <img src="../assets/img/pet-surgery.jpg"
                    alt="">
            </div>
        </div>
    </div>

      <script>
      function validateForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var doctor = document.getElementById('doctor').value;
    var petType = document.getElementById('petType').value;
    var petAge = document.getElementById('petAge').value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (
        name === '' ||
        email === '' ||
        phone === '' ||
        doctor === '' ||
        petType === '' ||
        petAge === '' ||
        !emailRegex.test(email)
    ) {
        document.getElementById('error-message').style.display = 'block';
        return false;
    }

    return true;
}

        window.onload = function () {
            document.getElementById('error-message').style.display = 'none';
        };
    </script>

    
</body>
<?php
    require_once('../include/footer.php')
    ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

</html>