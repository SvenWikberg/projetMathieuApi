<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style-rewards.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <?php
        include_once("functions.php");
    ?>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
        </ul>
    </header>
    <body>
        <section id="playerIcon">
            <h2>Player Icons</h2>
            <div>
                <?php
                    foreach(sqlSelectPlayerIcons() as $playerIcon){
                        echo '<p>' . $playerIcon['name'] . '</p>';
                    }
                ?>
            </div>
        </section>
        <section>
            <h2>Sprays</h2>
            <div>
                <?php
                    foreach(sqlSelectSprays() as $sprays){
                        echo '<p>' . $sprays['name'] . '</p>';
                    }
                ?>
            </div>
        </section>
		<script>
			$( "p" ).click(function() {
				$( this ).css('color', '#00FF4C');
			});
		</script>
    </body>
</html>