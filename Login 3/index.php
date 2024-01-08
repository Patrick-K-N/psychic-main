<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1); // Disable display_errors in production

// Define secure database credentials outside of document root
define("DB_SERVER", "localhost");
define("DB_USERNAME", "your_username");
define("DB_PASSWORD", "your_password");
define("DB_NAME", "your_database_name");

// Create a secure connection using PDO
try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Retrieve user-entered credentials with validation
$username = htmlspecialchars(trim($_POST['username']));
$id_number = htmlspecialchars(trim($_POST['id_number']));
$passcode = htmlspecialchars(trim($_POST['passcode']));

// Input validation (add more as needed)
if (empty($username) || empty($id_number) || empty($passcode)) {
    die("Please enter all credentials.");
}

// Prepared statement with parameterized query
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND id_number = ? AND passcode = ?");
$stmt->bindParam(1, $username);
$stmt->bindParam(2, $id_number);
$stmt->bindParam(3, $passcode);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Successful login
    session_start();
    $_SESSION['loggedin'] = true;
    header("Location: dashboard.php");
    exit();
} else {
    // Invalid credentials
    echo "Invalid username, ID number, or passcode.";
}

$stmt->closeCursor();
$conn = null; // Close the connection
?>

