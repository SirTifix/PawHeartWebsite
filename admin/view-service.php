<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

// Fetch data from the services table
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

// Initialize an array to store the service data
$serviceArray = array();

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data and store it in the array
    while ($row = $result->fetch_assoc()) {
        $serviceArray[] = $row;
    }
}

// Close the dbConnect connection
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
         <div id="after-nav-col-2" class="side-part appointment all-appoint">
          <div id="chek">
            </div>
              <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                      <thead class="table-responsive-sm">
                    <tr>
                        <th scope="col">S.N.</th>
                        <th scope="col">Name of Service</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody id="serviceTableBody" class="table-responsive-sm">
                    <?php
                    $counter = 1;
                    foreach ($serviceArray as $item) {
                    ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td>
                            <a href="edit-service.php?id=<?= $item['id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
                  </table>
              </div>
          </div>
        <script src="./scripts/admin.js"></script>
</body>

</html>

