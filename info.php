<?php
//session_start(); // Start the session if not already started
include 'nav.php';

if (!isset($_SESSION['username'])) {
  // Redirect to the login page
  header("Location: index.php");
  exit(); // Stop further execution
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
    height: auto;


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

  .info {
    font-weight: bold;
    background: linear-gradient(90deg, rgba(106, 66, 255, 1) 0%, rgba(74, 36, 196, 1) 52%, rgba(70, 0, 135, 1) 91%);
    border-radius: 6px;
    margin-right: 18px;
    padding-left: 12px;
    padding-bottom: 4px;

  }

  ul {
    padding: 0px;
    /* animation: zoomIn 2.3s infinite; */

  }



  .overview {
    margin-top: 13px;

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
  .overview:hover {
    color: rgba(200, 150, 255, 1);
    background-color: rgba(106, 66, 255, 0.1);
  }




  hr {
    margin-right: 20px;
    border: none;
    height: 0.3px;
    background-color: #460087;

  }

  .display {
    background-color: #191825;
    width: 800px;
    border-radius: 12px;
    border-top: 2px solid #6A42FF;
  }

  .display-all {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 30px;
    margin-left: 20px;
  }

  .fullname {
    display: flex;
    gap: 150px;
  }

  .bold {
    font-weight: bold;
    margin-bottom: 0px;
  }

  .names {
    display: flex;
    flex-direction: column;
  }

  h1 {
    margin-left: 15px;
    margin-top: 15px;
  }

  .data {
    font-size: 14px;
  }
  </style>
</head>

<body>
  <!-- SIDEBAR  -->
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
      <h1>Account Info</h1>
      <div class="display-all">

        <div class="fullname">

          <div class="names">
            <div class="bold">First Name: </div>
            <div class="data"><?php echo $first_name?></div>
          </div>

          <div class="names">
            <div class="bold">Middle Name:</div>
            <div class="data"><?php echo $middle_name?></div>
          </div>

          <div class="names">
            <div class="bold">Last Name:</div>
            <div class="data"><?php echo $last_name?></div>
          </div>

        </div>


        <div class="names">
          <div class="bold">Username:</div>
          <div class="data"><?php echo $username?></div>
        </div>

        <div class="names">
          <div class="bold">Password:</div>
          <div class="data">********</div>
        </div>

        <div class="names">
          <div class="bold">Email:</div>
          <div class="data"><?php echo $email?></div>
        </div>

        <div class="names">
          <div class="bold">Phone Number:</div>
          <div class="data"><?php echo $phone_num?></div>
        </div>

        <div class="names">
          <div class="bold">Region:</div>
          <div class="data"><?php echo $region?></div>
        </div>


        <div class="names">
          <div class="bold">Province:</div>
          <div class="data"><?php echo $province?></div>
        </div>


        <div class="names">
          <div class="bold">City:</div>
          <div class="data"><?php echo $city?></div>
        </div>


        <div class="names">
          <div class="bold">Barangay:</div>
          <div class="data"><?php echo $barangay?></div>
        </div>

        <div class="names">
          <div class="bold">Secret Question</div>
          <div class="data"><?php echo $secret_question?></div>
        </div>

        <div class="names">
          <div class="bold">Secret Answer</div>
          <div class="data">********</div>
        </div>






      </div>



    </div>

  </div>
  </div>


</body>

</html>