<?php

declare(strict_types=1);

function getUsername(object $db, string $username) {
    $query = "SELECT userName FROM users WHERE userName = :username;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEmail(object $db, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setUser(object $db, string $username, string $email, string $password) {
    $query = "INSERT INTO users (userName, email, passwordBcrypt) VALUES (?, ?, ?);";
    $stmt = $db->prepare($query);

    $options = [
        "cost" => 12
    ];
    $passHash = password_hash($password, PASSWORD_BCRYPT, $options);

    $result = $stmt->execute([$username, $email, $passHash]);
}