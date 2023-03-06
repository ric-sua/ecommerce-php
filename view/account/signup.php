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
        <form action="." id="myForm" class="uk-grid-small" method="POST" uk-grid>

          <input type="hidden" name="action" value="signup">
          <div class="uk-width-1-1">
            <input type="text" class="uk-input" name="usr" placeholder="username" aria-label="Username" aria-describedby="basic-addon1" required>
          </div>
          <div class="uk-width-1-2">
            <input type="text" class="uk-input " name="fn" placeholder="First Name" aria-label="First Name" aria-describedby="basic-addon1" required>
          </div>
          <div class="uk-width-1-2">
            <input type="text" class="uk-input" name="ln" placeholder="Last Name" aria-label="Last Name" aria-describedby="basic-addon1" required>
          </div>
          <div class="uk-width-1-1">

            <input type="email" class="uk-input" name="eml" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon1" required>
          </div>
          <div class="uk-width-1-2">

            <input type="password" id="pass" class="uk-input uk-form-width-large uk-align-center" name="pass" placeholder="password" onkeyUp='valid()' aria-label="password" aria-describedby="basic-addon1" required>
          </div>

          <div class="uk-width-1-2">
            <input type="password" id="pass2" class="uk-input uk-form-width-large uk-align-center" name="pass2" placeholder="password" onkeyUp='valid()' aria-label="password2" aria-describedby="basic-addon1" required>
          </div>

          <div class="uk-width-1-2">
            <button class="uk-button uk-button-default uk-align-right" type="submit" value="Submit">Submit </button>
          </div>
          <div class="uk-width-1-2">
            <button class="uk-button uk-button-default uk-align-left" type="reset" value="Reset" onclick="document.getElementById('myForm').reset();">Reset</button>
          </div>

        </form>
      </div>

    </div>

    <script>
      function valid() {
        if (document.getElementById('pass').value !== document.getElementById('pass2').value) {
          document.getElementById('pass2').setCustomValidity("password does not match")
        } else {
          document.getElementById('pass2').setCustomValidity("")
        }

      }
    </script>
  </div>

</body>

</html>