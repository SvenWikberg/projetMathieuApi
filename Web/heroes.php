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
        <?php

            foreach (heroes()->data as $hero){
                echo '<div>
                          <a href="hero.php?id=' . $hero->id . '"><div class="heroes">' . $hero->name . '</div></a>
                          <p>' . $hero->description . '</p>
                      </div>';
            }

        ?>
    </body>
</html>