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

    <form action="includes/logout.php" method="post">
        <input type="hidden" name="score" id="emeralds">
        <button class="btn btn-danger position-fixed top-right" type="submit">Odhlásit se a uložit skóre</button>
    </form>
    <button class="btn btn-warning position-fixed end-0" style="top:40px" onclick="mute()">Ztlumit zvuky</button> 
    <button type="button" class="btn btn-primary position-fixed end-0" style="top:80px" data-bs-toggle="modal" data-bs-target="#tutorial">Tutorial</button>

    <div class="modal fade" id="tutorial" tabindex="-1" aria-labelledby="tutorialLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tutorialLabel">Tutorial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cílem hry je získat, co nejvíc měny (ukázána vedle zeleného drahokamu).</p>
                    <p>Kliknutím (levým myšítkem) kdekoli, krom menu na právé straně obrazovky, vytěžíte rudu na obrázku a získáte měnu.</p>
                    <p>Kliknutím na jedno ze žlutých tlačítek si zakoupíte zmíněný předmět na tlačítku.</p>
                    <p>Vylepšení krumpáče a rudy přímo ovlivňují kolik měny získáte každým kliknutím rudy.</p>
                    <p>Zaměstnáním vesničanů začnete získávat měnu automaticky každých několik sekund (indikováno zvukovým efektem).</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                </div>
            </div>
        </div>
    </div>

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
        var totaleme = 0;

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

        var pickaxeUpgrade = new Shop({x: 600, y: 100, cost: 25, text: "Vylepšit krumpáč!"});
        pickaxeUpgrade.onClick = () => {
            if (pickLevel == 6) {
                pickaxeUpgrade.isButtonEnabled = false;
            }            
            pickaxeUpgrade.buy()
            pickLevel++
        }
        buttons.push(pickaxeUpgrade);

        var oreUpgrade = new Shop({x: 600, y: 190, cost: 100, text: "Vylepšit rudu!"});
        oreUpgrade.onClick = () => {
            if (oreLevel == 5) {
                oreUpgrade.isButtonEnabled = false;
            }           
            oreUpgrade.buy()
            oreLevel++
        }
        buttons.push(oreUpgrade);

        var childBuy = new Shop({x: 600, y: 280, cost: 1000, text: "Zaměstnat vesnické dítě!"});
        childBuy.onClick = () => {
            childBuy.buy()
            childMiners++
        }
        buttons.push(childBuy);

        var villBuy = new Shop({x: 600, y: 370, cost: 3500, text: "Zaměstnat starého horníka!"});
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

            // aktualizace skore
            document.getElementById("emeralds").setAttribute('value', totaleme);
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
                totaleme += 100 * 3 ** childMiners
                var child = new Audio("img/childMiner.mp3")
                if (!isMuted)child.play()
            }
            
        }, 5000);

        setInterval(() => {
            if(villMiners > 0) {
                eme += 350 * 5 ** villMiners
                totaleme += 350 * 5 ** villMiners
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

        function formatEmerald(eme) {
            if (eme < 1e3) return eme;
            if (eme >= 1e3 && eme < 1e6) return +(eme / 1e3).toFixed(1) + "K";
            if (eme >= 1e6 && eme < 1e9) return +(eme / 1e6).toFixed(1) + "M";
            if (eme >= 1e9 && eme < 1e12) return +(eme / 1e9).toFixed(1) + "B";
            if (eme >= 1e12) return +(eme / 1e12).toFixed(1) + "T";
        }
    </script>
</body>
</html>