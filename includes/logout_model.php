<?php

declare(strict_types=1);

function setScore(object $db, string $user, int $score) {
    $query = "INSERT INTO score (userId, result) VALUES (?, ?);";
    $stmt = $db->prepare($query);
    $result = $stmt->execute([$user, $score]);
}