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

// Fetch users data from the database with pagination
$stmt = $pdo->prepare("SELECT * FROM users LIMIT :start, :limit");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute([':start' => $start, ':limit' => $limit]); // Pass parameters as an array
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to count total number of users
function countUsers($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    return $stmt->fetchColumn();
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    // Prepare the SQL statement with placeholders for search
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE :search OR email LIKE :search OR username LIKE :search");
    
    // Add the wildcard to the search term
    $searchTerm = "%$search%";
    
    // Execute the prepared statement with the search term parameter
    $stmt->execute([':search' => $searchTerm]);
    
    // Fetch the results
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$total_users = countUsers($pdo);
$total_pages = ceil($total_users / $limit);
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
                        <h5 class="card-title">Users Table</h5>

                        <!-- Add New User Button -->
                        <a href="add_user.php" class="btn btn-success mb-3">Add New User</a>
                        <!-- End Add New User Button -->

                        <!-- Search Form -->
                        <form action="" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search users..." value="<?= $search ?>">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <!-- End Search Form -->

                        <!-- Users Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Last Login</th>
                                        <th scope="col">Reset Token</th>
                                        <th scope="col">Actions</th> <!-- Added this header for buttons -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP Loop to Populate Users Data -->
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <th scope="row"><?= $user['id'] ?></th>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['created_at'] ?></td>
                                            <td><a href='toggle_user_status.php?id=<?= $user['id'] ?>' class='btn btn-primary'><i class='bi bi-toggle-on'></i></a></td> <!-- Added icon inside the "Active" column -->
                                            <td><?= $user['role'] ?></td>
                                            <td><?= $user['last_login'] ?></td>
                                            <td><?= $user['reset_token'] ?></td>
                                            <td>
                                                <a href='update_user.php?id=<?= $user['id'] ?>' class='btn btn-primary'><i class='bi bi-pencil-square'></i></a> <!-- Changed button style here -->
                                                <a href='delete_user.php?id=<?= $user['id'] ?>' class='btn btn-danger'><i class='bi bi-trash'></i></a> <!-- Kept button style here -->
                                            </td> <!-- Added buttons -->
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- End of PHP Loop -->
                                </tbody>
                            </table>
                        </div>
                        <!-- End Users Table -->

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
