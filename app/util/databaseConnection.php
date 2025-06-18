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
      getenv('DB_HOST'),
      getenv('DB_USERNAME'),
      getenv('DB_PASSWORD'),
      getenv('DB_NAME'),
      getenv('DB_PORT'),
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
