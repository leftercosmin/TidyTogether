<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Login page</title>
    <meta name="description" content="login page for the users" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="wrapper">
      <h1>Log In</h1>

      <form method="post">
        <div class="input-block">
          <div class="label-header">
            <label for="email-input">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                height="24px"
                viewBox="0 -960 960 960"
                width="24px"
                fill="#e3e3e3"
              >
                <path
                  d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480v58q0 59-40.5 100.5T740-280q-35 0-66-15t-52-43q-29 29-65.5 43.5T480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480v58q0 26 17 44t43 18q26 0 43-18t17-44v-58q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93h200v80H480Zm0-280q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"
                />
              </svg>
              Email
            </label>
          </div>
          <input
            required
            type="text"
            name="email"
            id="email-input"
            placeholder="Email"
          />
        </div>

        <div class="input-block">
          <div class="label-header">
            <label for="password-input">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                height="24px"
                viewBox="0 -960 960 960"
                width="24px"
                fill="#e3e3e3"
              >
                <path
                  d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"
                />
              </svg>
              Password
            </label>
          </div>
          <input
            required
            type="password"
            name="password"
            id="password-input"
            placeholder="Password"
          />
        </div>

        <button type="submit">Log In</button>
      </form>

        <div class="footer">
          <p>Don't have an account?</p>
            <form class="redirect" method="get" action="/TidyTogether/view/account/signup.php">
                <button type="submit">Sign up</button>
            </form>
        </div>
    </div>
  </body>
</html>
