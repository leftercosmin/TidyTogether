<?php

require_once "model/helper/getMainCityModel.php";

function getPendingReports(int $id): array|string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - getPendingReports(): " . $db->connect_error;
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
            LEFT JOIN Media ON Post.id = Media.idPost
            WHERE Post.status="pending"
            AND Zone.city=?';

    $statement = $db->prepare($sql);
    if (!$statement) {
        return "error - getPendingReports(): failed to prepare SQL statement";
    }

    $city = getMainCity($id, $db);
    if (str_starts_with($city, "error")) {
        $statement->close();
        return "error - getPendingReports(): failed to get main city";
    }

    if (!$statement->bind_param('s', $city)) {
        $statement->close();
        return "error - getPendingReports(): failed to bind parameters";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - getPendingReports(): failed to execute SQL statement";
    }

    $result = $statement->get_result();
    $statement->close();

    if (!$result) {
        return "error - getPendingReports(): failed to retrieve reports";
    }

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        if (false === $row) {
            return "error - getPendingReports(): failed to fetch reports";
        }

        $reports[] = $row;
    }

    return $reports;
}

function getApprovedReports(): array|string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - getApprovedReports(): " . $db->connect_error;
    }

    $statement = $db->prepare('SELECT * FROM Post WHERE status="inProgress"');
    if (!$statement) {
        return "error - getApprovedReports(): failed to prepare SQL statement";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - getApprovedReports(): failed to execute SQL statement";
    }

    $result = $statement->get_result();
    $statement->close();

    if (!$result) {
        return "error - getApprovedReports(): failed to retrieve reports";
    }

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        if (false === $row) {
            return "error - getApprovedReports(): failed to fetch reports";
        }
        $reports[] = $row;
    }

    return $reports;
}
