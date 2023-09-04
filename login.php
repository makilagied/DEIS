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
    /* body {
      background-color: #f8fcfa;
      background-image: url('img/udsm.jpg'); Set the path to your background image 
      height: 100%;
      background-repeat: no-repeat;
      background-position: center center;
    } */

    body {
  margin: 0;
  padding: 0;
  overflow: hidden; /* Prevent scrollbars */
}

body::before {
  content: "";
  background-image: url('img/udsm.jpg'); /* Replace with your image URL */
  filter: blur(1px); /* Adjust the blur radius as needed */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1; /* Place it behind the content */
  background-repeat: no-repeat;
  background-size: cover;
}

/* Add your additional styles for the content of the body here */

    .login-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 50px;
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
    h2 {
          text-align: center;
          color:#0864AF;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

  </style>
</head>
<body>

<!-- ... (HTML code) ... -->

<div class="container mt-5">
  <div class="login-container">
    <img src="img/daruso logo.png" alt="Logo" class="login-logo">

    <form method="post" action="backend/auth.php">
      <h2>LOGIN TO DEIS</h2>
      <div class="form-group">
        <!-- <label for="username">User ID</label> -->
        <input type="text" class="form-control" name="regnumber" placeholder="Enter your Identification Number" required >
      </div>
      <div class="form-group">
        <!-- <label for="password">Password</label> -->
        <input type="password" class="form-control" name="password" placeholder="Enter password" required >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
      <!-- <a href="#" class="btn btn-secondary btn-block">Forgot Password?</a> -->
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

