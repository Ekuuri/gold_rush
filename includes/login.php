<?php
require_once("config_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once("config_db.php");
        require_once("login_model.php");
        require_once("login_ctrl.php");

        // ERROR HANDLING
        $errors = [];

        if (isInputEmpty($username, $password)){
            $errors["emptyInput"] = "Vyplňte všechny položky!";
        }

        $result = getUser($db, $username);

        if (isUsernameWrong($result)){
            $errors["usernameWrong"] = "Špatné přihlašovácí údaje!";
        }
        if (isPasswordWrong($password, $result["passwordBcrypt"]) && !isUsernameWrong($result)){
            $errors["passwordWrong"] = "Špatné přihlašovácí údaje!";
        } 

        if ($errors) {
            $_SESSION["errorsLogIn"] = $errors;

            header("Location: ../index.php?login=failed");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["userId"];
        session_id($sessionId);

        $_SESSION["userId"] = $result["userId"];
        $_SESSION["userUsername"] = htmlspecialchars($result["userName"]);

        $_SESSION["last_regen"] = time();

        header("Location: ../game.php?login=success");
        $db = null;
        $stmt = null;

        die();
    }
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
    die();
}