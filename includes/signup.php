<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatpassword = $_POST["repeatpassword"];

    try {
        require_once("config_db.php");
        require_once("signup_view.php");
        require_once("signup_model.php");
        require_once("signup_ctrl.php");

        // ERROR HANDLING
        $errors = [];

        if (isInputEmpty($username, $email, $password)){
            $errors["emptyInput"] = "Vyplňte všechny položky!";
        }
        if (isEmailInvalid($email)) {
            $errors["invalidEmail"] = "Neplatná e-mailová adresa!";
        }
        if (isUsernameTaken($db, $username)) {
            $errors["usernameTaken"] = "Uživatelské jméno je již zabrané!";
        }
        if (isUsernameTooLong($username)) {
            $errors["usernameTooLong"] = "Uživatelské jméno je příliš dlouhé! Pouze 12 znaků!";
        }
        if (isEmailRegistered($db, $email)) {
            $errors["emailTaken"] = "E-mailová adresa je již zaregistrovaná!";
        }
        if (isPasswordNotMatching($password, $repeatpassword)) {
            $errors["passwordNotMatching"] = "Hesla jsou neshodná!";
        }

        require_once("config_session.php");

        if ($errors) {
            $_SESSION["errorsSignUp"] = $errors;

            $singupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signupData"] = $singupData;

            header("Location: ../index.php?signup=failed");
            die();
        }

        createUser($db, $username, $email, $password);

        header("Location: ../index.php?signup=success");

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