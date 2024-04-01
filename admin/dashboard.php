<?php
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include('../core/database/connection.php');

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <!-- Dashboard Overview Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">Dashboard Overview</h5>
                            <?php
                            // Example query to fetch data from a table
                            $sql = "SELECT COUNT(*) as total_users FROM users";
                            $result = $conn->query($sql);

                            if ($result !== false && $result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<p>Total Users: " . $row["total_users"] . "</p>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </div>
                    </div>
                </div><!-- End Dashboard Overview Card -->

                <!-- Chart Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card chart-card">
                        <div class="card-body">
                            <h5 class="card-title">Sales Chart</h5>
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div><!-- End Chart Card -->
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity</h5>
                        <!-- Add PHP code here to display dynamic recent activity content -->
                    </div>
                </div><!-- End Recent Activity -->

                <!-- Inventory Status -->
                <!-- Add more PHP code and cards here as needed -->
            </div><!-- End Right side columns -->
        </div>
    </section>
</main><!-- End #main -->

<script>
    // JavaScript code to initialize and update the chart
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: [100, 200, 300, 400, 500, 600, 700],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<?php
include('includes/footer.php');
?>
