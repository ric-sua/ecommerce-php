<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>| Rusty's |</title>
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/js/uikit-icons.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    .uk-container {
      position: relative;
      top: 100px;
    }
  </style>
</head>

<body>

  <div class="uk-container uk-container-small">
    <div class="uk-card uk-card-default uk-card-hover uk-card-body">


      <div style="text-align: center;">
        <img src="../images/unnamed.png" width="75" height="75" />
        <p class="uk-margin"><?php
                              if (isset($_SESSION['check'])) {
                                if ($_SESSION['check'] == "true") {
                                  unset($_SESSION["check"]);
                                } else {
                                  unset($_SESSION["check"]);
                                  echo 'invalid credentials.';
                                }
                              } ?></p>
      </div>
      <form action="." id="myForm" class="uk-form-stacked" method="post">
        <input type="hidden" name="action" value="signin">
        <div class="uk-margin">
          <input type="text" id="username" class="uk-input uk-form-width-large uk-align-center" name="usr" placeholder="username" required>
        </div>
        <div class="uk-margin">
          <input type="password" id="password" class="uk-input uk-form-width-large uk-align-center" name="pass" placeholder="password" required>
        </div>


        <div style="text-align: center;">
          <button class="uk-button uk-button-default" type="submit" value="Submit">Submit </button>
          <button class="uk-button uk-button-default" type="reset" value="Reset" onclick="document.getElementById('myForm').reset();">Reset</button>
        </div>

      </form>
      <div class="uk-margin" style="text-align: center;">
        Not Registered? <a href="signup.php"> Sign Up </a>
        <div>

          </form>
          <div class="uk-margin" style="text-align: center;">
            Administrator? <a href="adminlogin.php"> Click Here </a>
            <div>

            </div>

          </div>



</body>

</html>