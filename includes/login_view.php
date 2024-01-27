<?php

declare(strict_types=1);

function checkLoginErrors() {
    if (isset($_SESSION["errorsLogIn"])) {
        $errors = $_SESSION["errorsLogIn"];

        unset($_SESSION["errorsLogIn"]);

        echo '<br><div class="card mx-auto" style="width: 30rem;"><div class="card-body"><p class="card-text">';
        foreach ($errors as $error) {
            echo $error . "<br>";        
        };
        echo '</p></div></div>';  
    } 
    else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<br><div class="card mx-auto" style="width: 30rem;"><div class="card-body"><p class="card-text">Úspěšné příhlášení!</p></div></div>';
    } 
    /*else if (isset($_GET["login"]) && $_GET["login"] === "failed") {
        echo "<script> toggleRegister(); </script>";
    }*/
}

function showUsername() {
    if (isset($_SESSION["userUsername"])) {
        echo "Jste přihlášeni jako " . $_SESSION["userUsername"];
    }
    else {
        echo "Nejste přihlášeni";
    }
}