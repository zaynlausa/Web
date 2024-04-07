<?php
session_start();

if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: login.php");
  exit();
}

if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == '') {
  $_SESSION = array();
  // Destroy the session
  session_destroy();
  // Redirect to login page or another appropriate page
  header("Location: login.php");
  exit();
}

// Logout logic
if (isset($_POST['logout'])) {
  // Unset all session variables
  $_SESSION = array();
  // Destroy the session
  session_destroy();
  // Redirect to the login page
  header("Location: login.php");
  exit();
}


include 'server/read_data.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,500&display=swap');

  * {
    margin: 0;
    padding: 0;

  }

  body {
    color: #ffffff;
    background-color: #070606;
    font-family: 'DM Sans', sans-serif;

  }

  .navigation-bar {
    background-color: #191825;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .greet {
    margin-left: 50px;
    font-size: 30px;
  }

  button {
    font-size: 30px;
    margin-right: 20px;
    background: none;
    border: none;
  }

  button:active {
    cursor: pointer;
  }

  #logout:hover {
    cursor: pointer;
  }

  #logout,
  a {
    background: none;
    border-style: none;
    color: white;
    text-decoration: none;
  }

  #nav-right {
    display: flex;
    flex-direction: row;
    gap: 20px;
    margin: 0px;
    height: 33px;
    display: flex;
    align-items: center;
  }
  </style>
</head>

<body>
  <div class="navigation-bar">



    <div class="greet">
      <a href="home.php" title="home">Hello, <?php echo ucfirst($first_name)?></a>
    </div>

    <div id="nav-right">


      <a href="shop.php" title="shop now" class="material-symbols-outlined">
        <span class="material-symbols-outlined">
          shopping_cart
        </span>
      </a>
      <a href="myorder.php" title="my orders" class="material-symbols-outlined">
      <span class="material-symbols-outlined">
shopping_bag
</span>
      </a>
      
      <a href="settings.php" title="settings" class="material-symbols-outlined">
        settings
      </a>

      <form method="post" action="" style="height: 25px;">
        <button title="logout"  class="material-symbols-outlined" id="logout" type="submit" name="logout">
          logout
        </button>
      </form>
    </div>

  </div>
</body>

</html>