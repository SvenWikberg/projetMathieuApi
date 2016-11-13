<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");
    ?>
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style-heroes.css">
        <script src="script.js"></script>
    </head>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
			<li class="navName"><a href="login.php"><h2>Login</h2></a></li>
        </ul>
    </header>
    <body>
        <?php
            foreach (sqlSelectHeroes() as $hero){
                echo '<div>
                          <a href="hero.php?id=' . $hero['id_hero'] . '"><div class="heroes">' . $hero['name'] . '</div></a>
                          <p>' . $hero['description'] . '</p>
                      </div>';
            }
        ?>
    </body>
</html>