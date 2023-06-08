<?php
session_start(); // Start the session

$db = new mysqli("localhost", "root", "", "auction_db");

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        // Valid login, set session variables and redirect to dashboard.php
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["first_name"] = $user["first_name"];
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid login, display error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Result</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Login Result</h2>
    <?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <p><a href="login.html">Back to Login</a></p>
  </div>
</body>
</html>
