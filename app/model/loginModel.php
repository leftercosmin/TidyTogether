<?php // prints user type

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

unset($_POST["email"], $_POST["password"]);

// database
$db = new mysqli(
  getenv('DB_HOST'),
  getenv('DB_USERNAME'),
  getenv('DB_PASSWORD'),
  getenv('DB_NAME'),
  getenv('DB_PORT'),
);

if ($db->connect_error) {
  $db->close();
  exit("error: " . $db->connect_error);
}

$statement =
  $db->prepare(
    'SELECT id, password, role FROM User WHERE email=?'
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
  ['id' => $row['id'], 'email' => $email, 'role' => $row['role']]
);

session_destroy();
session_start([
  'cookie_path' => '/',
  'cookie_secure' => isset($_SERVER['HTTPS']),
  'cookie_httponly' => true
]);
$_SESSION[CONN] = $token;
