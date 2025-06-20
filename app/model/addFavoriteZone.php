<?php
require_once __DIR__ . '/../util/databaseConnection.php';

function addFavoriteZone($userId, $neighborhood, $city, $country) {
    $db = DatabaseConnection::get();
    //check if zone exists
    $stmt = $db->prepare("SELECT id FROM Zone WHERE name=? AND city=? AND country=?");
    $stmt->bind_param("sss", $neighborhood, $city, $country);
    $stmt->execute();
    $res = $stmt->get_result();
    $zone = $res->fetch_assoc();

    //insert zone if it doesnt exist
    if (!$zone) {
        $stmt = $db->prepare("INSERT INTO Zone (name, city, country) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $neighborhood, $city, $country);
        if (!$stmt->execute()) return "Failed to insert zone";
        $zoneId = $db->insert_id;
    } else {
        $zoneId = $zone['id'];
    }

    $stmt = $db->prepare("INSERT IGNORE INTO LovedZone (idUser, idZone) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $zoneId);
    if (!$stmt->execute()) return "Failed to save favorite zone";
    return true;
}