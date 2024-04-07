<?php
session_start();
include 'connect.php';

if (isset($_POST['submit'])) {
    $account = $_SESSION['username'];

    $stmt = $db->prepare("DELETE FROM students WHERE username = :username");
    $stmt->bindParam(':username', $account);
   
    if ($stmt->execute()) {
        // Unset all of the session variables
        session_destroy();
        // Redirect to index.php with success message
        header('location: ../login.php?msg=Account deleted successfully');
        exit(); // Make sure to exit after redirecting
    } else {
        // Redirect to index.php with error message
        $_SESSION['status'] = "Failed to delete data";
        header('location: ../login.php?msg=Failed to delete account');
        exit(); // Make sure to exit after redirecting
    }
}
?>