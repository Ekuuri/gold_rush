<?php

declare(strict_types=1);

function checkSignUpErrors() {
    if (isset($_SESSION["errorsSignUp"])) {
        $errors = $_SESSION["errorsSignUp"];

        echo '<br><div class="card mx-auto" style="width: 30rem;"><div class="card-body"><p class="card-text">';

        foreach ($errors as $error) {
            echo $error . "<br>";        
        };

        echo '</p></div></div>';

        unset($_SESSION["errorsSignUp"]);
    } 
    else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br><div class="card mx-auto" style="width: 30rem;"><div class="card-body"><p class="card-text">Úspěšné příhlášení!</p></div></div>';
    } 
    else if (isset($_GET["signup"]) && $_GET["signup"] === "failed") {
        echo "<script> toggleRegister(); </script>";
    }
}

function signupInputs() {
    if (isset($_SESSION["signupData"]["username"]) && !isset($_SESSION["errorsSignUp"]["usernameTaken"])) {
        echo '<div class="row justify-content-center p-1">';
        echo '<input type="text" name="username" class="form-control w-50" placeholder="Přihlašovací jméno" autofocus value="' . $_SESSION["signupData"]["username"] . '">';
        echo '</div>';
    }
    else {
        echo '<div class="row justify-content-center p-1">';
        echo '<input type="text" name="username" class="form-control w-50" placeholder="Přihlašovací jméno" autofocus>';
        echo '</div>';
    }

    if (isset($_SESSION["signupData"]["email"]) && !isset($_SESSION["errorsSignUp"]["emailTaken"]) && !isset($_SESSION["errorsSignUp"]["invalidEmail"])) {
        echo '<div class="row justify-content-center p-1">';
        echo '<input type="email" name="email" class="form-control w-50" placeholder="E-mailová adresa" autofocus value="' . $_SESSION["signupData"]["email"] . '">';
        echo '</div>';
    }
    else {
        echo '<div class="row justify-content-center p-1">';
        echo '<input type="email" name="email" class="form-control w-50" placeholder="E-mailová adresa" autofocus>';
        echo '</div>';
    }
}