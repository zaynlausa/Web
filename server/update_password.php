<?php
session_start();
include 'connect.php';

// Check if the user is logged in


// Get the new email from the POST data
$newPwd = $_POST['new-pwd'];

// Get the username from the session
$username = $_SESSION['username'];

// Prepare UPDATE statement
$stmt = $db->prepare("UPDATE students SET pwd = MD5(:newPwd) WHERE username = :username");

// Bind parameters
$stmt->bindParam(':newPwd', $newPwd);
$stmt->bindParam(':username', $username);

// Execute statement
try {
    $stmt->execute();
    
    // Redirect back to the settings page with a success message
    header('Location: ../settings.php?msg=Password updated successfully');
    exit();
} catch(PDOException $e) {
    // Handle exception
    // Redirect back to the settings page with an error message
    header('Location: ../settings.php?msg=Failed to update password');
    exit();
}
?>