<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include('../core/database/connection.php');

// Check if the vendor ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to vendor management page if vendor ID is not provided
    header("Location: vendor_management.php");
    exit;
}

// Fetch vendor details from the database based on the provided ID
$vendor_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM vendors WHERE id = ?");
$stmt->execute([$vendor_id]);
$vendor = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the vendor exists
if (!$vendor) {
    // Redirect to vendor management page if vendor does not exist
    header("Location: vendor_management.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $contact_email = $_POST['contact_email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $store_name = $_POST['store_name'];
    $products_offered = $_POST['products_offered'];
    $performance_metrics = $_POST['performance_metrics'];
    $contract_status = $_POST['contract_status'];
    
    // Update vendor details in the database
    $stmt = $pdo->prepare("UPDATE vendors SET name = ?, contact_email = ?, phone_number = ?, address = ?, store_name = ?, products_offered = ?, performance_metrics = ?, contract_status = ? WHERE id = ?");
    $stmt->execute([$name, $contact_email, $phone_number, $address, $store_name, $products_offered, $performance_metrics, $contract_status, $vendor_id]);
    
    // Redirect to vendor management page after successful update
    header("Location: vendor_management.php");
    exit;
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Vendor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Vendor Management</li>
                <li class="breadcrumb-item"><a href="vendor_management.php">Vendor List</a></li>
                <li class="breadcrumb-item active">Edit Vendor</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <!-- Vendor Edit Form -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vendor Details</h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $vendor_id; ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $vendor['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?php echo $vendor['contact_email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $vendor['phone_number']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $vendor['address']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="store_name" class="form-label">Store Name</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" value="<?php echo $vendor['store_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="products_offered" class="form-label">Products Offered</label>
                            <input type="text" class="form-control" id="products_offered" name="products_offered" value="<?php echo $vendor['products_offered']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="performance_metrics" class="form-label">Performance Metrics</label>
                            <input type="text" class="form-control" id="performance_metrics" name="performance_metrics" value="<?php echo $vendor['performance_metrics']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_status" class="form-label">Contract Status</label>
                            <select class="form-select" id="contract_status" name="contract_status" required>
                                <option value="Active" <?php if ($vendor['contract_status'] === 'Active') echo 'selected'; ?>>Active</option>
                                <option value="Inactive" <?php if ($vendor['contract_status'] === 'Inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <!-- End Vendor Edit Form -->
        </div>
    </section>
</main>

<?php
// Include footer
include('includes/footer.php');
?>
