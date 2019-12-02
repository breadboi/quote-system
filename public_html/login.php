<?php
    require_once('../resources/library/bootstrap.php');
    require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
?>

<?php
    // Always start this first
    session_start();

    if ( isset( $_SESSION['user_id'] ) ) 
    {
      header("Location: index.php");
    }

    if ( ! empty( $_POST ) ) 
    {
        if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) 
        {
            $usernameInput = $_POST['username'];
            $passwordInput = $_POST['password'];
            // Getting submitted user data from database
            $stmt = $devPdo->prepare("SELECT * FROM sales_associates WHERE name = :user");
            $stmt->bindParam(':user', $usernameInput);
            $stmt->execute();
            $found = $stmt->fetch();
            if(empty($found))
            {
                echo '<div style="text-align:center" class="alert alert-danger">';
                echo '<strong>No User Found Under that UserName: ' . $usernameInput;
                echo '</div>';
            }
            $userSession = $found[1];
            $password = $found[2];
            // Verify user password and set $_SESSION
            if ( md5($passwordInput) == $password ) 
            {
                $_SESSION['user_id'] = $userSession;
            }
            else
            {
                echo '<div style="text-align:center" class="alert alert-danger">';
                echo '<strong>Incorrect Password</strong>';
                echo '</div>';
            }
        }
    }
?>

<div class="p-1 btn-group">
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
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

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