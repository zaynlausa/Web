<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <title>Document</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,500&display=swap');

  body {
    background-color: #070606;
    font-family: 'DM Sans', sans-serif;

  }

  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
  }

  #messageContainer {
    position: absolute;
    top: 15%;
  }

  form {
    background-color: #191825;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 1);
    width: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-bottom-style: solid;
    border-bottom-width: 5px;
    border-bottom-color: #865DFF;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }


  input {
    width: 280px;
    border-radius: none;
    border-style: none;
    padding-left: 10px;

  }

  .material-symbols-outlined {
    padding-left: 10px;
    padding-right: 10px;
    display: flex;
    align-items: center;
    background-color: white;
    color: black;
    border-right-style: solid;
  }

  .usernames {

    display: flex;
    margin-bottom: 25px;

  }

  #username {
    padding-top: 10px;
    padding-bottom: 10px;
  }

  #login {
    border-radius: 20px;
    width: 305px;
    margin-top: 10px;
    padding-top: 8px;
    padding-bottom: 8px;
    color: #FFFFFF;
    transition: background-color .35s ease-in-out;
    background-color: #6A42FF;
  }

  #login:hover {
    background-color: #865DFF;
  }

  hr {
    width: 80%;
    margin-top: 40px;
    margin-bottom: 20px;
  }

  h1 {
    color: #865DFF;
  }

  a {
    text-decoration: none;
    color: #865DFF;
  }

  a:hover {
    text-decoration: underline;

  }

  .reg {
    color: white;
    font-size: 16px;
    display: flex;
    flex-direction: row;
    gap: 12px;
    margin-top: 20px;
    margin-bottom: 20px;
  }
  </style>
</head>

<body>
  <div class="container">


    <form action="server/login.php" method="post">
      <h1>Member Login</h1>
      <div class="usernames">
        <span class="material-symbols-outlined">
          person
        </span>
        <input id="username" type="text" name="username" placeholder="Enter Username" required>
      </div>


      <div id="messageContainer">
        <?php if(isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo '<p id="message" style="color: #3eff5d;">' . $msg. '</p>';
        }
        ?>
      </div>


      <div class="usernames">
        <span class="material-symbols-outlined">
          lock
        </span>
        <input id="username" type="password" name="password" placeholder="Enter Password" required>
      </div>
      <input type="submit" value="Login" id="login">
      <hr>

      <div class="reg">
        <div>No Account?</div>
        <div>
          <a href="register.php">Register Now</a>
        </div>
      </div>

    </form>


  </div>
  <script>
  // Remove the message after 5 seconds
  setsTimeout(() => {
    var message = document.getElementById('message');
    if (message && message.textContent !== '') {
      message.style.display = 'none';
    }
  }, 3000);
  </script>
</body>

</html>