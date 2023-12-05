<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $date_of_birth = isset($_POST["date_of_birth"]) ? $_POST["date_of_birth"] : '';
    $experience = isset($_POST["experience"]) ? $_POST["experience"] : '';
    $specialization = isset($_POST["specialization"]) ? $_POST["specialization"] : '';

    // Sanitize and escape the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $gender = mysqli_real_escape_string($conn, $gender);
    $date_of_birth = mysqli_real_escape_string($conn, $date_of_birth);
    $experience = mysqli_real_escape_string($conn, $experience);
    $specialization = mysqli_real_escape_string($conn, $specialization);

    // Update data in the dbConnect
    $sql = "UPDATE veterinarians SET name='$name', gender='$gender', date_of_birth='$date_of_birth', experience='$experience',
    specialization='$specialization' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Service updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve service details based on ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM veterinarians WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $gender = $row['gender'];
        $date_of_birth = $row['date_of_birth'];
        $experience = $row['experience'];
        $specialization = $row['specialization'];
    } else {
        echo "Veterinarian not found";
        exit;
    }
} else {
    echo "Veterinarian ID not provided";
    exit;
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Appointment</title>
    
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-logo1" href="#"><img src="../assets/img/no-bg-bg.png" alt="" class="navbar-logo" srcset=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../AboutUs.php">About us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../Services.php">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../appointment_form.php">Booking</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../appointment_list.php">Appointments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../login.php">Log in</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <div id="nav">
        <h1>Admin Panel</h1>
    </div>
    <div id="after-nav">
      <div id="after-nav-col-1" >
        <div class="row">
        <a href="./admin.php"> <h2>Manage Appointments</h2></a>   
        </div>
        <div class="row">
            <a href="./view-doctor.php"><h2>Manage Veterinarian</h2></a>    
        </div>
        <div class="row">
            <a href="./add-doctor.php"><h2>Add Veterinarian</h2></a>    
        </div>
        <div class="row">
            <a href="./remove-doctor.php"> <h2>Remove Veterinarian</h2></a>   
        </div>
        <div class="row">
            <a href="./view-service.php"><h2>Manage Service</h2></a>    
        </div>
        <div class="row">
            <a href="./add-service.php"> <h2>Add Service</h2></a>   
        </div>
        <div class="row">
          <a href="./remove-service.php"> <h2>Remove Service</h2></a>   
        </div>
        <div class="row">
          <a href="../tools/logout.php"> <h2>Log-out</h2></a>   
        </div>
    </div>
         <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="col-12 col-lg-6 d-flex justify-content-between align-items-center">
                <h2 class="h3 brand-color pt-3 pb-2">Edit Veterinarian</h2>
                <a href="view-doctor.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
              <form method="post" action="">
                  <div class="mb-2">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                  </div>

                  <div class="mb-2">
                      <label for="gender" class="form-label">Gender</label>
                      <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>">
                  </div>

                  <div class="mb-2">
                      <label for="date_of_birth">Date of birth</label>
                      <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
                  </div>

                  <div class="mb-2">
                      <label for="experience" class="form-label">Experience</label>
                      <input type="text" class="form-control" id="experience" name="experience" value="<?php echo $experience; ?>">
                  </div>

                  <div class="mb-2">
                      <label for="specialization" class="form-label">Specialization</label>
                      <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo $specialization; ?>">
                  </div>

                  <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Add a hidden input for the veterinarian ID -->

                  <button type="submit" name="save" class="btn btn-secondary mt-2 mb-3 brand-bg-color" id="addServiceButton">Save Changes</button>
              </form>
          </div>
        </main>

        <script src="./scripts/admin.js"></script>
</body>

</html>