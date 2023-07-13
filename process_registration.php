<?php
 $conn = mysqli_connect("localhost", "root", "root", "demo");

 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 else{
  echo "connected";
 }
if (isset($_POST["submit"])) {
  // print_r($_POST);
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $mobileNumber = $_POST['mobileNumber'];
  $country = $_POST['country'];

  
  $countryId = $_POST['country'];
  print_r($countryId);
  // die();

    $query = "INSERT INTO users (first_name, last_name, email, username, password, mobile_number, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $firstName, $lastName, $email, $username, $password, $mobileNumber, $countryId);
    mysqli_stmt_execute($stmt);

    echo "Registration successful!";
  } else {
    echo implode("\n", $errors);
  }

?>
