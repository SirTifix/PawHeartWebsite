<?php
require_once '../classess/user.class.php';
require_once '../tools/functions.php';
require_once '../tools/user_functions.php';
require_once '../classess/user.class.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Establish a database connection
require_once '../classess/db.php';  // Include the file that defines the dbConnect class
$db = new dbConnect();
$conn = $db->connect();

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM paw WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

echo "Session Email: " . $_SESSION['email'];  // Debugging output

if (!$result) {
    die("Paw query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "Email found in 'paw' table.";  // Debugging output
    
    // Fetch data from the 'appointment' table
    $appointmentSql = "SELECT * FROM appointment WHERE email = ?";
    $appointmentStmt = $conn->prepare($appointmentSql);
    $appointmentStmt->bind_param('s', $_SESSION['email']);
    $appointmentStmt->execute();
    $appointmentResult = $appointmentStmt->get_result();

    if (!$appointmentResult) {
        die("Appointment query failed: " . $conn->error);
    }
} else {
    echo "Email not found in verification table (paw).";  // Debugging output
}

?>

<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href=".no-bg-bg-48.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/appointment_form.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="../styles/appointment_form.css">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/f584623432.js" crossorigin="anonymous"></script>
    <title>Book Appointment</title>
<body>
<?php
  require_once('../include/header.loggedin.php');
?>   
<!-- Appointments List -->
<div class="container mt-3">
        <h2 class="text-center mb-4">Appointment List</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Pet Type</th>
                        <th scope="col">Pet Name</th>
                        <th scope="col">Pet Age</th>
                        <th scope="col">Pet Amount</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Time</th>
                        <th scope="col">Symptoms</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Display appointment information
if (isset($appointmentResult) && $appointmentResult->num_rows > 0) {
    while ($row = $appointmentResult->fetch_assoc()) {
        // Add date formatting if needed
        $row['appointment_date'] = date('Y-m-d', strtotime($row['appointment_date']));
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['contact_number']}</td>
                <td>{$row['doctor_name']}</td>
                <td>{$row['pet_type']}</td>
                <td>{$row['petName']}</td>
                <td>{$row['petAge']}</td>
                <td>{$row['petAmount']}</td>
                <td>{$row['appointment_date']}</td>
                <td>{$row['appointment_time']}</td>
                <td>{$row['symptoms']}</td>
            </tr>";
    }
} else {
    // No appointments
    echo '<tr><td colspan="11">No Data Available</td></tr>';
}
                    ?>
                </tbody>
            </table>
        </div>
    <?php require_once('../include/footer.php'); ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>


</body> 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

</html>
