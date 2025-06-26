<!-- I AM SORRY FOR THE BIG SVG LABELS -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/profileEdit.css">
</head>

<body class="profile-body">
  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php
  if ($profile['role'] === 'civilian') {
    require_once 'view/components/civilianNavbar.php';
  } elseif ($profile['role'] === 'supervisor') {
    require_once 'view/components/supervisorNavbar.php';
  } elseif ($profile['role'] === 'authority') {
    require_once 'view/components/authorityNavbar.php';
  }
  ?>

  <main class="profile-container">

    <h1 class="page-title">Edit Profile</h1>

    <form method="post" action="./" class="profile-card">

      <div class="label-header">
        <label for="editfname">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
            <path
              d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z" />
          </svg>
          Your First Name:
        </label>
      </div>
      <input type="text" id="editfname" name="editfirstname">
      <br />

      <div class="label-header">
        <label for="editlname">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
            <path
              d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z" />
          </svg>
          Your Last Name:
        </label>
      </div>
      <input type="text" id="editlname" name="editlastname">
      <br />

      <div class="label-header">
        <label for="editmcity">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256"
            height="256" viewBox="0 0 256 256" xml:space="preserve">
            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
              transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
              <path
                d="M 15.79 52.843 h 21.623 c 1.271 2.154 2.573 4.356 3.868 6.546 l 1.962 3.319 c 0.418 0.708 1.179 1.141 2 1.141 c 0.821 0 1.582 -0.433 2 -1.141 l 1.981 -3.351 c 1.288 -2.179 2.584 -4.37 3.849 -6.514 h 21.624 c 0.64 0 1.229 0.346 1.541 0.904 l 2.424 4.336 L 34.056 70.074 L 23.683 57.72 c -0.744 -0.887 -2.04 -1.2 -3.035 -0.609 c -1.268 0.754 -1.514 2.42 -0.606 3.501 l 9.063 10.794 L 0 79.229 l 14.249 -25.483 C 14.561 53.189 15.15 52.843 15.79 52.843 z"
                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
              <path
                d="M 12.879 80.58 l 44.242 -11.893 l 7.373 8.782 c 0.46 0.547 1.118 0.829 1.78 0.829 c 0.5 0 1.003 -0.16 1.425 -0.489 c 1.046 -0.815 1.105 -2.434 0.252 -3.449 l -5.88 -7.003 l 18.932 -5.089 l 8.77 15.685 c 0.658 1.177 -0.193 2.628 -1.541 2.628 H 12.879 z"
                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
              <path
                d="M 42.723 9.615 c -7.804 1.209 -13.559 8.241 -13.335 16.136 c 0.064 2.265 0.597 4.438 1.585 6.466 c 1.81 3.63 7.345 13.028 12.982 22.563 c 0.58 0.98 1.998 0.98 2.578 0 c 5.641 -9.54 11.173 -18.936 12.995 -22.593 c 1.051 -2.171 1.578 -4.489 1.578 -6.905 C 61.106 15.709 52.581 8.088 42.723 9.615 z M 45.271 31.319 c -3.508 0 -6.361 -2.854 -6.361 -6.361 s 2.854 -6.361 6.361 -6.361 c 3.508 0 6.362 2.854 6.362 6.361 S 48.779 31.319 45.271 31.319 z"
                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            </g>
          </svg>
          Your city:
        </label>
      </div>
      <input type="text" id="editmcity" name="editmaincity">
      <br />

      <div class="buttons">

        <?php
        echo "<a "
          . "class=\"action-btn\" "
          . "href=\"?" . $profile["role"] . "Page" . "=profilePage\" "
          . ">";
        echo "Cancel";
        echo "</a>";
        ?>

        <button type="submit" class="action-btn">Save</a>
      </div>

    </form>

  </main>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>