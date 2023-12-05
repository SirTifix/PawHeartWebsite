<?php
include '../classess/db.php';

$objDB = new dbConnect();
$conn = $objDB->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $appointmentId = isset($_POST['editId']) ? intval($_POST['editId']) : 0;
    $newDate = isset($_POST['editDate']) ? $_POST['editDate'] : '';
    $newTime = isset($_POST['editTime']) ? $_POST['editTime'] : '';
    $newName = isset($_POST['newName']) ? $_POST['newName'] : '';
    $newDoctor = isset($_POST['doctor_name']) ? $_POST['doctor_name'] : '';

    if ($appointmentId > 0) {
        // Perform the update
        $sql = "UPDATE appointment SET appointment_date = ?, appointment_time = ?, name = ?, doctor_name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $newDate, $newTime, $newName, $newDoctor, $appointmentId);

        if ($stmt->execute()) {
            echo 'Appointment updated successfully';
        } else {
            echo 'Error updating appointment: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo 'Invalid appointment ID';
    }
} else {
    echo 'Invalid request method';
}

$conn->close();
?>
