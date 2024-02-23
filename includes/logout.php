<?php
require_once("config_db.php");
require_once("logout_model.php");
session_start();

$id = $_SESSION["userId"];
$score = $_POST["score"];

if ($score > 0) {
    setScore($db, $id, $score);
}

setcookie("save", '', 1, "/gold_rush");

session_unset();
session_destroy();

header("Location: ../index.php");
die();