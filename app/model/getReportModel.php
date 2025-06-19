<?php

function getPendingReports(): array|string
{    
    $db = $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error: " . $db->connect_error;
    }

    $sql = 'SELECT 
                Post.*, 
                Zone.name AS neighbourhood, 
                Zone.city, 
                Zone.country
            FROM Post
            LEFT JOIN Zone ON Post.idZone = Zone.id
            WHERE Post.status="pending"';

    $statement = $db->prepare($sql);
    if (!$statement) { 
        return "error - getPendingReports(): failed to prepare SQL statement";
    }

    // if(!$statement->bind_param('i', $id)) {
    //     $statement->close();
    //     return "error - getReport(): failed to bind parameters";
    // }

    if(!$statement->execute()) {
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

function approveReport(int $reportID) : string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error: " . $db->connect_error;
    }

    $statement = $db->prepare('UPDATE Post SET status="inProgress" WHERE id=?');
    if (!$statement) {
        return "error - approveReport(): failed to prepare SQL statement";
    }

    if (!$statement->bind_param('i', $reportID)) {
        $statement->close();
        return "error - approveReport(): failed to bind parameters";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - approveReport(): failed to execute SQL statement";
    }

    $statement->close();
    return "Success - report approved";
}

function denyReport(int $reportID) : string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error: " . $db->connect_error;
    }

    $statement = $db->prepare('UPDATE Post SET status="denied" WHERE id=?');
    if (!$statement) {
        return "error - denyReport(): failed to prepare SQL statement";
    }

    if (!$statement->bind_param('i', $reportID)) {
        $statement->close();
        return "error - denyReport(): failed to bind parameters";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - denyReport(): failed to execute SQL statement";
    }

    $statement->close();
    return "Success - report denied";
}

function getApprovedReports(): array|string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error: " . $db->connect_error;
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