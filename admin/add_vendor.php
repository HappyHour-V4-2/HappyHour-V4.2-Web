<?php
// Include header and sidebar
include('includes/header.php');
include('includes/sidebar.php');

// Include the database connection script
include '../core/database/connection.php';

// Define variables and initialize with empty values
$name = $contact_email = $phone_number = $address = $store_name = $products_offered = $performance_metrics = $contract_status = '';
$name_err = $contact_email_err = $phone_number_err = $address_err = $store_name_err = $products_offered_err = $performance_metrics_err = $contract_status_err = '';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter vendor name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate contact email
    if (empty(trim($_POST["contact_email"]))) {
        $contact_email_err = "Please enter contact email.";
    } else {
        $contact_email = trim($_POST["contact_email"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phone_number"]))) {
        $phone_number_err = "Please enter phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate store name
    if (empty(trim($_POST["store_name"]))) {
        $store_name_err = "Please enter store name.";
    } else {
        $store_name = trim($_POST["store_name"]);
    }

    // Validate products offered
    if (empty(trim($_POST["products_offered"]))) {
        $products_offered_err = "Please enter products offered.";
    } else {
        $products_offered = trim($_POST["products_offered"]);
    }

    // Validate performance metrics
    if (empty(trim($_POST["performance_metrics"]))) {
        $performance_metrics_err = "Please enter performance metrics.";
    } else {
        $performance_metrics = trim($_POST["performance_metrics"]);
    }

    // Validate contract status
    if (empty(trim($_POST["contract_status"]))) {
        $contract_status_err = "Please select contract status.";
    } else {
        $contract_status = trim($_POST["contract_status"]);
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($contact_email_err) && empty($phone_number_err) && empty($address_err) && empty($store_name_err) && empty($products_offered_err) && empty($performance_metrics_err) && empty($contract_status_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO vendors (name, contact_email, phone_number, address, store_name, products_offered, performance_metrics, contract_status) VALUES (:name, :contact_email, :phone_number, :address, :store_name, :products_offered, :performance_metrics, :contract_status)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":contact_email", $param_contact_email);
            $stmt->bindParam(":phone_number", $param_phone_number);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":store_name", $param_store_name);
            $stmt->bindParam(":products_offered", $param_products_offered);
            $stmt->bindParam(":performance_metrics", $param_performance_metrics);
            $stmt->bindParam(":contract_status", $param_contract_status);

            // Set parameters
            $param_name = $name;
            $param_contact_email = $contact_email;
            $param_phone_number = $phone_number;
            $param_address = $address;
            $param_store_name = $store_name;
            $param_products_offered = $products_offered;
            $param_performance_metrics = $performance_metrics;
            $param_contract_status = $contract_status;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to vendor management page
                header("location: vendor_management.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Vendor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Vendors</li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Vendor Form -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Contact Email</label>
                                <input type="email" name="contact_email" class="form-control <?php echo (!empty($contact_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_email; ?>">
                                <span class="invalid-feedback"><?php echo $contact_email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
                                <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Store Name</label>
                                <input type="text" name="store_name" class="form-control <?php echo (!empty($store_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $store_name; ?>">
                                <span class="invalid-feedback"><?php echo $store_name_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Products Offered</label>
                                <input type="text" name="products_offered" class="form-control <?php echo (!empty($products_offered_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $products_offered; ?>">
                                <span class="invalid-feedback"><?php echo $products_offered_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Performance Metrics</label>
                                <input type="text" name="performance_metrics" class="form-control <?php echo (!empty($performance_metrics_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $performance_metrics; ?>">
                                <span class="invalid-feedback"><?php echo $performance_metrics_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Contract Status</label>
                                <select name="contract_status" class="form-control <?php echo (!empty($contract_status_err)) ? 'is-invalid' : ''; ?>">
                                    <option value="">Select Contract Status</option>
                                    <option value="Active" <?php echo ($contract_status == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($contract_status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $contract_status_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="vendor_management.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                        <!-- End Vendor Form -->
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
