<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$db = new mysqli("localhost", "root", "", "auction_db");

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$user_id = $_SESSION["user_id"];

// Query to get the user's email
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $db->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $username = $user["username"];
} else {
    // If user not found, redirect to login page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Welcome, <?php echo $username; ?></h3>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
    <div class="row mt-5">
        <?php
        // Query to get all items
        $sql = "SELECT * FROM items";

        // Execute query and get result set
        $result = $db->query($sql);

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Loop through each row and display as a Bootstrap card
            while ($row = $result->fetch_assoc()) {
                // Get image filename from database
                $imageFilename = $row["image"];
                $imagePath = "../item-img/" . $imageFilename;
                ?>

                <div class="col-lg-4 col-md-6 mb-4 mt-5">
                    <div class="card h-100">
                        <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo $row["name"]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                            <p class="card-text"><?php echo $row["description"]; ?></p>
                            <p class="card-text"><?php echo $row["price"]; ?></p>
                            <p class="card-text"><?php echo $row["status"]; ?></p>
                            <form id="bidForm_<?php echo $row["id"]; ?>">
                                <div class="form-group">
                                    <input type="number" class="form-control"  name="bidAmount" placeholder="Enter bid amount" required>
                                </div>
                                <input type="hidden" name="itemId" value="<?php echo $row["id"]; ?>">
                                <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                                <button type="submit" class="btn btn-primary mt-2">BID NOW</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
            }
        } else {
            // Display message if no items were found
            echo "<p class='text-center'>No items found.</p>";
        }

        // Close database connection
        $db->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

<script>
    $('form[id^="bidForm"]').submit(function(event) {
        event.preventDefault();
        var formId = $(this).attr('id');
        var bidAmount = parseFloat($('input[name="bidAmount"]', '#' + formId).val());
        var price = parseFloat($('input[name="price"]', '#' + formId).val());
        if (bidAmount < price) {
            alert("Your bid amount is less than the item price.");
        } else {
            window.location.href = 'stripeForm.php?bidAmount=' + bidAmount;
        }
    });
</script>
</body>
</html>
