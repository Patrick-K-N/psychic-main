<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    // Connect to the database
    $db = new mysqli('localhost', 'username', 'password', 'database');

    // Check connection
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO users (firstName, lastName, email) VALUES ('$firstName', '$lastName', '$email')";

    if ($db->query($sql) === TRUE) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Error: ' . $sql . '<br>' . $db->error;
        header('Location: index.php?error=' . $error);
        exit;
    }

    $db->close();
?>
