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

        canvas {
            background: whitesmoke;
        }

        .top-right {
            top: 0;
            right: 0;
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

    <button class="btn btn-warning position-fixed top-right" style="top:40px" onclick="mute()">Ztlumit zvuky</button>
    <form action="includes/logout.php">
        <button class="btn btn-danger position-fixed top-right" type="submit">Odhlásit se</button>
    </form>

    <div class="mx-auto text-center pt-3 game-container">
        <canvas id="game" class="border border-black">Váš prohlížeč nepodporuje Canvas tag.</canvas>
    </div>
    
    <script src="game/ore.js"></script>
    <script src="game/pick.js"></script>
    <script src="game/emerald.js"></script>
    <script src="game/shop.js"></script>

    <script>
        var c = document.getElementById("game");
        var ctx = c.getContext("2d");

        const canvasWidth = c.width = 1024;
        const canvasHeight = c.height = 576;

        // mute sounds
        var isMuted = false;

        // emerald counter
        var eme = 0;

        // ore counter
        var oreLevel = 1;

        // pick counter
        var pickLevel = 1;

        // child counter
        var childMiners = 0;

        // villager counter
        var villMiners = 0;

        // upgrade buttons
        var buttons = [];

        var pickaxeUpgrade = new Shop({x: 600, y: 100, cost: 25, text: "Upgrade pickaxe!"});
        pickaxeUpgrade.onClick = () => {
            if (pickLevel == 6) {
                pickaxeUpgrade.isButtonEnabled = false;
            }            
            pickaxeUpgrade.buy()
            pickLevel++
        }
        buttons.push(pickaxeUpgrade);

        var oreUpgrade = new Shop({x: 600, y: 190, cost: 100, text: "Upgrade ore!"});
        oreUpgrade.onClick = () => {
            if (oreLevel == 5) {
                oreUpgrade.isButtonEnabled = false;
            }           
            oreUpgrade.buy()
            oreLevel++
        }
        buttons.push(oreUpgrade);

        var childBuy = new Shop({x: 600, y: 280, cost: 1000, text: "Employ a Village Child!"});
        childBuy.onClick = () => {
            childBuy.buy()
            childMiners++
        }
        buttons.push(childBuy);

        var villBuy = new Shop({x: 600, y: 370, cost: 3500, text: "Employ an Old Miner!"});
        villBuy.onClick = () => {
            villBuy.buy()
            villMiners++
        }
        buttons.push(villBuy); 

        // SHOW ICONS
        function animate() {
            requestAnimationFrame(animate)
            // MENU 
            var menu = new Image();
            menu.src = "img/menu.png"
            ctx.drawImage(menu, 0, 0, 472, 600, 576, 0, 472, 576)

            // EMERALD
            var emerald = new Emerald({
                    emerald: eme
                })
            emerald.draw()

            // ORE
            globalThis.ore = new Ore({
                ore: oreLevel
            })
            ore.draw()

            // PICKAXE
            globalThis.pick = new Pick({
                pick: pickLevel
            })
            pick.draw()  

            // SHOP BUTTONS
            buttons.forEach(button => button.draw(c));
        }
        animate()

        c.addEventListener("click", (e) => {
            let x = e.pageX - (c.clientLeft + c.offsetLeft);
            let y = e.pageY - (c.clientTop + c.offsetTop);

            buttons.forEach(b => {
                if (b.inButton(x, y) && !!b.onClick && b.isButtonEnabled && b.cost <= eme) {
                    b.onClick();
                }
            });

            if (x <= 576) {
                pick.mine(ore.oreLevel)
                var mine = new Audio("img/mining_sound.mp3")
                if (!isMuted)mine.play()
            }
        })

        setInterval(() => {
            if(childMiners > 0) {
                eme += 100 * 3 ** childMiners
                var child = new Audio("img/childMiner.mp3")
                if (!isMuted)child.play()
            }
            
        }, 5000);

        setInterval(() => {
            if(villMiners > 0) {
                eme += 350 * 5 ** villMiners
                var villager = new Audio("img/villMiner.mp3")
                if (!isMuted)villager.play()
            }
        }, 7600);

        function mute() {
            if (isMuted) {
                isMuted = false;
            }
            else {
                isMuted = true;
            }
        }
    </script>
</body>
</html>