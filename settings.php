<?php
//session_start(); // Start the session if not already started
include 'nav.php';

if (!isset($_SESSION['username'])) {
  // Redirect to the login page
  header("Location: index.php");
  exit(); // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve new username from the form submission
    $new_username = $_POST['new_username'];

    // Prepare and execute SQL update statement to update the username
    $stmt = $db->prepare("UPDATE students SET username = :username WHERE username = :current_username");
    $stmt->bindParam(':username', $new_username); // Bind new username parameter
    $stmt->bindParam(':current_username', $_SESSION['username']); // Bind current username parameter

    // Execute the statement
    if ($stmt->execute()) {
        // Update the username stored in the session
        $_SESSION['username'] = $new_username;

        // Redirect to the profile or home page
        header("Location: settings.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Failed to update username.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles/styless.php">
  <style>
  body {
    background-color: #070606;

  }

  .container {
    margin-left: 30px;
    margin-top: 180px;
    display: flex;
    flex-direction: row;
    gap: 34px;
    height: 400px;

  }

  .sidebar {
    text-decoration: none;
    font-size: 15px;
    display: flex;
    flex-direction: column;
    background-color: #191825;
    list-style-type: none;
    width: 200px;
    border-radius: 12px;
    height: 215px;
  }

  li {
    margin-left: 15px;
    margin-bottom: 20px;
  }

  .overview {
    font-weight: bold;
    background: linear-gradient(90deg, rgba(106, 66, 255, 1) 0%, rgba(74, 36, 196, 1) 52%, rgba(70, 0, 135, 1) 91%);
    border-radius: 6px;
    margin-top: 13px;
    margin-right: 18px;
    padding-left: 12px;
    padding-bottom: 4px;
    padding-top: 4px;

  }

  ul {
    padding: 0px;
    /* animation: zoomIn 2.3s infinite; */

  }


  .display {

    background-color: #191825;
    width: 800px;
    border-radius: 12px;
  }

  .display-all {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 30px;
    margin-left: 18px;
  }

  .title-display {
    font-weight: bold;
  }

  .usr-name,
  .usr-email,
  .usr-pwd,
  .usr-status {
    font-size: 14px;
  }

  .usr-status {
    margin-top: 10px;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-right: 24px;
    background-color: #6A42FF;
    border-radius: 3px;
    padding-top: 3px;
    padding-bottom: 3px;
  }

  .usr-status .text {
    margin-left: 5px;
  }

  .dis-email,
  .dis-pwd {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }

  .dis-email .change,
  .dis-pwd .change {
    font-size: 14px;
    margin-right: 20px;
  }

  .change {
    padding: 8px 18px;
    border-radius: 20px;
    transition: background-color ease-in-out .4 s;
  }

  .change:hover {
    background-color: rgba(127, 17, 224, 0.1);
  }

  hr {
    margin-right: 20px;
    color: #191825;
  }

  @keyframes zoomIn {
    0% {
      transform: scale(0);
      opacity: 0;
    }

    50% {
      opacity: 1;
    }

    100% {
      transform: scale(1);
      opacity: 0;
    }
  }

  .overview,
  .email,
  .password,
  .delete,
  .info {
    margin-bottom: 13px;
    margin-left: 10px;
    border-radius: 6px;
    padding-left: 12px;
    padding-bottom: 4px;
    padding-top: 4px;
    transition: background-color .2s ease-in, color .2s ease-in;
    margin-right: 18px;
  }

  .email:hover,
  .password:hover,
  .delete:hover,
  .info:hover {
    color: rgba(200, 150, 255, 1);
    background-color: rgba(106, 66, 255, 0.1);
  }




  hr {
    margin-right: 20px;
    border: none;
    height: 0.3px;
    background-color: #460087;

  }


  #messageContainer {
    position: absolute;
    top: 130px;
    left: 33%;
    font-size: 20px;
  }
  </style>
</head>

<body>
  <!-- SIDEBAR  -->
  <div class="container">

    <div class="sidebar">
      <a class="overview" href="">Overview</a>
      <a class="info" href="info.php">My Info</a>
      <a class="password" href="password.php">Password</a>
      <a class="email" href="email.php">Email Address</a>
      <a class="delete" href="delete.php">Delete Account</a>

    </div>

    <!-- DISPLAY USERS PROFILE -->
    <div class="display">

      <div id="messageContainer">
        <?php if(isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo '<p id="message" style="color: #3eff5d;">' . $msg. '</p>';
        }
        ?>
      </div>


      <div class="display-all">

        <div class="dis-name">
          <div class="title-display">Display Name</div>
          <div class="usr-name"><?php echo $first_name?></div>
        </div>

        <hr>

        <div class="dis-email">
          <div>
            <div class="title-display">Email Address</div>
            <div class="usr-email"><?php echo $email?></div>
          </div>
          <div class="change">
            <a href="email.php" style="margin-top: 20px; ">Change</a>
          </div>
        </div>

        <hr>


        <div class="dis-pwd">
          <div>
            <div class="title-display">Password</div>
            <div class="usr-pwd">*******</div>
          </div>
          <div class="change">
            <a href="password.php" style="margin-top: 20px; ">Change</a>
          </div>
        </div>


        <div class="dis-status">
          <div class="title-display">
            User Status
          </div>
          <div class="usr-status">
            <p class="text">You are so fucking 100% despressed!</p>
          </div>
        </div>

      </div>

    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function() {
    var messageContainer = document.getElementById("messageContainer");

    setTimeout(function() {
      messageContainer.style.display = "none";
    }, 3000);
  });
  </script>
  <!--
  <form action="" method="post">
    <label for="new_username">New Username:</label>
    <input type="text" name="new_username" required>
    <input type="submit" value="Submit">
  </form>

  <form action="server/delete.php" method="post">
    <label for="delete">Delete Account</label>
    <input type="submit" name="delete_student_button" value="Delete Account">
  </form>
-->
</body>

</html>