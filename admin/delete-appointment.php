<?php
include '../classess/db.php';
$objDB = new dbConnect();
$conn = $objDB->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($appointmentId > 0) {
        // Perform the deletion
        $sql = "DELETE FROM appointment WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointmentId);

        if ($stmt->execute()) {
            echo 'Appointment deleted successfully';
        } else {
            echo 'Error: ' . $stmt->error;
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
