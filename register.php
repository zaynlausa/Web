<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,500&display=swap');


  body {
    background-color: #070606;
    font-family: 'DM Sans', sans-serif;
    font-size: 20px;


  }

  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
    max-width: 1200px;
    /* Use max-width with percentage for responsiveness */
    margin: 0 auto;
  }

  form {
    color: white;
    background-color: #191825;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 1);
    width: 680px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-bottom-style: solid;
    border-bottom-width: 5px;
    border-bottom-color: #865DFF;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    margin-top: 40px;
    margin-bottom: 100px;



  }

  #messageContainer {
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    top: 20px;
  }



  h4 {
    color: #865DFF;
    font-weight: 500;
  }

  #form-acc {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
  }

  .form-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
  }

  #region,
  #province,
  #city,
  #barangay {
    width: 218px;
  }

  .account-info {
    margin-left: -150px;
    width: 430px;
  }

  .personal-info {
    margin-left: -150px;
    width: 430px;
  }

  #submit {
    margin-top: 40px;
    background-color: #6A42FF;
    border: none;
    border-radius: 120px;
    color: #ffffff;
    font-size: 30px;
    padding: 10px 100px 10px 100px;
    border-bottom-style: solid;
    border-bottom-color: #9E85FF;
  }

  #holder,
  #password,
  #checkpass,
  #confpass {
    width: 205px;
    padding-left: 8px;
    /* Ensure padding and border are included in the width and height */
    transition: box-shadow 0.3s ease-in-out;
    /* Smooth transition for the box-shadow */
    padding-top: 5px;
    padding-bottom: 5px;
  }

  #holder:focus,
  #password:focus,
  #checkpass:focus {
    box-shadow: 0 0 10px #00f;
    /* Add glow effect with blue color when input is focused */
  }
  </style>
</head>

