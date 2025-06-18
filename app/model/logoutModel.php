<?php

/**
 * makes sure to delete the client cookies if set
 * @return void
 */
function logout(): void
{
  unset($_SESSION[CONN]);
  session_destroy();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      0,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }
}

