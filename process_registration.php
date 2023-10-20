<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
 $conn = mysqli_connect("localhost", "root", "root", "demo");

 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // echo "<script>alert($_SERVER);</script>";
  // $response = print_r($_SERVER);
  // echo $response;
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $dob = $_POST['dob'];
  $mobileNumber = $_POST['mobileNumber'];
  $country = $_POST['country'];
  $countryCode = $_POST['country'];

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
  if (empty($dob)) {
    $errors[] = "Date of birth is required";
  } else {
    $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
    $currentDate = new DateTime();
  
    if (!$dobDateTime || $dobDateTime > $currentDate) {
      $errors[] = "Invalid date of birth";
    }
  }
  

  if (empty($errors)) {

    $query = "INSERT INTO users (first_name, last_name, email, username, password, mobile_number, dob, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);  
    mysqli_stmt_bind_param($stmt, "ssssssss", $firstName, $lastName, $email, $username, $password, $mobileNumber, $dob, $countryCode);
    mysqli_stmt_execute($stmt);
    $result = "<script>alert('Registration successful!'); window.location.href = '1.php'; </script>";
    echo $result;
  } else {
    $result = "<script>alert('" . implode("\\n", $errors) . "'); window.location.href = '1.php';</script>";
    echo $result;
  }
}
?>
