<?php
session_start();
include 'connect.php';

// Check if the user is logged in


// Get the new email from the POST data
$newEmail = $_POST['new-email'];

// Get the username from the session
$username = $_SESSION['username'];

// Prepare UPDATE statement
$stmt = $db->prepare("UPDATE students SET email = :newEmail WHERE username = :username");

// Bind parameters
$stmt->bindParam(':newEmail', $newEmail);
$stmt->bindParam(':username', $username);

// Execute statement
try {
    $stmt->execute();
    
    // Redirect back to the settings page with a success message
    header('Location: ../settings.php?msg=Email updated successfully');
    exit();
} catch(PDOException $e) {
    // Handle exception
    // Redirect back to the settings page with an error message
    header('Location: ../settings.php?msg=Failed to update email');
    exit();
}
?>