<body>
  <div id="messageContainer">
    <?php 
    if(isset($_GET['message']) && !isset($_SESSION['msgDisplayed'])) {
      $msg = $_GET['message'];
      echo '<p style="color: #3eff5d; margin:0;">' . $msg. '</p>';
      $_SESSION['msgDisplayed'] = true;
    }
    ?>
  </div>

  <div class="container">

    <form action="server/register.php" method="post">
      <div style="display: flex; flex-direction:row; justify-content:start; width: 84%; gap: 15px;">
        <h1>REGISTER</h1>
        <p style="margin-top: 47px; font-size: 20px;">Don't Have Account? SignUp!</p>
      </div>
      <!-- START OF ACCOUNT INFO -->
      <div class="account-info">
        <h4>Account Information</h4>


        <div id="form-acc">
          <label for="username">&#183; Username </label>
          <div>
            <input id="holder" type="text" name="username" placeholder="Enter Username" required>
            <span class="username-feedback" style="font-size:12px; margin:0px;"></span>

          </div>
        </div>

        <div id="form-acc" style="margin-bottom: 0px; margin-top:0px; ">
          <label for="password">&#183; Password </label>

          <div>
            <input id="password" class="holder" type="password" name="password" placeholder="Enter Password" required>
            <p id="message" style="font-size: 12px;color:#FE6128;">
            </p>
          </div>

        </div>

        <div id="form-acc" style="margin-top:0px; margin-bottom:0px;">
          <label for="confpass">&#183; Confirm Password </label>
          <div>
            <input style="margin-left: auto;" id="confpass" class="holder" type="password" name="checkpass"
              placeholder="Confirm Password" required>
            <p id="confpassMessage" style="font-size: 12px; color: #FE6128"></p>
          </div>
        </div id="form-acc">



        <div id="form-acc">
          <label for="email">&#183; Email </label>
          <input id="holder" type="email" name="email" required>
        </div>

      </div>

      <!-- END OF ACCOUNT INFO -->

      <!-- START OF PERSONAL INFO -->
      <div class="personal-info">
        <h4>Personal Information</h4>

        <div id="form-acc">
          <label for="fname">&#183; First Name </label>
          <input id="holder" type="text" name="fname" required>
        </div>

        <div id="form-acc">
          <label for="mname">&#183; Middle Name<span
              style="font-style:italic; font-size: 17px; color: #999999;">(optional)</span>
          </label>
          <input id="holder" type="text" name="mname">
        </div>

        <div id="form-acc">
          <label for="lname">&#183; Last Name</label>
          <input id="holder" type="text" name="lname" required>
        </div>

        <div id="form-acc">
          <label for="phonenum">&#183; Phone Number <span
              style="font-style:italic; font-size: 17px; color: #999999;">(0-9)</label>
          <input id="holder" type="tel" name="phonenum" pattern="[0-9]*" required>
        </div>

        <!--start LUGAR FROM PEOPLE FROM THE EARTH -->
        <div class="lugars" style="margin-bottom: 20px;">

          <div class="form-group">
            <label for="region">&#183; Region</label>
            <select id="region" name="region" class="form-select" onchange="fetch_provinces()">
              <option></option>
            </select>
          </div>

          <div class="form-group" style="display:none">
            <label for="region">&#183; Region</label>
            <select id="region1" name="region1" class="form-select">
              <option></option>
            </select>
          </div>

          <div class="form-group">
            <label for="province">&#183; Province</label>
            <select id="province" name="province" class="form-select" onchange="fetch_cities()">
              <option></option>
            </select>
          </div>

          <div class="form-group" style="display:none">
            <label for="province">&#183; Province</label>
            <select id="province1" name="province1" class="form-select">
              <option></option>
            </select>
          </div>

          <div class="form-group">
            <label for="city">&#183; City</label>
            <select id="city" name="city" class="form-select" onchange="fetch_barangays()">
              <option></option>
            </select>
          </div>

          <div class="form-group" style="display:none">
            <label for="city">&#183; City</label>
            <select id="city1" name="city1" class="form-select" onchange="fetch_barangays()">
              <option></option>
            </select>
          </div>

          <div class="form-group">
            <label for="barangay">&#183; Barangay</label>
            <select id="barangay" name="barangay" class="form-select">
              <option></option>
            </select>
          </div>


          <!--

       -->


        </div>
        <!--end LUGAR FROM PEOPLE FROM THE EARTH -->


        <div id="form-acc">
          <label for="secret_ques">&#183; Secret Question </label>
          <input id="holder" type="text" name="secret_ques" required>
        </div>

        <div id="form-acc">
          <label for="answer">&#183; Answer </label>
          <input id="holder" type="text" name="answer" required>
        </div>
      </div>
      <!-- END OF PERSONAL INFO -->


      <div style="display: flex; flex-direction: row; gap: 10px; margin-left: -240px; margin-top: 30px;">

        <input type="checkbox" id="checkcon">
        <label style="width: 100%;">
          I agree to the <a style="text-decoration: none; color: #9E85FF; cursor: pointer;">terms and conditions
        </label>
      </div>

      <input type="submit" name="submit" id="submit" value="Create Account">

    </form>
  </div>


  </div>
  <script type="text/javascript">
  // Function to validate password
  function validatePassword() {
    var password = document.getElementById("password").value;
    var message = document.getElementById("message");
    var confpass = document.getElementById("confpass").value;
    var confpassMessage = document.getElementById("confpassMessage");
    var submitButton = document.getElementById("submit");

    if (password.trim() === "") {
      message.textContent = "Password is required";
      submitButton.disabled = true; // Disable submit button
      return;
    }

    // Check password length
    if (password.length < 8 || password.length > 16) {
      message.textContent = "Password must have 8 to 16 characters";
      submitButton.disabled = true; // Disable submit button
    } else {
      message.textContent = ""; // Clear message if password length is valid
    }

    // Check if confirmation password is empty
    if (confpass.trim() === "") {
      confpassMessage.textContent = ""; // Clear confirm password message if empty
      submitButton.disabled = true; // Disable submit button
    } else {
      // Check if passwords match
      if (password !== confpass) {
        confpassMessage.textContent = "These Passwords Don't Match";
        submitButton.disabled = true; // Disable submit button
      } else {
        confpassMessage.textContent = ""; // Clear message if passwords match
        submitButton.disabled = false; // Enable submit button
      }
    }
  }

  // Attach input event listeners to password and confirm password fields
  document.getElementById("password").addEventListener("input", validatePassword);
  document.getElementById("confpass").addEventListener("input", validatePassword);

  // Function to handle form submission
  document.getElementById("submit").addEventListener("click", function(event) {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confpass").value;
    var message = document.getElementById("message");
    var confpassMessage = document.getElementById("confpassMessage");

    // Check password length
    if (password.length < 8 || password.length > 16) {
      message.textContent = "Password must have 8 to 16 characters";
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Check if confirmation password is empty
    if (confirmPassword.trim() === "") {
      confpassMessage.textContent = "Confirm Password is required";
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
      confpassMessage.textContent = "These Passwords Don't Match";
      event.preventDefault(); // Prevent form submission
      return;
    }

    // If all validations pass, form will submit
  });

  // Button should be disabled if "Terms and Conditions" is not checked.
  var submitButton = document.getElementById('submit');
  var checkbox = document.getElementById('checkcon');

  // Set initial state of the submit button
  submitButton.disabled = true;

  checkbox.addEventListener('change', function() {
    submitButton.disabled = !this.checked;
  });

  document.getElementById('submit').addEventListener('click', function(event) {
    if (!checkbox.checked) {
      alert('Please check the box');
      event.preventDefault(); // Prevent form submission
    }
  });
  </script>



  <!--

    <script>
    // Remove the message after 5 seconds
    setTimeout(() => {
      var message = document.getElementById('message');
      if (message && message.textContent !== '') {
        message.style.display = 'none';
      }
    }, 3000);


    // Button should be disabled if "Terms and Conditions" is not checked.
    var submitButton = document.getElementById('submit');
    var checkbox = document.getElementById('checkcon');

    // Set initial background color
    if (!checkbox.checked) {
      submitButton.style.backgroundColor = '#11004f';
    }

    checkbox.addEventListener('change', function() {
      submitButton.disabled = !this.checked;
      if (submitButton.disabled) {
        submitButton.style.backgroundColor = '#11004f'; // Change background color to red if disabled
      } else {
        submitButton.style.backgroundColor = ''; // Revert to default background color if enabled
      }
    });

    document.getElementById('submit').addEventListener('click', function(event) {
      if (!checkbox.checked) {
        alert('Please check the box');
        event.preventDefault(); // Prevent form submission
      }
    });

-->

  <script>
  // PSCG API: Regions

  fetch(`https://psgc.gitlab.io/api/regions/`)
    .then(response => response.json())
    .then(data => {

      const regionsSelect = document.getElementById('region');
      data.sort((a, b) => a.name.localeCompare(b.name));
      data.forEach(region => {
        const option = document.createElement('option');
        option.value = region.code;
        option.textContent = region.name;
        regionsSelect.appendChild(option);
      });
    });

  fetch(`https://psgc.gitlab.io/api/regions/`)
    .then(response => response.json())
    .then(data => {

      const regionsSelect = document.getElementById('region1');
      data.sort((a, b) => a.name.localeCompare(b.name));
      data.forEach(region => {
        const option = document.createElement('option');
        option.value = region.name;
        option.textContent = region.name;
        regionsSelect.appendChild(option);
      });
    });


  // PSGC API: Provinces

  async function fetch_provinces() {

    var r1 = document.getElementById('region');
    var r2 = document.getElementById('region1');
    r2.value = r1.options[r1.selectedIndex].text;

    const region = document.getElementById('region').value;

    fetch(`https://psgc.gitlab.io/api/regions/` + region + `/provinces/`)
      .then(response => response.json())
      .then(data => {

        const provincesSelect = document.getElementById('province');
        const buffer = document.createElement('option');

        provincesSelect.innerHTML = '';
        provincesSelect.appendChild(buffer);

        data.sort((a, b) => a.name.localeCompare(b.name));
        data.forEach(province => {
          const option = document.createElement('option');
          option.value = province.code;
          option.textContent = province.name;
          provincesSelect.appendChild(option);
        });
      });


    fetch(`https://psgc.gitlab.io/api/regions/` + region + `/provinces/`)
      .then(response => response.json())
      .then(data => {

        const provincesSelect = document.getElementById('province1');
        const buffer = document.createElement('option');

        provincesSelect.innerHTML = '';
        provincesSelect.appendChild(buffer);

        data.sort((a, b) => a.name.localeCompare(b.name));
        data.forEach(province => {
          const option = document.createElement('option');
          option.value = province.name;
          option.textContent = province.name;
          provincesSelect.appendChild(option);
        });
      });
  }

  // PSGC API: Cities

  async function fetch_cities() {


    var p1 = document.getElementById('province');
    var p2 = document.getElementById('province1');
    p2.value = p1.options[p1.selectedIndex].text;


    const province = document.getElementById('province').value;

    fetch(`https://psgc.gitlab.io/api/provinces/` + province + `/cities-municipalities/`)
      .then(response => response.json())
      .then(data => {

        const citiesSelect = document.getElementById('city');
        const buffer = document.createElement('option');

        citiesSelect.innerHTML = '';
        citiesSelect.appendChild(buffer);

        data.sort((a, b) => a.name.localeCompare(b.name));
        data.forEach(city => {
          const option = document.createElement('option');
          option.value = city.code;
          option.textContent = city.name;
          citiesSelect.appendChild(option);
        });
      });

    fetch(`https://psgc.gitlab.io/api/provinces/` + province + `/cities-municipalities/`)
      .then(response => response.json())
      .then(data => {

        const citiesSelect = document.getElementById('city1');
        const buffer = document.createElement('option');

        citiesSelect.innerHTML = '';
        citiesSelect.appendChild(buffer);

        data.sort((a, b) => a.name.localeCompare(b.name));
        data.forEach(city => {
          const option = document.createElement('option');
          option.value = city.name;
          option.textContent = city.name;
          citiesSelect.appendChild(option);
        });
      });


  }

  // PSGC API: Barangays

  async function fetch_barangays() {
    var c1 = document.getElementById('city');
    var c2 = document.getElementById('city1');
    c2.value = c1.options[c1.selectedIndex].text;

    const city = document.getElementById('city').value;

    fetch(`https://psgc.gitlab.io/api/cities-municipalities/` + city + `/barangays/`)
      .then(response => response.json())
      .then(data => {

        const barangaysSelect = document.getElementById('barangay');
        const buffer = document.createElement('option');

        barangaysSelect.innerHTML = '';
        barangaysSelect.appendChild(buffer);

        data.sort((a, b) => a.name.localeCompare(b.name));
        data.forEach(barangay => {
          const option = document.createElement('option');
          option.value = barangay.name;
          option.textContent = barangay.name;
          barangaysSelect.appendChild(option);
        });
      });

  }
  </script>
</body>

</html>