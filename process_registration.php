<?php
 $conn = mysqli_connect("localhost", "root", "root", "demo");

 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 
if (isset($_POST["submit"])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $mobileNumber = $_POST['mobileNumber'];
  $country = $_POST['country'];
  $countryId = $_POST['country'];

  $errors = [];

  if (empty($firstName)) {
    $errors[] = "First name is required";
  }

  if (empty($lastName)) {
    $errors[] = "Last name is required";
  }

  if (empty($email)) {
    $errors[] = "Email is required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }

  if (empty($username)) {
    $errors[] = "Username is required";
  }

  if (empty($password)) {
    $errors[] = "Password is required";
  }

  if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match";
  }

  if (empty($mobileNumber)) {
    $errors[] = "Mobile number is required";
  }

  if (empty($country)) {
    $errors[] = "Country is required";
  }

  if (empty($errors)) {
    $conn = mysqli_connect("localhost", "root", "root", "demo");

    $query = "INSERT INTO users (first_name, last_name, email, username, password, mobile_number, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $email, $username, $password, $mobileNumber, $countryId);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Registration successful!'); window.location.href = '1.php'; </script>";

  } else {
    // echo implode("\n", $errors);
    echo "<script>alert('" . implode("\\n", $errors) . "'); window.location.href = '1.php';</script>";

  }
}
?>
