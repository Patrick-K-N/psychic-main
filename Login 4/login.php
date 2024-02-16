<?php

// Database connection details
$dbHost = "localhost";
$dbName = "your_database_name";
$dbUser = "your_username";
$dbPassword = "your_password";

try {
  $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Handle login or registration based on form submission
  if (isset($_POST["submit"])) {
    if ($_POST["submit"] === "Login") {
      // Login logic
      $email = $_POST["email"];
      $password = $_POST["password"];

      // ... (retrieve user data, verify password, handle success/failure)
    } else if ($_POST["submit"] === "Register") {
      // Registration logic
      $email = $_POST["email"];
      $password = $_POST["password"];

      // ... (validate input, hash password, insert user data, handle success/failure)
    }
  }

  // ... (display login/registration form with error messages if needed)

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;

?>
