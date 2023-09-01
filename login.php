    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    ?>
    <!DOCTYPE html>
<html>
<head>
  <title>DEIS | login</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    body {
      background-color: #f8f9fa;
      /* background-image: url('img/udsm.jpg'); Set the path to your background image */
      height: 100%;
      background-blur: 10px; /* Adjust the blur amount as needed */
      background-repeat: no-repeat;
      background-position: center center;
    }
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #d6d6d6;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }
    .login-logo {
      display: block;
      margin: 0 auto;
      margin-bottom: 20px;
      width: 100px; /* Adjust the width as needed */
    }
  </style>
</head>
<body>

<!-- ... (HTML code) ... -->

<div class="container mt-5">
  <div class="login-container">
    <img src="img/daruso logo.png" alt="Logo" class="login-logo">

    <form method="post" action="backend/auth.php">
      <H6>LOGIN</H6>
      <div class="form-group">
        <!-- <label for="username">User ID</label> -->
        <input type="text" class="form-control" name="regnumber" placeholder="Enter your Identification Number" required >
      </div>
      <div class="form-group">
        <!-- <label for="password">Password</label> -->
        <input type="password" class="form-control" name="password" placeholder="Enter password" required >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
      <a href="#" class="btn btn-secondary btn-block">Forgot Password?</a>
    </form>
    
    <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php echo $_GET['error']; ?>
      </div>
    <?php } ?>
    
  </div>
</div>


<!-- Include Bootstrap JS and any additional scripts -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Remove the error parameter from the URL on page load
  window.onload = function() {
    if (window.location.search.includes("error")) {
      history.replaceState(null, null, window.location.pathname);
    }
  };
</script>

</body>
</html>

