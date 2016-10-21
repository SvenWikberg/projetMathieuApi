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
			<?php $hero = hero($_GET['id']); ?>
				
			<div id="name">
			<h1><?php echo $hero->name ?></h1>
			<h2><?php echo $hero->real_name ?></h2>
			</div>
				
			<div id="lore_info">
				<p>Affiliation : <?php echo (empty($hero->affiliation))?'None':$hero->affiliation ?></p>
				<p>Base Of Operations : <?php echo (empty($hero->base_of_operations))?'None':$hero->base_of_operations ?></p>
			</div>
				
			<div class="game_info">
				<p>Role : <?php echo $hero->role->name ?></p>
				<?php
					if(!empty($hero->sub_roles))
					{
						echo '<p>Sub-Role : ';
						foreach($hero->sub_roles as $subRole)
						{
							echo ($subRole->id == count($hero->sub_roles) + 1)?$subRole->name:$subRole->name . ', ';
						}
						echo '</p>';
					}
				?>
			</div>

			<div class="game_info">
				<div>
					<p id="life"><?php echo $hero->health ?></p>
					<img src="img/heart.png" alt="Life">
				</div>
				<div>
					<p id="armor"><?php echo $hero->armour ?></p>
					<img src="img/armor.png" alt="Armor">
				</div>
				<div>
				<p id="shield"><?php echo $hero->shield ?></p>
				<img src="img/shield.png" alt="Shield">
				</div>
				<div>
				<?php
					for ($i = 1; $i <= $hero->difficulty; $i++) {
					echo '<img src="img/star.png" alt="Difficulty">';
					} 
				?>
				</div>
			</div>
		</section
    </body>
</html>












































