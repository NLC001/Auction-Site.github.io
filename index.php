<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="row mt-5">
        <div class="col-lg-6 offset-3">
        <div class="container">
    <h2>Login Form</h2>
    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
        </div>
    </div>

</body>
</html>
