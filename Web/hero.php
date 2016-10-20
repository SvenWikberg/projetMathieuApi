<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <?php
        include_once("functions.php");
    ?>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="#"><h2>All Rewards</h2></a></li>
        </ul>
    </header>
    <body>
        <section>
            <div id="name">
                <h1>Ana</h1>
                <h2>Ana Amari</h2>
            </div>
            <div id="lore_info">
                <p>Affiliation : Overwatch</p>
                <p>Base Of Operations : Cairo, Egypt</p>
            </div>
            <div id="game_info">
                <div>
                    <p>200</p>
                    <img src="" alt="">
                </div>
                <div>
                    <p>0</p>
                    <img src="" alt="">
                </div>
                <div>
                    <p>0</p>
                    <img src="" alt="">
                </div>
                <div>
                    <img src="" alt="">
                </div>
            </div>
        </section>
    </body>
</html>