<?php

function approveReport(int $reportID): string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - approveReport(): " . $db->connect_error;
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

function denyReport(int $reportID): string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - denyReport(): " . $db->connect_error;
    }

    $statement = $db->prepare('DELETE FROM Post WHERE id=?');
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

function markReportDone(int $reportID): string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - markReportDone(): " . $db->connect_error;
    }

    $statement = $db->prepare('UPDATE Post SET status="done" WHERE id=?');
    if (!$statement) {
        return "error - markReportDone(): failed to prepare SQL statement";
    }

    if (!$statement->bind_param('i', $reportID)) {
        $statement->close();
        return "error - markReportDone(): failed to bind parameters";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - markReportDone(): failed to execute SQL statement";
    }

    $statement->close();
    return "Success - report marked as done";
}
