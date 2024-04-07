<?php

include 'server/connect.php';
$username = "";
$user_id = "";
$first_name = "";
$middle_name = "";
$last_name = "";
$email = "";
$phone_num = "";
$secret_question = "";
$pwd = "";
$region = "";

try {
    // Prepare SQL statement to select user_id and username
    $stmt = $db->prepare("SELECT user_id, username, first_name, middle_name,last_name, email, phone_num, secret_question, pwd, region, province, city, barangay FROM students WHERE username = :username");
    
    // Bind parameter (replace 'example_username' with the actual username)
    $username = $_SESSION['username'];
    $stmt->bindParam(':username', $username);
    
    // Execute SQL statement
    $stmt->execute();
    
    // Fetch user_id and username
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Display user_id and username
    if ($row) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone_num = $row['phone_num'];
        $secret_question = $row['secret_question'];
        $pwd = $row['pwd'];
        $region = $row['region'];
        $province = $row['province'];
        $city = $row['city'];
        $barangay = $row['barangay'];
    } else {
        $user_id = "User not found.";
        $email = "User not found.";
        $first_name = "User not found.";
        $middle_name = "User not found";
        $last_name = "User not_found";
        $phone_num = "User not_found";
        $secret_question = "User not_found";
        $pwd = "User not_found";
        $region = "User not_found";
        $province = "User not_found";
        $city = "User not_found";
        $barangay = "User not_found";
        $username = $_SESSION['username']; // Use session username if database query fails
    }
} catch(PDOException $e) {
    $user_id = "Error: " . $e->getMessage();
}
?>