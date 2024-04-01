<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include('../core/database/connection.php');

// Check if vendor ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $vendor_id = $_GET['id'];

    // Check if the user confirmed the deletion
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == '1') {
        // Prepare the SQL statement to delete the vendor
        $stmt = $pdo->prepare("DELETE FROM vendors WHERE id = :id");

        // Bind the parameter
        $stmt->bindParam(':id', $vendor_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to vendor management page upon successful deletion
            header("Location: vendor_management.php");
            exit();
        } else {
            // Display an error message if deletion fails
            echo "Error deleting vendor.";
        }
    } else {
        // Display the confirmation popup
        echo '<div class="container-backdrop" id="backdrop">
                <div class="modal-container-custom" id="myModal">
                    <div class="modal-content">
                        <span class="close-icon" onclick="closeModal()">×</span>
                        <div class="imgModel">
                            <div class="wrapper">
                                <h1>Delete Vendor<span class="dot">.</span></h1>
                                <p>Are you sure you want to delete this vendor?</p>
                                <form method="post">
                                    <input type="hidden" name="confirm_delete" value="1">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirm Delete</button>
                                    <a href="vendor_management.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
} else {
    // If no vendor ID is provided, redirect back to vendor management page
    header("Location: vendor_management.php");
    exit();
}

// Include footer
include('includes/footer.php');
?>
