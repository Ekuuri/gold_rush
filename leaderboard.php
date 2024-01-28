<?php
    require_once("includes/config_db.php");
    require_once("includes/leaderboard_model.php");
    require_once("includes/leaderboard_view.php");
    require_once("includes/config_session.php");
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
    
    <a href="index.php" class="btn btn-warning position-fixed end-0" role="button">Zpět na přihlášení</a>

    <section id="leaderboard" class="pt-3">
        <h1 class="mb-3 text-center">Žebříček</h1>
        <div class="container text-center">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Přezdívka</th>
                        <th scope="col">Den dosažení</th>
                        <th scope="col">Skóre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $ranking = 1;
                        $leaderboard = getScore($db);

                        showLeaderboard($leaderboard, $ranking);
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>