<?php
  include 'nav.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
    margin-top: 13px;

  }


  .password {
    padding-left: 12px;
  }

  .delete {
    background: linear-gradient(90deg, #A30000 0%, rgba(255, 0, 0, 1) 25%, rgba(128, 0, 0, 1) 50%, rgba(51, 0, 0, 1) 100%);
    font-weight: bold;
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

  .overview:hover,
  .email:hover,
  .password:hover,
  .info:hover {
    color: rgba(200, 150, 255, 1);
    background-color: rgba(106, 66, 255, 0.1);
  }


  ul {
    padding: 0px;
    /* animation: zoomIn 2.3s infinite; */

  }

  .display {
    border: 1px solid #A30000;
    background-color: #191825;
    width: 800px;
    border-radius: 12px;
  }


  hr {
    margin-right: 20px;
    color: #191825;
  }




  h1 {
    margin-left: 15px;

  }

  #submit {
    color: white;
    border: none;
    background-color: #A30000;
    border-radius: 4px;
    padding-bottom: 8px;
    padding-top: 8px;
    padding-left: 16px;
    padding-right: 16px;
    transition: background-color .20s ease-in-out;
  }

  #submit:hover {
    background-color: rgba(255, 0, 0, 0.4);
  }

  #forms {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .message {
    font-size: 13px;
    text-align: justify;
    width: 700px;
    margin-left: 45px;
  }

  h1 {
    margin-top: 10px;
    margin-bottom: 15px;
    color: #ffffff;
  }
  </style>
</head>

<body>
  <div id="messageContainer">
    <?php 
    if(isset($_GET['msg']) && !isset($_SESSION['msgDisplayed'])) {
      $msg = $_GET['msg'];
      echo '<p id="message" style="color: #3eff5d;">' . $msg. '</p>';
      $_SESSION['msgDisplayed'] = true;
    }
    ?>
  </div>

  <div class="container">

    <div class="sidebar">
      <a class="overview" href="settings.php">Overview</a>
      <a class="info" href="info.php">My Info</a>
      <a class="password" href="password.php">Password</a>
      <a class="email" href="email.php">Email Address</a>
      <a class="delete" href="#">Delete Account</a>

    </div>

    <!-- DISPLAY USERS PROFILE -->
    <div class="display">
      <h1 style="text-align: center; color:red;">Account Deletion</h1>
      <p class="message">&divonx; Deleting your account is an irreversible process. Once you confirm the deletion, all
        your
        data,
        preferences,
        saved settings, and history will be permanently removed from our platform. This includes any content you've
        created, your personal information, and any records of your interactions with our service. There's no turning
        back, and reinstating your account or retrieving any lost data will not be possible.
      </p>




      <form id="forms" action="server/delete.php" method="post">
        <input id="submit" type="submit" name="submit" value="Delete Account">
      </form>

    </div>



  </div>
  <script>
  function validateEmail() {
    var emailInput = document.querySelector('input[type="email"]');
    var emailError = document.getElementById("emailError");

    if (emailInput.value.trim() === "") {
      emailError.textContent = "*Email is required";
      return false;
    } else {
      emailError.textContent = "";
      return true;
    }
  }
  </script>

</body>

</html>