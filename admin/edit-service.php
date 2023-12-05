<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = isset($_POST["id"]) ? $_POST["id"] : '';
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';

    // Sanitize and escape the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);

    // Update data in the dbConnect
    $sql = "UPDATE services SET name='$name', description='$description', price='$price' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Service updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve service details based on ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM services WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
    } else {
        echo "Service not found";
        exit;
    }
} else {
    echo "Service ID not provided";
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
    <link href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/dataTable-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/font-awesome-4.7.0/css/font-awesome.min.css"/>   
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
    <title>Manage Appointment</title>
   
</head>
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
                <h2 class="h3 brand-color pt-3 pb-2">Edit Service</h2>
                <a href="view-service.php" class="text-primary text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-12 col-lg-6">
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name of service</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= $description ?>">
                    </div>
                    <div class="mb-2">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>">
                    </div>
                    <button type="submit" name="save" class="btn mt-2 mb-3 btn-secondary brand-bg-color" id="editServiceButton">Save Changes</button>
                </form>
            </div>
        </main>
        <script src="./scripts/admin.js"></script>
    </body>

    </html>
