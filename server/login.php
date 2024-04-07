<?php
session_start();

if(isset($_SESSION['username'])) {
    // If user is already logged in, redirect to home page
    header("Location: ../home.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include "connect.php";
     
    // Retrieve username and password from the POST data
	$username = $_POST['username'];
	$password = $_POST['password'];

    try {
        // Prepare and execute the SQL query to check the username and password
        $stmt = $db->prepare("SELECT * FROM students WHERE username = :username AND pwd = MD5(:password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If login is successful, set session variables and redirect to home page
            $_SESSION['username'] = $username;
            header("Location: ../home.php");
            exit();
        } else {
            // If login fails, redirect back to login page with error message
            header('Location: ../login.php?msg=Wrong Username Or Password');
            exit();
        }
        
    } catch (PDOException $e) {
        // Handle database error
        echo "SQL Error: " . $e->getMessage();
    }
}

// If user accesses login.php directly without submitting the form, redirect to login page
header("Location: ../login.php");
exit();
?>