<?php
// Include the database connection file
include('../core/database/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert user data into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)");
        $stmt->execute(array(
            ':name' => $name,
            ':email' => $email,
            ':username' => $username,
            ':password' => $hashed_password
        ));

        // Redirect the user to a success page or login page
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
