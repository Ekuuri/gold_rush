<?php
    require_once("includes/login_view.php");
    require_once("includes/config_session.php");

    // Vyhození ze stránky, pokud uživatel není přihlášen
    if (!isset($_SESSION["userUsername"])) {
        header("Location: index.php");
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
    <style>
        body {
            /* fallback pro staré prohlížeče */
            background: #30cfd0;
  
            background: linear-gradient(to right, rgba(48,207,208,0.5), rgba(51,8,103,0.5))
        }

        canvas {
            background: whitesmoke;
        }

        .top-right {
            top: 0;
            right: 0;
        }

        .game-container {
            transform: scale(3) translateY(50%);
        }

        .game-container canvas {
            image-rendering: pixelated;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Vysouvací menu -->
    <button class="btn btn-primary position-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#testMenu" aria-controls="testMenu">
        Testovací menu
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="testMenu" aria-labelledby="testMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="testMenuLabel">Výběr obrazovky:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Pohyb pouze pro účely první kontroly.
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Vybrat
                </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Přihlášení</a></li>
                <li><a class="dropdown-item" href="game.php">Hra</a></li>
                <li><a class="dropdown-item" href="leaderboard.php">Žebříček</a></li>
            </ul>
            </div>
        </div>
    </div>
    <!-- Konec vysouvacího menu-->

    <button class="btn btn-warning position-fixed top-right" style="top:40px" onclick="toggleFullscreen()">Fullscreen</button>
    <form action="includes/logout.php">
        <button class="btn btn-danger position-fixed top-right" type="submit">Odhlásit se</button>
    </form>

    <div class="container text-center pt-3 game-container">
        <canvas id="game" class="border border-black">Váš prohlížeč nepodporuje Canvas tag.</canvas>
    </div>
    
    <script src="game/character.js"></script>
    <script src="game/house.js"></script>
    <script src="game/mine.js"></script>
    <script src="game/init.js"></script>

    <script>
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                c.requestFullscreen().catch((err) => {
                    alert(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`,);
                });
            } else {
                document.exitFullscreen();
            }
        }

        var c = document.getElementById("game");
        var ctx = c.getContext("2d");

        const canvasWidth = c.width = 352;
        const canvasHeight = c.height = 198;

        function animate(){
            ctx.clearRect(0, 0, canvasWidth, canvasHeight);
            let position = Math.floor(gameFrame / staggerFrames) % spriteAnimations[playerState].loc.length;
            let frameX = spriteWidth * position;
            let frameY = spriteAnimations[playerState].loc[position].y;
            ctx.drawImage(playerImage, frameX, frameY, spriteWidth, spriteHeight, 0, 0, canvasWidth, canvasHeight);

            gameFrame++;
            requestAnimationFrame(animate);
        }
        //animate();
    </script>
</body>
</html>