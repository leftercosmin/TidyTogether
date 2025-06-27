<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>SignUp page</title>
  <meta name="description" content="signup page for the users" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/login.css" />
</head>

<body>
  <div class="wrapper">
    <h1 class="title-text">Create your account</h1>

    <form method="post">

      <div class="input-block">
        <div class="label-header">
          <label>Select a role for your account:</label>
        </div>
        <div class="role-selection">
          <div class="role-options">
            <div class="role-option">
              <input type="radio" id="role-citizen" name="role" value="civilian" checked>
              <label class="role-option-box" for="role-citizen">
                <?php require 'view/components/svg/imp/civSvg.php'; ?>
                Civilian
              </label>
            </div>


            <div class="role-option">
              <input type="radio" id="role-decision" name="role" value="supervisor">
              <label class="role-option-box" for="role-decision">
                <?php require 'view/components/svg/imp/supSvg.php'; ?>
                Supervisor
              </label>
            </div>

            <div class="role-option">
              <input type="radio" id="role-authorized" name="role" value="authority">
              <label class="role-option-box" for="role-authorized">
                <?php require 'view/components/svg/imp/athSvg.php'; ?>
                Authority
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="input-block">
        <div class="label-header">
          <label for="firstname-input">
            <?php require 'view/components/svg/identifierSvg.php'; ?>
            First name
          </label>
        </div>
        <input type="text" name="firstname" id="firstname-input" placeholder="Firstname" />
      </div>

      <div class="input-block">
        <div class="label-header">
          <label for="lastname-input">
            <?php require 'view/components/svg/identifierSvg.php'; ?>
            Last name
          </label>
        </div>
        <input type="text" name="lastname" id="lastname-input" placeholder="Lastname" />
      </div>

      <div class="input-block">
        <div class="label-header">
          <label for="email-input">
            <?php require 'view/components/svg/emailSvg.php'; ?>
            Email
          </label>
        </div>
        <input required type="text" name="email" id="email-input" placeholder="Email" />
      </div>

      <div class="input-block">
        <div class="label-header">
          <label for="password-input">
            <?php require 'view/components/svg/passwordSvg.php'; ?>
            Password
          </label>
        </div>
        <input required type="password" name="password" id="password-input" placeholder="Password" />
      </div>

      <div class="input-block">
        <div class="label-header">
          <label for="confirm-password">
            <?php require 'view/components/svg/passwordSvg.php'; ?>
            Confirm password
          </label>
        </div>
        <input required type="password" name="passwordAgain" id="confirm-password" placeholder="Confirm password" />
      </div>


      <div class="input-block" id="secret-discret">
        <div class="label-header">
          <label for="secret-input">
            <?php require 'view/components/svg/passwordSvg.php'; ?>
            One-time secret key
          </label>
        </div>
        <input type="password" name="secret" id="secret-input" placeholder="Secret hashed key" />
      </div>

      <button type="submit">Sign Up</button>
    </form>

    <form method="post">
      <button action="login.html" type="submit" name="whatPage" value="Login">Already have an account?</button>
    </form>

  </div>

  <script src="javascript/signupSecret.js"></script>
</body>

</html>