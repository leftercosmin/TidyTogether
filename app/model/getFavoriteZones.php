<?php
require_once __DIR__ . '/../util/databaseConnection.php';

function getFavoriteZones($userId) {
    $db = DatabaseConnection::get();
    if (!$db || $db->connect_error) return [];

    $stmt = $db->prepare(
        "SELECT z.name AS neighborhood, z.city, z.country, lz.lat, lz.lng
         FROM LovedZone lz
         JOIN Zone z ON lz.idZone = z.id
         WHERE lz.idUser = ?"
    );
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $res = $stmt->get_result();

    $favorites = [];
    while ($row = $res->fetch_assoc()) {
        $favorites[] = $row;
    }
    return $favorites;
}