<?php
// Replace with your actual database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user-entered credentials
$username = $_POST['username'];
$id_number = $_POST['id_number'];
$passcode = $_POST['passcode'];

// Prepare a secure SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND id_number = ? AND passcode = ?");
$stmt->bind_param("ssi", $username, $id_number, $passcode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Successful login
    $_SESSION['loggedin'] = true;
    header("Location: dashboard.php"); // Redirect to secure area
} else {
    // Invalid credentials
    echo "Invalid username, ID number, or passcode.";
}

$stmt->close();
$conn->close();
?>
