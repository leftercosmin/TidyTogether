<?php

/*
 * returns an array of instances containing:
   id     BIGINT,
   name   VARCHAR,
   size   BIGINT,
   source VARCHAR,
   format ENUM,
   idPost BIGINT,
 */
function getMediaModel(int $idPost): array|string
{
    $db = DatabaseConnection::get();
    if (null === $db || $db->connect_error) {
        $db->close();
        return "error - getMediaModel(): " . $db->connect_error;
    }

    $sql = 'SELECT * FROM Media WHERE idPost=?';
    $statement = $db->prepare($sql);
    if (!$statement) {
        return "error - getMediaModel(): failed to prepare SQL statement";
    }

    if (!$statement->bind_param('i', $idPost)) {
        $statement->close();
        return "error - getMediaModel(): failed to bind parameters";
    }

    if (!$statement->execute()) {
        $statement->close();
        return "error - getMediaModel(): failed to execute SQL statement";
    }

    $result = $statement->get_result();
    $statement->close();
    if (!$result) {
        return "error - getMediaModel(): failed to retrieve reports";
    }

    $media = [];
    while ($row = $result->fetch_assoc()) {
        if (false === $row) {
            return "error - getMediaModel(): failed to fetch reports";
        }

        $media[] = $row;
    }

    return $media;
}
