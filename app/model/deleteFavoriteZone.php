<?php
require_once __DIR__ . '/../util/databaseConnection.php';

function deleteFavoriteZone($userId, $zoneId) {
    try {
        $db = DatabaseConnection::get();
        if (empty($userId) || empty($zoneId)) {
            return "Missing required data";
        }
        
        $stmt = $db->prepare("SELECT idUser FROM LovedZone WHERE idUser = ? AND idZone = ?");
        $stmt->bind_param("ii", $userId, $zoneId);
        $stmt->execute();
        $existing = $stmt->get_result()->fetch_assoc();
        
        if (!$existing) {
            return "Favorite zone not found";
        }
        
        $stmt = $db->prepare("DELETE FROM LovedZone WHERE idUser = ? AND idZone = ?");
        $stmt->bind_param("ii", $userId, $zoneId);
        
        if (!$stmt->execute()) {
            return "Failed to delete favorite zone: " . $stmt->error;
        }
        
        if ($stmt->affected_rows === 0) {
            return "No favorite zone was deleted";
        }
        
        return true;
        
    } catch (Exception $e) {
        return "Database error: " . $e->getMessage();
    }
}
