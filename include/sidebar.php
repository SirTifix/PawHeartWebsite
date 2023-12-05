<!-- sidebar.php -->

<style>
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: pink;
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidebar a {
        padding: 15px 8px 15px 32px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 10px 5px rgba(255, 255, 255, 0.2);
    }

    @media screen and (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: static;
            height: auto;
        }
    }
</style>

<div class="sidebar">
    <a href="./admin.php">Manage Appointments</a>
    <a href="./view-doctor.php">Manage Veterinarian</a>
    <a href="./add-doctor.php">Add Veterinarian</a>
    <a href="./remove-doctor.php">Remove Veterinarian</a>
    <a href="./view-service.php">Manage Service</a>
    <a href="./add-service.php">Add Service</a>
    <a href="./remove-service.php">Remove Service</a>
    <a href="../tools/logout.php">Log-out</a>
</div>
