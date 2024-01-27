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
        body {
            /* fallback pro staré prohlížeče */
            background: #30cfd0;
  
            background: linear-gradient(to right, rgba(48,207,208,0.5), rgba(51,8,103,0.5))
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

    <section id="leaderboard" class="pt-3">
        <h1 class="mb-3 text-center">Žebříček</h1>
        <div class="container text-center">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Přezdívka</th>
                        <th scope="col">Den dosažení</th>
                        <th scope="col">Dní přežito / Skóre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>EdwardNewgate</td>
                        <td>31/12/23</td>
                        <td>666</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>RatBussy</td>
                        <td>02/01/24</td>
                        <td>420</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Sixprape</td>
                        <td>03/01/24</td>
                        <td>333</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>JimmyDooLong</td>
                        <td>31/12/23</td>
                        <td>332</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>𓃗</td>
                        <td>31/12/23</td>
                        <td>150</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>ChadThundercockSuperStraight</td>
                        <td>03/01/24</td>
                        <td>69</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>OnionSaucy</td>
                        <td>02/01/24</td>
                        <td>68</td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>DrunkDriver</td>
                        <td>03/01/24</td>
                        <td>56</td>
                    </tr>
                    <tr>
                        <th scope="row">9</th>
                        <td>SuperStroker</td>
                        <td>02/01/24</td>
                        <td>48</td>
                    </tr>
                    <tr>
                        <th scope="row">10</th>
                        <td>FemboyHooters</td>
                        <td>03/01/24</td>
                        <td>47</td>
                    </tr>
                    <tr>
                        <th scope="row">11</th>
                        <td>PizzaWarmer</td>
                        <td>02/01/24</td>
                        <td>31</td>
                    </tr>
                    <tr>
                        <th scope="row">12</th>
                        <td>MaleUnderwear</td>
                        <td>30/12/23</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <th scope="row">13</th>
                        <td>ChipyChipy</td>
                        <td>03/01/24</td>
                        <td>18</td>
                    </tr>
                    <tr>
                        <th scope="row">14</th>
                        <td>SkibidiToilet</td>
                        <td>03/01/24</td>
                        <td>17</td>
                    </tr>
                    <tr>
                        <th scope="row">15</th>
                        <td>AbsoluteZero</td>
                        <td>30/12/23</td>
                        <td>16</td>
                    </tr>
                    <tr>
                        <th scope="row">16</th>
                        <td>2000FordF150</td>
                        <td>30/12/23</td>
                        <td>14</td>
                    </tr>
                    <tr>
                        <th scope="row">17</th>
                        <td>Bloomrash</td>
                        <td>03/01/24</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <th scope="row">18</th>
                        <td>MinecraftCreeper</td>
                        <td>02/01/24</td>
                        <td>11</td>
                    </tr>
                    <tr>
                        <th scope="row">19</th>
                        <td>GangnamStyle</td>
                        <td>31/12/23</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <th scope="row">20</th>
                        <td>TheTownInsideMe</td>
                        <td>01/01/24</td>
                        <td>3</td>
                    </tr>
                  </tbody>
            </table>
        </div>
    </section>
</body>
</html>