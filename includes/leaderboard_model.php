<?php

declare(strict_types=1);

function getScore(object $db) {
    $query = "SELECT userName, createdDatetime, result FROM leaderboard;";
    $stmt = $db->prepare($query);
    $result = $stmt->execute();

    $result = $stmt->fetchAll();
    return $result;
}