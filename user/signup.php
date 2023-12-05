<?php
require_once '../classess/user.class.php';
require_once '../tools/functions.php';

$db = new dbConnect();
$conn = $db->connect(); // Get the connection from the class

$error = ""; // Variable to store the error message


//for database connection request - carl
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(); //instantiation -carl
    
    //sanitize
    $user->name = htmlentities($_POST['name']);
    $user->email = htmlentities($_POST['email']);
    $user->password = htmlentities($_POST['password']);
    $user->contact = htmlentities($_POST['contact']);
    $user->petName = htmlentities($_POST['petName']);
    $user->petType = htmlentities($_POST['petType']);
    $user->petAge = htmlentities($_POST['petAge']);

    // validate
    if (
        validate_field($user->name) &&
        validate_field($user->email) &&
        validate_field($user->password) &&
        validate_field($user->contact) &&
        validate_field($user->petName) &&
        validate_field($user->petType) &&
        validate_field($user->petAge) &&
        validate_email($user->email) && !$user->is_email_exist()
    ) {
        // Assuming the User class has a method named 'add'
        try {
            $user->add($_POST['name'], $_POST['email'], $_POST['contact'], $_POST['petName'],$_POST['password'],$_POST['petType'], $_POST['petAge']);

            // Display success message or redirect to another page
            $successMessage = 'User added successfully.';
            header("Location: ./login.php");
            exit();
        } catch (Exception $e) {
            echo "Error adding user data: " . $e->getMessage();
        }
    } else {
        echo "Validation failed. Please check your input.";
    }
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/f584623432.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign Up | Vetcare</title>
    <style>
        #footer {
            margin-top: 200px;
        }

        @media only screen and (max-width: 600px) and (min-width: 200px) {
            #footer {
                margin-top: 0px;
            }
        }
    </style>
</head>

<body>

  <?php
  require_once('../include/header.php')
  ?>


<div class="containerII">
        <div class="innerContainer">
            <div class="box1">
                <h1>Create a Pet Parent account</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
                    <label for="name">Name</label>
                    <input type="text" placeholder="Enter name" id="name" name="name" required pattern=[A-Z\sa-z]{3,20} title="Only letters and spaces are allowed" required value="<?php if (isset($_POST['email'])) {
                                                                                                                                                                echo $_POST['email'];
                                                                                                                                                            } else if (isset($user->email)) {
                                                                                                                                                                echo $user->email;
                                                                                                                                                            } ?>">
                                
            <label for="email">Email</label>
            <input type="email" placeholder="Enter email" id="email" name="email" required>
            <?php
            $new_user = new User();
            if (isset($_POST['email'])) {
                $new_user->email = htmlentities($_POST['email']);
            } else {
                $new_user->email = '';
            }

            if (isset($_POST['email']) && strcmp(validate_email($_POST['email']), 'success') != 0) {
                ?>
                <p class="text-danger my-1"><?php echo validate_email($_POST['email']) ?></p>
            <?php
            } else if ($new_user->is_email_exist() && $_POST['email']) {
                ?>
                <p class="text-danger my-1">Email already exist</p>
            <?php
            }
            ?>

            <label for="password">Password</label>
            <input type="password" placeholder="Enter password" id="password" name="password" required value="<?php if (isset($_POST['password'])) {
                                                                                                                echo $_POST['password'];
                                                                                                            } ?>" required>
            <?php
            if (isset($_POST['password']) && strcmp(validate_password($_POST['password']), 'success') != 0) {
                ?>

            <?php
            }
            ?>

            <label for="contact">Contact No.</label>
            <input type="tel" placeholder="Enter contact no." id="contact" name="contact" required pattern="[0-9]+" title="Only numerical digits are allowed" required value="<?php if (isset($_POST['contact'])) {
                                                                                                                                                                        echo $_POST['contact'];
                                                                                                                                                                    } else if (isset($user->contact)) {
                                                                                                                                                                        echo $user->contact;
                                                                                                                                                                    } ?>">
            <?php
            if (isset($_POST['contact']) && !validate_field($_POST['contact'])) {
                ?>
                <p class="text-danger my-1"> Contact Number is required</p>
            <?php
            }
            ?>

            <label for="petName">Pet Name</label>
            <input type="text" placeholder="Enter pet name" id="petName" name="petName" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed" oninput="validatePetName(this)" required value="<?php if (isset($_POST['petName'])) {
                                                                                                                                                                                    echo $_POST['petName'];
                                                                                                                                                                                } else if (isset($user->petName)) {
                                                                                                                                                                                    echo $user->petName;
                                                                                                                                                                                } ?>">
            <?php
            if (isset($_POST['petName']) && !validate_field($_POST['petName'])) {
                ?>
                <p class="text-danger my-1">Pet Name is required</p>
            <?php
            }
            ?>

            <label for="petType">Pet Type</label>
            <input type="text" placeholder="Enter pet Type" id="petType" name="petType" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are allowed" oninput="validatePetName(this)" required value="<?php if (isset($_POST['petType'])) {
                                                                                                                                                                                        echo $_POST['petType'];
                                                                                                                                                                                    } else if (isset($user->petType)) {
                                                                                                                                                                                        echo $user->petType;
                                                                                                                                                                                    } ?>">
            <?php
            if (isset($_POST['petType']) && !validate_field($_POST['petType'])) {
                ?>
                <p class="text-danger my-1">Pet Type is required</p>
            <?php
            }
            ?>

            <label for="petAge">Pet Age</label>
            <input type="number" placeholder="Enter pet age" id="petAge" name="petAge" required pattern="[0-9]+" title="Only numerical digits are allowed" required value="<?php if (isset($_POST['petAge'])) {
                                                                                                                                                                        echo $_POST['petAge'];
                                                                                                                                                                    } else if (isset($user->petAge)) {
                                                                                                                                                                        echo $user->petAge;
                                                                                                                                                                    } ?>">
            <?php
            if (isset($_POST['petAge']) && !validate_field($_POST['petAge'])) {
                ?>
                <p class="text-danger my-1">Pet Age  is required</p>
            <?php
            }
            ?>

            <input type="submit" id="submit" name="submit">
        </form>

                <!-- Display success or error message -->
                <?php if (!empty($successMessage)) : ?>
                    <div style="color: green;"><?php echo $successMessage; ?></div>
                <?php elseif (!empty($error)) : ?>
                    <div style="color: red;"><?php echo $error; ?></div>
                <?php endif; ?>

                <p class="link">Already have an account? <a href="./login.php">Login</a></p>
            </div>

            <div class="box2">
                <img src="./assets/injured.svg" alt="">
            </div>
        </div>
    </div>

    <?php require_once('../include/footer.php') ?>

    <script>
        function validatePetName(input) {
            // Remove any special characters from the input
            input.value = input.value.replace(/[^A-Za-z0-9 ]/g, '');
        }
    </script>

</body>

</html>

