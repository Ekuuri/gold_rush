<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $email, string $password) {
    if (empty($username) || empty($email) || empty($password)) {
        return true;
    }
    else {
        return false;
    }
}

function isEmailInvalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

function isUsernameTaken(object $db, string $username) {
    if (getUsername($db, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function isUsernameTooLong(string $username) {
    if (strlen($username) > 12) {
        return true;
    }
    else {
        return false;
    }
}

function isEmailRegistered(object $db, string $email) {
    if (getEmail($db, $email)) {
        return true;
    }
    else {
        return false;
    }
}

function createUser(object $db, string $username, string $email, string $password) {
    setUser($db, $username, $email, $password);
}