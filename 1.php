<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }

      .container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }

      h2 {
        text-align: center;
        color: #333;
      }

      .form-group {
        margin-bottom: 20px;
      }

      label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"],
      input[type="tel"],
      input[type="date"],
      select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }

      input[type="submit"],
      input[type="button"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
      }

      input[type="submit"]:hover,
      input[type="button"]:hover {
        background-color: #45a049;
      }

      .note {
        text-align: center;
        font-style: italic;
        color: #999;
        margin-top: 20px;
      }

      .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
      }

      .error-field {
        border: 1px solid red;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        function validateField(field, regex, errorMessage) {
          if (
            field.val() === "" ||
            (!regex.test && !new RegExp(regex).test(field.val())) ||
            !field[0].validity.valid
          ) {
            field.addClass("error-field");
            field.next(".error-message").remove();
            field.after(
              '<div class="error-message">' + errorMessage + "</div>"
            );
          } else {
            field.removeClass("error-field");
            field.next(".error-message").remove();
          }
        }

        function clearErrorMessage(field) {
          field.removeClass("error-field");
          field.next(".error-message").remove();
        }

        $("input, select").blur(function () {
          var field = $(this);
          var errorMessage = "";

          switch (field.attr("id")) {
            case "firstName":
              errorMessage = "Please enter your first name";
              break;
            case "lastName":
              errorMessage = "Please enter your last name";
              break;
            case "email":
              errorMessage = "Please enter a valid email address";
              break;
            case "username":
              errorMessage = "Please enter a valid username";
              break;
            case "password":
              errorMessage =
                "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
              break;
            case "confirmPassword":
              var password = $("#password");
              errorMessage = "Passwords do not match";
              if (field.val() === password.val()) {
                clearErrorMessage(field);
              }
              break;
            case "mobileNumber":
              errorMessage = "Please enter a valid mobile number";
              break;
            case "dob":
              errorMessage = "Please enter your date of birth";
              break;
            case "country":
              errorMessage = "Please select your country";
              break;
            default:
              return;
          }

          validateField(
            field,
            field.attr("id") === "email"
              ? /^[^\s@]+@[^\s@]+\.[^\s@]+$/
              : /^[A-Za-z0-9]+$/i,
            errorMessage
          );
        });

        $("input, select").focus(function () {
          clearErrorMessage($(this));
        });

        $("form").submit(function (e) {

          var firstName = $("#firstName");
          var lastName = $("#lastName");
          var email = $("#email");
          var username = $("#username");
          var password = $("#password");
          var confirmPassword = $("#confirmPassword");
          var mobileNumber = $("#mobileNumber");
          var dob = $("#dob");
          var country = $("#country");

          $(".error-message").remove();

          validateField(
            firstName,
            /^[A-Za-z\s]+$/,
            "Please enter a valid first name"
          );
          validateField(
            lastName,
            /^[A-Za-z\s]+$/,
            "Please enter a valid last name"
          );
          validateField(
            email,
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            "Please enter a valid email address"
          );
          validateField(
            username,
            /^[A-Za-z0-9]+$/i,
            "Please enter a valid username"
          );
          validateField(
            password,
            /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/,
            "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number"
          );

          if (confirmPassword.val() !== password.val()) {
            confirmPassword.addClass("error-field");
            confirmPassword.next(".error-message").remove();
            confirmPassword.after(
              '<div class="error-message">Passwords do not match</div>'
            );
          } else {
            confirmPassword.removeClass("error-field");
            confirmPassword.next(".error-message").remove();
          }

          validateField(
            mobileNumber,
            /^\d{10}$/,
            "Please enter a valid 10-digit mobile number"
          );
          validateField(
            dob,
            /^(?!.*\d{5})\d{4}-\d{2}-\d{2}$/,
            "Please enter your date of birth"
          );
          validateField(
            country,
            /^[A-Za-z\s]+$/,
            "Please enter a valid country name"
          );

          var today = new Date();
          var selectedDate = new Date(dob.val());

          if (selectedDate > today) {
            dob.addClass("error-field");
            dob.after(
              '<div class="error-message">Please select a valid date of birth</div>'
            );
          }

          if ($(".error-message").length === 0) {
            // alert("Registration successful!");
            // $("form")[0].reset();
            
          }
          
        });

        $("#resetBtn").click(function () {
          $(".error-message").remove();
          $("form")[0].reset();
        });

        $("#loginBtn").click(function () {
          alert("Login button clicked!");
        });
      });
    </script>
  </head>
  <body>
    <div class="container">
      <h2>Registration Form</h2>
      <form action="process_registration.php" method="POST">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" id="firstName" name="firstName" />
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" id="lastName" name="lastName" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" />
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="confirmPassword" />
        </div>
        <div class="form-group">
          <label for="mobileNumber">Mobile Number</label>
          <input type="tel" id="mobileNumber" name="mobileNumber" />
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth</label>
          <input type="date" id="dob" name="dob" />
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <select id="country" name="country">
            <option value="">Select Country</option>
            <?php
              $conn = mysqli_connect("localhost","root", "root", "demo");
              $sql = "SELECT * FROM country";
              $result = $conn->query($sql);
        
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
                }
              }
            ?>
          </select>
        </div>
        <input type="submit" value="Register" name="submit"/>
        <input type="button" id="resetBtn" value="Reset" />
        <input type="button" id="loginBtn" value="Login" />
      </form>
    </div>
  </body>
</html>
