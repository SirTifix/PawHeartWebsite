<?php
session_start();

require_once('../tools/user_functions.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Assuming authenticateUser returns user data if authentication is successful
    $user = authenticateUser($email, $password);

    if ($user) {
        // Store user information in the session
        $_SESSION['id'] = $user['id']; // Assuming the user array has an 'id' field
        $_SESSION['email'] = $user['email'];

        // Redirect to a protected page
        header('location: index.php');
        exit();
    } else {
        $error = 'Invalid username/email or password. Try again.';
    }
}
?>
