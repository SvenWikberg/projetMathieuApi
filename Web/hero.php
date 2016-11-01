<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style-hero.css">
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
		<section id="lore">
			<?php $hero = hero($_GET['id']); ?>
				
			<div id="name">
				<h1><?php echo $hero->name ?></h1>
				<h2><?php echo $hero->real_name ?></h2>
			</div>
				
			<div id="info">
				<p>Affiliation : <?php echo (empty($hero->affiliation))?'None':$hero->affiliation ?></p>
				<p>Base Of Operations : <?php echo (empty($hero->base_of_operations))?'None':$hero->base_of_operations ?></p>
			</div>
		</section>
		
		<section id="game">
			<div id="role">
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

			<div id="stats">
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
		</section>
		
		
		<section id="abilities">
			<h1>Abilities</h1>
			<div>
				<?php
					foreach($hero->abilities as $ability)
						{
							echo '<div>';
							echo 	'<h2>' . $ability->name . '</h2>';
							echo 	'<p>' . $ability->description . '</p>';
							echo '</div>';
						} 
				?>
			</div>
		</section>
		
		<section id="rewards">
			<h1>Rewards</h1>
			<?php

			$skinTab = [
				'title' => '<h2>Skins</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$introTab = [
				'title' => '<h2>Highlight Intros</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$emoteTab = [
				'title' => '<h2>Emotes</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$poseTab = [
				'title' => '<h2>Victory Poses</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$sprayTab = [
				'title' => '<h2>Sprays</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$voiceTab = [
				'title' => '<h2>Voice Lines</h2>',
				'common' => '<p class="commonp">Common</p><div class="common">',
				'rare' => '<p class="rarep">Rare</p><div class="rare">',
				'epic' => '<p class="epicp">Epic</p><div class="epic">',
				'legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];


			$rewardTab = [
				'skin' => $skinTab,
				'highlight intro' => $introTab,
				'emote' => $emoteTab,
				'victory pose' => $poseTab,
				'spray' => $sprayTab,
				'voice line' => $voiceTab
			];

				foreach($hero->rewards as $reward)
				{
					$rewardTab[$reward->type->name][$reward->quality->name] .= '<p>' . $reward->name . '</p>';
				} 
				
				foreach($rewardTab as $tab){
					foreach($tab as $itemQuality){
						if($itemQuality[strlen($itemQuality) - 2] == 'p' || $itemQuality[strlen($itemQuality) - 2] == '2'){ //si l'avant dernier caractere est un 'p' ou un '2' ça veut dire qu'on a ajouté une reward dans ce string donc on l'affiche
								$itemQuality .= '</div>';
								echo $itemQuality;
						}
					}
				}
			?>
			<section id="skin">
			</section>
		</section>
    </body>
</html>












































