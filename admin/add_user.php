<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection script
    include('../core/database/connection.php');
    
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Note: Password should be hashed before storing in database
    $role = $_POST['role'];
    
    // Initialize vendor-specific fields to empty values
    $vendorName = '';
    $vendorLocation = '';
    
    // Check if the role is 'vendor' and retrieve vendor-specific fields
    if ($role === 'vendor') {
        $vendorName = $_POST['vendor_name'];
        $vendorLocation = $_POST['vendor_location'];
    }
    
    // Prepare and execute SQL query to insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, username, password, role, vendor_name, vendor_location) VALUES (:name, :email, :username, :password, :role, :vendor_name, :vendor_location)");
    $stmt->execute(['name' => $name, 'email' => $email, 'username' => $username, 'password' => $password, 'role' => $role, 'vendor_name' => $vendorName, 'vendor_location' => $vendorLocation]);

    // Redirect to users.php after successful insertion
    header("Location: users.php");
    exit;
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Details</h5>
                        
                        <!-- User Registration Form -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="vendor">Vendor</option>
                                    <!-- Add additional roles here if needed -->
                                </select>
                            </div>
                            
                            <!-- Vendor-specific fields (hidden by default) -->
                            <div id="vendorFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="vendor_name" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control" id="vendor_name" name="vendor_name">
                                </div>
                                <div class="mb-3">
                                    <label for="vendor_location" class="form-label">Vendor Location</label>
                                    <input type="text" class="form-control" id="vendor_location" name="vendor_location">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <!-- End User Registration Form -->

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

<script>
    // Script to toggle visibility of vendor fields based on selected role
    document.getElementById('role').addEventListener('change', function() {
        var selectedRole = this.value;
        if (selectedRole === 'vendor') {
            document.getElementById('vendorFields').style.display = 'block';
        } else {
            document.getElementById('vendorFields').style.display = 'none';
        }
    });
</script>
