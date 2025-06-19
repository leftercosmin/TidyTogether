<?php

/* returns error type 
 * creates a session on success
 */
function login(string $email, string $passw): string
{
  $db = $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error - login(): " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'SELECT id, password, role FROM User WHERE email=?'
    );
  if (!$statement) {
    return "error - login(): failed to prepare SQL statement";
  }

  if (!$statement->bind_param('s', $email)) {
    $statement->close();
    return "error - login(): failed to bind parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error - login(): failed to execute SQL statement";
  }
  
  $result = $statement->get_result();
  $statement->close();

  if (!$result || 0 == $result->num_rows) {
    return "error - login(): invalid credentials";
  }

  $row = $result->fetch_assoc();
  if(false === $row){
    return "error - login(): invalid row";
  }

  if (!password_verify($passw, $row['password'])) {
    return "error - login(): can not log invalid credentials";
  }

  // sessions
  $token = json_encode(
    ['id' => $row['id'], 'email' => $email, 'role' => $row['role']]
  );

  if (session_status() === PHP_SESSION_NONE) {
    session_start([
    'cookie_path' => '/',
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_httponly' => true
  ]);
  }

  $_SESSION[CONN] = $token;
  return ""; // success
}
