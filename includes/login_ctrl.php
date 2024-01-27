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

function isUsernameWrong(bool|array $result) {
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