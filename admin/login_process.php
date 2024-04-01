<?php
// Start the session
session_start();

// Include the database connection file
include('../core/database/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $username = $password = $role = "";

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate role
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please select your role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Check input errors before processing the database
    if (empty($username_err) && empty($password_err) && empty($role_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username AND role = :role";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":role", $param_role, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_role = $role;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id = $row["id"];
                    $username = $row["username"];
                    $hashed_password = $row["password"];
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        // Redirect user to appropriate dashboard
                        if ($role === 'admin') {
                            header("location: dashboard.php");
                        } elseif ($role === 'vendor') {
                            header("location: dashboard_vendor.php");
                        } else {
                            // Invalid role, redirect to login page with error message
                            header("Location: login.php?error=Invalid role");
                        }
                        exit();
                    } else {
                        // Display an error message if password is not valid
                        $password_err = "The password you entered is not valid.";
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username for the selected role.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>
