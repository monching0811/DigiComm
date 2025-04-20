<?php
session_start();

// Destroy all session data
session_destroy();

setcookie(session_name(), '', time() - 3600, '/'); // Tanggalin ang session cookie

// Redirect to the login page
header("Location: login.php");
exit();
?>