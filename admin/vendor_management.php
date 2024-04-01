<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include('../core/database/connection.php');

// Pagination variables
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Starting index for fetching entries

// Fetch vendors data from the database with pagination
$stmt = $pdo->prepare("SELECT * FROM vendors LIMIT :start, :limit");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute(); // No need to pass parameters here as they are already bound
$vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to count total number of vendors
function countVendors($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM vendors");
    return $stmt->fetchColumn();
}


// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    // Prepare the SQL statement with placeholders for search
    $stmt = $pdo->prepare("SELECT * FROM vendors WHERE name LIKE :search OR contact_email LIKE :search OR phone_number LIKE :search");
    
    // Add the wildcard to the search term
    $searchTerm = "%$search%";
    
    // Execute the prepared statement with the search term parameter
    $stmt->execute([':search' => $searchTerm]);
    
    // Fetch the results
    $vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all vendors if no search term is provided
    $stmt = $pdo->query("SELECT * FROM vendors");
    $vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);
}




$total_vendors = countVendors($pdo);
$total_pages = ceil($total_vendors / $limit);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>General Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vendors Table</h5>

                        <!-- Add New Vendor Button -->
                        <a href="add_vendor.php" class="btn btn-success mb-3">Add New Vendor</a>
                        <!-- End Add New Vendor Button -->

                        <!-- Search Form -->
                        <form action="" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search vendors..." value="<?= $search ?>">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <!-- End Search Form -->

                        <!-- Vendors Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Store Name</th>
                                        <th scope="col">Products Offered</th>
                                        <th scope="col">Performance Metrics</th>
                                        <th scope="col">Contract Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Is Active</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP Loop to Populate Vendors Data -->
                                    <?php foreach ($vendors as $vendor) : ?>
                                        <tr>
                                            <th scope="row"><?= $vendor['id'] ?></th>
                                            <td><?= $vendor['name'] ?></td>
                                            <td><?= $vendor['contact_email'] ?></td>
                                            <td><?= $vendor['phone_number'] ?></td>
                                            <td><?= $vendor['address'] ?></td>
                                            <td><?= $vendor['store_name'] ?></td>
                                            <td><?= $vendor['products_offered'] ?></td>
                                            <td><?= $vendor['performance_metrics'] ?></td>
                                            <td><?= $vendor['contract_status'] ?></td>
                                            <td><?= $vendor['created_at'] ?></td>
                                            <td><?= isset($vendor['is_active']) ? ($vendor['is_active'] ? 'Active' : 'Inactive') : 'N/A' ?></td>
                                            <td>
                                                <a href='edit_vendor.php?id=<?= $vendor['id'] ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a>
                                                <a href='delete_vendor.php?id=<?= $vendor['id'] ?>' class='btn btn-danger'><i class='bi bi-trash'></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- End of PHP Loop -->
                                </tbody>
                            </table>
                        </div>
                        <!-- End Vendors Table -->

                        <!-- Pagination Links -->
                        <?php if ($total_pages > 1) : ?>
                            <nav aria-label="Pagination">
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a></li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                        <!-- End Pagination Links -->

                    </div>
                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php
include('includes/footer.php');
?>
