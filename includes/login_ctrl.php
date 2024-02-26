<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $password) {
    if (empty($username) || empty($password)) {
        return true;
    }
    else {
        return false;
    }
}

function isUsernameWrong($result) { //bool|array in PHP 8.1
    if (!$result) {
        return true;
    }
    else {
        return false;
    }
}

function isPasswordWrong(string $password, string $passHash) {
    if (!password_verify($password, $passHash)) {
        return true;
    }
    else {
        return false;
    }
}
