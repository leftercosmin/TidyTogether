<?php

/**
 * local development utility
 * places all variables from .env file in memory
 * this procedure is automatically done on wasmer
 * @return true if local development
 * @return false otherwise
 */
function formatEnv(): bool
{
  // this fetch/format is useless on wasmer
  if (getenv('SERVER')) {
    return false;
  }

  // local but already initialized
  if (getenv('DB_HOST')) {
    return true;
  }

  require_once '../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable("../");
  $dotenv->load();
  foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
  }

  return true;
}
