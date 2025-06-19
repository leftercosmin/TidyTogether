<?php

function getPendingReports(int $id): array|string
{    
    $db = $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error: " . $db->connect_error;
    }

    $statement = $db->prepare('SELECT * FROM Post WHERE idUser=? AND status="pending"');
    if (!$statement) { 
        return "error - getReport(): failed to prepare SQL statement";
    }

    if(!$statement->bind_param('i', $id)) {
        $statement->close();
        return "error - getReport(): failed to bind parameters";
    }

    if(!$statement->execute()) {
        $statement->close();
        return "error - getReport(): failed to execute SQL statement";
    }

    $result = $statement->get_result();
    $statement->close();

    if (!$result) {
        return "error - getReport(): failed to retrieve reports";
    }

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        if (false === $row) {
            return "error - getReport(): failed to fetch reports";
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

    $statement = $db->prepare('UPDATE Report SET status="approved" WHERE id=?');
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

    $statement = $db->prepare('UPDATE Report SET status="denied" WHERE id=?');
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