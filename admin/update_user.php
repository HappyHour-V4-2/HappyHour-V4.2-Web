<?php
// Start output buffering
ob_start();

// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Check if user ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to user table page if user ID is not provided
    header("Location: users.php");
    exit();
}

// Include database connection
include '../core/database/connection.php';

// Fetch user data from the database based on the provided ID
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_GET['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if (!$user) {
    // Redirect to user table page if user does not exist
    header("Location: users.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update the user in the database
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, username = ?, role = ? WHERE id = ?");
    $stmt->execute([$name, $email, $username, $role, $_GET['id']]);

    // Redirect the user back to the user table page
    header("Location: users.php");
    exit();
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Update User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Update user form -->
                        <h5 class="card-title">Update User</h5>
                        <form method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin" <?php echo isset($user['role']) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="vendor" <?php echo isset($user['role']) && $user['role'] == 'vendor' ? 'selected' : ''; ?>>Vendor</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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

// Flush output buffer and send output to the browser
ob_end_flush();
?>
