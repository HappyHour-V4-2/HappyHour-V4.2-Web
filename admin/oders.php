<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include '../core/database/connection.php';

// Fetch orders data from the database
$stmt = $pdo->query("SELECT * FROM orders");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <?php foreach ($orders as $order) : ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #<?php echo $order['id']; ?></h5>
                            <p class="card-text">Customer: <?php echo $order['customer_name']; ?></p>
                            <p class="card-text">Total Amount: <?php echo $order['total_amount']; ?></p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main><!-- End #main -->

<?php
// Include footer
include('includes/footer.php');
?>
