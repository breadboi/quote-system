<?php
require_once(__DIR__.'/../resources/library/bootstrap.php');
require_once(__DIR__."/../resources/library/devDatabase.php");
?>

<?php
// Always start this first
session_start();

if (!empty($_POST)) {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];
    // Getting submitted user data from database
    $stmt = $devPdo->prepare("SELECT * FROM sales_associates WHERE name = :user");
    $stmt->bindParam(':user', $usernameInput);
    $stmt->execute();
    $found = $stmt->fetch();
    //Check if no user found
    if (empty($found)) {
      echo '<div style="text-align:center" class="alert alert-danger">';
      echo '<strong>No User Found Under that Username: ' . $usernameInput;
      echo '</div>';
    } else {
      $userSession = $found[1];
      $password = $found[2];
      // Verify user password and set $_SESSION
      if (md5($passwordInput) == $password) {
        $_SESSION['user_id'] = $userSession;
      } else {
        echo '<div style="text-align:center" class="alert alert-danger">';
        echo '<strong>Incorrect Password</strong>';
        echo '</div>';
      }
    }
  }
}

//if user is logged in then redirect to index
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
} else {
  $loggedOut = '<p style="text-align:center" class="bg-danger text-white">Please Login To Access System</p>';
  echo $loggedOut;
}
?>

<html>

<head>
  <title>Login Page</title>
</head>

<body>
  <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
    <h1>Sales Associate Login</h1>
  </div>

  <div class="p-1 m-1 btn-group d-flex">
    <a href="index.php" class="btn btn-dark" role="button">Back To Home Page</a>
  </div>

  <form action="login.php" class="border border-primary rounded m-2 p-2 needs-validation" method="post">
    <div class="form-group">
      <label for="uname">Username:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="p-1 m-1 btn-group d-flex">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
  </form>
</body>

</html>

<script>
  // Disable form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
