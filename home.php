<?php



include 'nav.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}




// Logout logic
/*
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: index.php");
    exit();
  }
  */

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <style>
  * {
    margin: 0;
    padding: 0;

  }

  /*
  .container {
    background-color: red;
    height: 20 0px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  */
  </style>
</head>

<body>
  <!--
  <div class="container">
    <p>Your User ID: <?php echo $last_name; ?></p>
  </div>

-->
  <!-- 
  <table>
    <thead>
      <tr>
        <th>Subject</th>
        <th>Description</th>
        <th>Grade</th>
        <th>Unit</th>
        <th>Credit Units</th>
        <th>GPA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>CSC 104</td>
        <td>Description</td>
        <td>90</td>
        <td>2</td>
        <td>3</td>
        <td>270</td>
      </tr>
      <tr>
        <td>EEP 3</td>
        <td>Description</td>
        <td>92</td>
        <td>1</td>
        <td>2</td>
        <td>184</td>
      </tr>
    </tbody>
  </table>

  -->
  <!-- Logout form
  <form method="post" action="">
    <input type="submit" name="logout" value="Logout">
  </form>
  
-->

</body>

</html>