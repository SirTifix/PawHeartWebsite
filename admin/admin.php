<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

$sql = "SELECT * FROM appointment";
$result = $conn->query($sql);

$sql = "SELECT appointment.*, paw.*
        FROM appointment
        INNER JOIN paw ON appointment.user_id = paw.user_id";

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Count veterinarians
$sqlVeterinarians = "SELECT COUNT(*) as vetCount FROM veterinarians";
$resultVeterinarians = $conn->query($sqlVeterinarians);
$rowVeterinarians = $resultVeterinarians->fetch_assoc();
$veterinarianCount = $rowVeterinarians['vetCount'];

// Count services
$sqlServices = "SELECT COUNT(*) as serviceCount FROM services";
$resultServices = $conn->query($sqlServices);
$rowServices = $resultServices->fetch_assoc();
$serviceCount = $rowServices['serviceCount'];

// Count appointments
$sqlAppointments = "SELECT COUNT(*) as appointmentCount FROM appointment";
$resultAppointments = $conn->query($sqlAppointments);
$rowAppointments = $resultAppointments->fetch_assoc();
$appointmentCount = $rowAppointments['appointmentCount'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Manage Appointment</title>
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href=".../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/no-bg-bg.png" type="image/x-icon">
</head>

<body>
    <?php
    require_once '../include/header.admin.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include '../include/sidebar.php'; ?>

            <div id="after-nav" class="col-md-10">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Your content goes here -->

                        <style>
                            /* Add some basic styles for the box container */
                            .dashboard-container {
                                display: flex;
                                justify-content: space-between; /* Adjust as needed */
                            }

                            /* Add some basic styles for the box */
                            .dashboard-box {
                                width: 300px;
                                height: 200px;
                                background-color: rgb(198, 162, 211); /* Set the background color */
                                border: 1px solid #ccc;
                                border-radius: 8px;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                align-items: center;
                                margin: 20px;
                            }

                            /* Additional styling for content inside the box */
                            .dashboard-box h2, .dashboard-box p {
                                color: #333;
                                font-size: 24px; /* Adjust the font size as needed */
                            }
                        </style>

                        <div class="col-md-12">
                            <div class="box">
                                <h1 style="text-align: center;">Dashboard</h1>

                                <div class="dashboard-container">

                                    <div class="dashboard-box">
                                        <h3>Veterinarians Count</h3>
                                        <p><?php echo $veterinarianCount; ?></p>
                                    </div>

                                    <div class="dashboard-box">
                                        <h3>Services Count</h3>
                                        <p><?php echo $serviceCount; ?></p>
                                    </div>

                                    <div class="dashboard-box">
                                        <h3>Appointments Count</h3>
                                        <p><?php echo $appointmentCount; ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="chek">
                                <!-- Your select elements here -->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Appointment Id</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Owner Name</th>
                                            <th scope="col">Veterinarian</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Check if there are appointments
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['appointment_date']}</td>
                                                    <td>{$row['appointment_time']}</td>
                                                    <td>{$row['name']}</td>
                                                    <td>{$row['doctor_name']}</td>
                                                    <td>
                                                    <button onclick=\"deleteAppointment({$row['id']})\"
                                                        class=\"btn btn-danger\">Delete</button>
                                                    <button onclick=\"editAppointment({$row['id']})\"
                                                        class=\"btn btn-success\">Edit</button>
                                                    </td>
                                                </tr>";
                                            }
                                        } else {
                                            // No appointments
                                            echo '<tr><td colspan="5">No Data Available</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Your JavaScript code here
    </script>

    <?php
    // Close the dbConnect connection
    $conn->close();
    ?>
</body>

</html>
