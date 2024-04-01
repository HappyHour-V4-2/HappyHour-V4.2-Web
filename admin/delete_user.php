<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include '../core/database/connection.php';

// Check if user ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the user ID from the URL
    $user_id = $_GET['id'];

    // Check if the user exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user) {
        // User not found, redirect to user management page or show error message
        // Example: header("Location: users.php");
        echo "User not found!";
        exit;
    }

    // If the user exists, proceed with the deletion
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
        // Perform the deletion
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        // Redirect to user management page
        header("Location: admin/users.php");
        exit;
    }
} else {
    // User ID not provided in the URL, redirect to user management page or show error message
    // Example: header("Location: users.php");
    echo "User ID not provided!";
    exit;
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Delete User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Delete</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Add your delete user confirmation here -->
                        <h5 class="card-title">Delete User</h5>
                        <p>Are you sure you want to delete this user?</p>
                        <form method="post">
                            <input type="hidden" name="confirm_delete" value="1">
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Confirm Delete</button>
                            <a href="users.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Cancel</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php
// Include footer
include('includes/footer.php');
?>
