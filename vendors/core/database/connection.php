<?php

// Database connection parameters
$servername = 'localhost';
$host = 'localhost';
$dbname = 'happyhour';
$username = 'root'; // MySQL username (replace with your actual username)
$password = ''; // MySQL password (replace with your actual password)

// Database connection DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Set default fetch mode to objects
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Disable emulated prepared statements

    // Optionally, set additional attributes as needed

} catch (PDOException $e) {
    // Handle database connection errors
    // Output an error message with details from the exception
    echo "Database Connection Failed: " . $e->getMessage();
    // You may want to log the error or redirect to an error page
    exit; // Stop script execution
}
