<?php

declare(strict_types=1);

function getUser(object $db, string $username) {
    $query = "SELECT * FROM users WHERE userName = :username;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}