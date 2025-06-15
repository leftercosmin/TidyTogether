<?php // prints user type

define("CONN", "userSession");


// do not access this page manually
if (isset($_SESSION[CONN])) {
  header("Location: ../index.php");
  exit();
}

// base cases
if (!isset($_POST["email"]) || !isset($_POST["password"])) {
  exit("error: can not log missing credentials");
}

$email = $_POST["email"];
$passw = $_POST["password"];

// database
$db = new mysqli(
  $_ENV['DB_HOSTNAME'],
  $_ENV['DB_USERNAME'],
  $_ENV['DB_PASSWORD'],
  $_ENV['DB_DATABASE']
);

if ($db->connect_error) {
  $db->close();
  exit("error: " . $db->connect_error);
}

$statement =
  $db->prepare(
    'SELECT email, password, role FROM User WHERE email=?'
  );
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();
$statement->close();
$db->close();

if (!$result || 0 == $result->num_rows) {
  exit("error: invalid credentials");
}

$row = $result->fetch_assoc();
if (!password_verify($passw, $row['password'])) {
  exit("error: can not log invalid credentials");
}

// session
$token = json_encode(
  ['email' => $email, 'role' => $row['role']]
);
session_start([
  'cookie_lifetime' => 10,
  'cookie_path' => '/',
  'cookie_secure' => isset($_SERVER['HTTPS']),
  'cookie_httponly' => true
]);
$_SESSION[CONN] = $token;

unset($_POST);
