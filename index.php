<?php
    require_once("includes/signup_view.php");
    require_once("includes/login_view.php");
    require_once("includes/config_session.php");

    // Vyhození ze stránky, pokud je uživatel přihlášen
    if (isset($_SESSION["userUsername"])) {
        header("Location: game.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Rush</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');

        @font-face {
            font-family: Minecraftia;
            src: url("img/MinecraftRegular-Bmg3.otf");
        }

        body {
            /* fallback pro staré prohlížeče */
            background: #30cfd0;
  
            background: linear-gradient(to right, rgba(48,207,208,0.5), rgba(51,8,103,0.5));
            font-family: 'Minecraftia', 'VT323', monospace;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <a href="leaderboard.php" class="btn btn-warning position-fixed end-0" role="button">Zobrazit žebříček</a> 

    <!-- Formulář přihlášení -->
    <section id="loginForms" class="pt-3">
        <form action="includes/login.php" method="post" id="login" class="container bg-dark border border-light text-light">
            <h1 class="m-3 text-center">Přihlášení</h1>

            <!-- Přihlášení sociální sití
            <div class="text-center">
                <button class="btn btn-danger" type="button"><i class="bi bi-google"></i> Přihlásit se pomocí Google</button>
                <button class="btn btn-outline-light" type="button"><i class="bi bi-github"></i> Přihlásit se pomocí GitHub</button>
            </div>
            <p class="text-center pt-4">NEBO</p>-->

            <!-- Přihlášení účtem -->
            <div class="row justify-content-center p-1">
                <input type="text" id="inputName" name="username" class="form-control w-50" placeholder="Přihlašovací jméno" required autofocus>
            </div>

            <div class="row justify-content-center p-1">
                <input type="password" id="inputPass" name="password" class="form-control w-50" placeholder="Heslo" required>
            </div>

            
            <!--<div class="row mt-3">
                <div class="col d-flex justify-content-end">
                     Zachování přihlášení při znovuotevření
                    <div class="form-check">
                        <input type="checkbox" id="rememberMe" class="form-check-input">
                        <label for="rememberMe" class="form-check-label">Zapamatovat si mě</label>
                    </div>
                </div>
    
                 Přesun na zapomenutí hesla
                <div class="col">
                    <a href="#" onclick="toggleResetPass()" class="text-decoration-none text-info">Zapomněli jste heslo?</a>
                </div> 
            </div>-->
            
            <!-- Přihlásení -->
            <div class="text-center pt-3">
                <button class="btn btn-success" type="submit"><i class="bi bi-box-arrow-in-right"></i> Přihlásit se</button>
            </div>
            
            <hr>

            <!-- Přesun na založení účtu -->
            <div class="text-center m-3">
                <button class="btn btn-primary" type="button" onclick="toggleRegister()"><i class="bi bi-person-plus"></i> Nová registrace</button>
            </div>           
        </form>

        <!-- Zapomenutí hesla -->
        <form action="" id="resetPass" class="container bg-dark border border-light text-light d-none">
            <h1 class="m-3 text-center">Zapomenuté heslo</h1>
            <p class="text-center">Zadejte prosím Váš přihlašovací e-mail. Následně na tuto adresu pošleme odkaz pro obnovu hesla.</p>

            <div class="row justify-content-center m-3">
                <input type="email" id="resetEmail" class="form-control w-50" placeholder="E-mailová adresa" required autofocus>
            </div>
            
            <div class="container text-center">
                <div class="row justify-content-center m-2">
                    <div class="col-4 mt-2"><a href="#" class="text-info text-decoration-none" onclick="toggleResetPass()"><i class="bi bi-caret-left"></i> Zpět</a></div>
                    <div class="col-4 mb-2"><button class="btn btn-primary" type="submit">Obnovit heslo</button></div>
                </div>
            </div>   
        </form>
        
        <!-- Založení účtu // Registrace -->

        <form action="includes/signup.php" method="post" id="register" class="container bg-dark border border-light text-light d-none">
            <h1 class="m-3 text-center">Nový uživatel</h1>

            <!-- Uživatelské jméno a heslo -->
            <?php
                signupInputs();
            ?>

            <!-- Heslo -->
            <div class="row justify-content-center p-1">
                <input type="password" id="userPass" name="password" class="form-control w-50" placeholder="Heslo" autofocus>
            </div>

            <!-- Heslo znovu -->
            <div class="row justify-content-center p-1">
                <input type="password" id="userRepeatPass" name="repeatpassword" class="form-control w-50" placeholder="Heslo znovu" autofocus>
            </div>

            <div class="container text-center">
                <div class="row justify-content-center m-3">
                    <div class="col-4 mt-2"><a href="#" class="text-info text-decoration-none" onclick="toggleRegister()"><i class="bi bi-caret-left"></i> Zpět</a></div>
                    <div class="col-4"><button class="btn btn-primary" name="newacc" type="submit"><i class="bi bi-person-plus"></i> Zaregistrovat se</button></div>
                </div>
            </div> 
        </form>      
    </section>
    <script>
        function toggleResetPass() {
            var LogPage = document.getElementById("login");
            var PassPage = document.getElementById("resetPass");

            if (PassPage.classList.contains("d-none")) {
                PassPage.classList.remove("d-none");
                LogPage.classList.add("d-none");
            } else {
                PassPage.classList.add("d-none");
                LogPage.classList.remove("d-none");
            }
        }

        function toggleRegister() {
            var LogPage = document.getElementById("login");
            var RegPage = document.getElementById("register");

            if (RegPage.classList.contains("d-none")) {
                RegPage.classList.remove("d-none");
                LogPage.classList.add("d-none");
            } else {
                RegPage.classList.add("d-none");
                LogPage.classList.remove("d-none");
            }
        }
    </script>

    <?php
        checkLoginErrors();
        checkSignUpErrors();
    ?>
</body>
</html>