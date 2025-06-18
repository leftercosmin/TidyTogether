<?php


function signup(
  string $fname,
  string $lname,
  string $email,
  string $passw,
  string $pasAg,
  string $role
): string {

  // basic input validation
  if (is_null($email) || strlen($email) < 2) {
    return "error: can not signup invalid credentials";
  }

  if (
    is_null($passw) ||
    strlen($passw) < 4 ||
    $passw != $pasAg
  ) {
    return "error: invalid password";
  }

  // database
  $db = $db = DatabaseConnection::get();
  if (null === $db || $db->connect_error) {
    $db->close();
    return "error: " . $db->connect_error;
  }

  $statement =
    $db->prepare(
      'SELECT email FROM User WHERE email=?'
    );
  if (!$statement) {
    return "error: failed to prepare SELECT statement";
  }

  if (!$statement->bind_param('s', $email)) {
    $statement->close();
    return "error: failed to bind SELECT parameters";
  }

  if (!$statement->execute()) {
    $statement->close();
    return "error: failed to execute SELECT";
  }

  $result = $statement->get_result();
  if (!$result) {
    $statement->close();
    return "error: failed to fetch result";
  }

  // not unique
  if ($result->num_rows > 0) {
    $statement->close();
    return "error: email already registered";
  }

  $passw = password_hash($passw, PASSWORD_DEFAULT);
  if (!$passw) {
    return "error: failed to hash password";
  }

  // transaction
  if (!$db->begin_transaction()) {
    return "error: failed to begin transaction";
  }

  $statement =
    $db->prepare(
      'INSERT INTO
    User (email, password, fname, lname, role)
    VALUES (?, ?, ?, ?, ?)'
    );
  if (!$statement) {
    $db->rollback();
    return "error: failed to prepare INSERT statement";
  }

  $test = $statement->bind_param(
    'sssss',
    $email,
    $passw,
    $fname,
    $lname,
    $role
  );

  if (!$test) {
    return "error: failed to bind to INSERT statement";
  }

  if (!$statement->execute()) {
    return "error: failed to execute INSERT statement";
  }

  if (!$db->commit()) {
    return "error: failed to commit";
  }

  if (!$statement->close()) {
    return "error: failed to close the statement";
  }

  return ""; // success
}
