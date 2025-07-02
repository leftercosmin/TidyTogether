<?php

/**
 * Summary of getReportModel
 * @param string $status
 * @param string $city
 * @param int $limit max number of reports to fetch
 * @return array<array|bool|null>|string
 * the json encoding can be found below:
 [
  {
    "id": 86,
    "description": "test",
    "status": "pending",
    "idUser": 13,
    "idZone": 46,
    "address": "Spitalul Clinic de Obstetrică-Ginecologie „Cuza Vodă” Iași, 34, Strada Cuza Vodă, Centru, Iași, Iași Metropolitan Area, Iași, 700040, Romania",
    "createdAt": "2025-06-21 15:05:45",
    "updatedAt": "2025-06-21 15:05:45",
    "neighbourhood": "Centru",
    "city": "Iasi",
    "country": "Romania",
    "fname": "Cosmin",
    "lname": "Lefter"
  },
  ...
 ]
 */
function getReportModel(string $status, string $city, int $limit = 0): array|string
{
    if ("" === $city) {
        return [];
    }

    if (str_starts_with($city, "error")) {
        return "error - getReports(): failed to get main city";
    }

    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - getReports(): " . $db->connect_error;
    }

    $sql = 'SELECT
                Post.*,
                Zone.name AS neighbourhood,
                Zone.city,
                Zone.country,
                User.fname,
                User.lname
            FROM Post
            LEFT JOIN Zone ON Post.idZone = Zone.id
            LEFT JOIN User ON Post.idUser = User.id
            WHERE Post.status=?
            AND Zone.city=?
            ORDER BY Post.createdAt ASC';
    
    // Add LIMIT clause if specified
    if ($limit > 0) {
        $sql .= ' LIMIT ?';
    }

    $statement = $db->prepare($sql);
    if (!$statement) {
        return "error - getReports(): failed to prepare SQL statement";
    }

    // Bind parameters based on whether limit is used
    if ($limit > 0) {
        if (!$statement->bind_param('ssi', $status, $city, $limit)) {
            $statement->close();
            return "error - getReports(): failed to bind parameters";
        }
    } else {
        if (!$statement->bind_param('ss', $status, $city)) {
            $statement->close();
            return "error - getReports(): failed to bind parameters";
        }
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - getReports(): failed to execute SQL statement";
    }

    $result = $statement->get_result();
    $statement->close();

    if (!$result) {
        return "error - getReports(): failed to retrieve reports";
    }

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        if (false === $row) {
            return "error - getReports(): failed to fetch reports";
        }

        $reports[] = $row;
    }

    return $reports;
}
