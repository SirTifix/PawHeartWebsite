<?php
//resume session here to fetch session values
session_start();
/*
    if user is not login then redirect to login page,
    this is to prevent users from accessing pages that requires
    authentication such as the dashboard
*/
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin'){
    header('location: ./index.php');
}
//if the above code is false then html below will be displayed

include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

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
$sqlAppointments = "SELECT COUNT(*) as appointmentCount FROM appointments";
$resultAppointments = $conn->query($sqlAppointments);
$rowAppointments = $resultAppointments->fetch_assoc();
$appointmentCount = $rowAppointments['appointmentCount'];

// Close the dbConnect connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- The rest of your head content -->
</head>
<body>

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

</body>
</html>
