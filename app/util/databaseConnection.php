<?php

final class DatabaseConnection
{
  private static ?mysqli $endpoint = null;

  public static function get(): mysqli
  {
    if (self::$endpoint) {
      return self::$endpoint;
    }

    self::$endpoint = new mysqli(
      $_ENV['DB_HOST'],
      $_ENV['DB_USERNAME'],
      $_ENV['DB_PASSWORD'],
      $_ENV['DB_NAME'],
      $_ENV['DB_PORT']
    );

    if (self::$endpoint->connect_error) {
      exit("db error: " . self::$endpoint->connect_error);
    }

    return self::$endpoint;
  }

  public static function close(): void
  {
    if (null === self::$endpoint) {
      return;
    }

    self::$endpoint->close();
    self::$endpoint = null;
  }
}
