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
			<?php
				$hero = hero($_GET['id']);
				
				echo '<div id="name">';
				echo 	'<h1>' . $hero->name . '</h1>';
				echo 	'<h2>' . $hero->real_name . '</h2>';
				echo '</div>';
				
				echo '<div id="lore_info">';
				echo 	'<p>Affiliation : ' . $hero->affiliation . '</p>';
				echo 	'<p>Base Of Operations : ' . $hero->base_of_operations . '</p>';
				echo 	'<p>Role : ' . $hero->role->name . '</p>';
				echo '</div>';
				
				echo '<div id="game_info">';
				echo 	'<div>';
				echo 		'<p id="life">' . $hero->health . '</p>';
				echo 		'<img src="img/heart.png" alt="Life">';
				echo 	'</div>';
				echo 	'<div>';
				echo 		'<p id="armor">' . $hero->armour . '</p>';
				echo		'<img src="img/armor.png" alt="Armor">';
				echo 	'</div>';
				echo 	'<div>';
				echo 		'<p id="shield">' . $hero->shield . '</p>';
				echo 		'<img src="img/shield.png" alt="Shield">';
				echo 	'</div>';
				echo    '<div>';
				for ($i = 1; $i <= $hero->difficulty; $i++) {
					echo '<img src="img/star.png" alt="Difficulty">';
				} 
                echo 	'</div>';
				echo '</div>';
			?>
		</section
    </body>
</html>












































