<?php
require_once("config_db.php");
require_once("logout_model.php");
session_start();

$id = $_SESSION["userId"];
$score = $_POST["score"];

setScore($db, $id, $score);

session_unset();
session_destroy();

header("Location: ../index.php");
die();