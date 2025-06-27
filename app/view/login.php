<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login page</title>
    <meta name="description" content="login page for the users" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/login.css" />
</head>

<body>
    <div class="wrapper">
        <h1 class="title-text">Log In</h1>

        <form method="post">

            <div class="input-block">
                <div class="label-header">
                    <label for="email-input">
                        <?php require 'view/components/svg/identifierSvg.php'; ?> Email
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

            <button type="submit">Log In</button>
        </form>

        <form method="post">
            <button type="submit" name="whatPage" value="Signup">Don't have an account?</button>
        </form>
    </div>
</body>

</html>