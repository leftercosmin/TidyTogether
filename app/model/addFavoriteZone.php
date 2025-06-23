<?php
require_once __DIR__ . '/../util/databaseConnection.php';

function addFavoriteZone($userId, $neighborhood, $city, $country, $lat, $lng) {
    try {
        $db = DatabaseConnection::get();
        
        // Validate input
        if (empty($userId) || empty($lat) || empty($lng)) {
            return "Missing required data";
        }
        
        // Use default values if neighborhood or city are empty
        if (empty($neighborhood)) {
            $neighborhood = "Unknown Area";
        }
        if (empty($city)) {
            $city = "Unknown City";
        }
        if (empty($country)) {
            $country = "Unknown Country";
        }
        
        // Check if zone exists
        $stmt = $db->prepare("SELECT id FROM Zone WHERE name=? AND city=? AND country=?");
        $stmt->bind_param("sss", $neighborhood, $city, $country);
        $stmt->execute();
        $res = $stmt->get_result();
        $zone = $res->fetch_assoc();

        // Insert zone if it doesn't exist
        if (!$zone) {
            $stmt = $db->prepare("INSERT INTO Zone (name, city, country) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $neighborhood, $city, $country);
            if (!$stmt->execute()) {
                return "Failed to insert zone: " . $stmt->error;
            }
            $zoneId = $db->insert_id;
        } else {
            $zoneId = $zone['id'];
        }

        // Check if this user already has this zone as favorite
        $stmt = $db->prepare("SELECT idUser FROM LovedZone WHERE idUser = ? AND idZone = ?");
        $stmt->bind_param("ii", $userId, $zoneId);
        $stmt->execute();
        $existing = $stmt->get_result()->fetch_assoc();
        
        if ($existing) {
            return "Zone already saved as favorite";
        }

        // Insert into LovedZone with coordinates
        $stmt = $db->prepare("INSERT INTO LovedZone (idUser, idZone, lat, lng) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iidd", $userId, $zoneId, $lat, $lng);
        
        if (!$stmt->execute()) {
            return "Failed to save favorite zone: " . $stmt->error;
        }
        
        return true;
        
    } catch (Exception $e) {
        return "Database error: " . $e->getMessage();
    }
}