<?php
require_once("config_db.php");
require_once("config_session.php");
require_once("logout_model.php");

$id = $_SESSION["userId"];
$score = $_POST["score"];

if ($score > 0) {
    setScore($db, $id, $score);
}

unset($_COOKIE['save']);
setcookie('save', '', time() - 3600, "/gold_rush");

session_unset();
session_destroy();

header("Location: ../index.php");
die();
