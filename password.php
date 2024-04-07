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
    background: linear-gradient(90deg, rgba(106, 66, 255, 1) 0%, rgba(74, 36, 196, 1) 52%, rgba(70, 0, 135, 1) 91%);
    margin-right: 18px;
    padding-left: 12px;
    padding-bottom: 4px;
    padding-top: 4px;
    border-radius: 6px;
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
  .password:hover,
  .delete:hover,
  .info:hover {
    color: rgba(200, 150, 255, 1);
    background-color: rgba(106, 66, 255, 0.1);
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


  .title {
    padding-top: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid black;
  }

  h1 {
    margin-left: 15px;

  }

  .title-display {
    font-weight: bold;
    margin-bottom: 5px;
  }


  .usr-email {
    font-size: 14px;
    margin-bottom: 10px;
  }

  .dis-name {
    margin-bottom: 20px;
    margin-left: 20px;
  }

  #new-pwd {
    width: 300px;
    padding-top: 8px;
    padding-left: 8px;
    padding-bottom: 8px;
    border: none;
    border-radius: 4px;
    background-color: white;
    margin-bottom: 4px;
  }

  #submit {
    background-color: white;
    border: none;
    border-radius: 20px;
    padding-bottom: 8px;
    padding-top: 8px;
    padding-left: 15px;
    padding-right: 15px;
  }


  .mensahe {
    margin-left: 40px;
    font-size: 14px;
  }
  </style>
</head>

<body>

  </div>

  <div class="container">

    <div class="sidebar">
      <a class="overview" href="settings.php">Overview</a>
      <a class="info" href="info.php">My Info</a>
      <a class="password" href="password.php">Password</a>
      <a class="email" href="email.php">Email Address</a>
      <a class="delete" href="delete.php">Delete Account</a>

    </div>

    <!-- DISPLAY USERS PROFILE -->
    <div class="display">
      <div class="display-all">
        <div class="title">
          <h1>
            Change Account Password
          </h1>
        </div>


        <div>
          <p class="mensahe" style="margin-bottom: 30px; margin-top: 16px; text-align:justify; margin-right: 80px;">
            &middot;
            You are changing your account password.</p>
        </div>

        <div class="dis-name">
          <div class="title-display">Current Password</div>
          <div class="usr-email">********</div>
        </div>
      </div>

      <div class="dis-name">
        <div class="title-display">New Password <span
            style="font-size: 12px;margin-left: 5px; color: #FE6128; font-weight:lighter;">REQUIRED</span></div>
        <!-- <div class="usr-email"> php echo $email </div> -->


        <form action="server/update_password.php" method="post" onsubmit="return validateEmail()">
          <div style="display: flex; flex-direction:column; margin:auto;">
            <input id="new-pwd" type="password" name="new-pwd" require>
            <p id="emailError" style="color: #FE6128; font-size: 12px; margin-bottom: 13px;"></p>
          </div>
          <input id="submit" type="submit" name="submit">
        </form>


      </div>
    </div>
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