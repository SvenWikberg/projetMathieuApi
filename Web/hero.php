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
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
        </ul>
    </header>
    <body>
		<section id="lore">

			<?php $hero = sqlSelectHeroById($_GET['id'])[0]; ?>

			<div id="name">
				<h1><?php echo $hero['name'] ?></h1>
				<h2><?php echo $hero['real_name'] ?></h2>
			</div>
				
			<div id="info">
				<p>Affiliation : <?php echo (empty($hero['affiliation']))?'None':$hero['affiliation'] ?></p>
				<p>Base Of Operations : <?php echo (empty($hero['base_of_operations']))?'None':$hero['base_of_operations'] ?></p>
			</div>
		</section>
		
		<section id="game">
			<div id="role">
				<p>Role : <?php print_r(sqlSelectRoleById($hero['id_role'])[0]['name']); ?></p>
				<?php
					$sub_roles = sqlSelectSubRolesByIdHero($hero['id_hero']);

					if(!empty($sub_roles))
					{
						echo '<p>Sub-Role : ';
						foreach($sub_roles as $subRole)
						{
							echo ($subRole == end($sub_roles))?$subRole['name']:$subRole['name'] . ', ';
						}
						echo '</p>';
					}
				?>
			</div>

			<div id="stats">
				<div>
					<p id="life"><?php echo $hero['health'] ?></p>
					<img src="img/heart.png" alt="Life">
				</div>
				<div>
					<p id="armor"><?php echo $hero['armour'] ?></p>
					<img src="img/armor.png" alt="Armor">
				</div>
				<div>
				<p id="shield"><?php echo $hero['shield'] ?></p>
				<img src="img/shield.png" alt="Shield">
				</div>
				<div>
				<?php
					for ($i = 1; $i <= $hero['difficulty']; $i++) {
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
				$abilities = sqlSelectAbilitiesByIdHero($_GET['id']);
					foreach($abilities as $ability)
						{
							echo '<div>';
							echo 	'<h2>' . $ability['name'] . '</h2>';
							echo 	'<p>' . $ability['description'] . '</p>';
							echo '</div>';
						} 
				?>
			</div>
		</section>
		
		<section id="rewards">
			<h1>Rewards</h1>
			<?php

			$skinTab = [
				'Title' => '<h2>Skins</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$introTab = [
				'Title' => '<h2>Highlight Intros</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$emoteTab = [
				'Title' => '<h2>Emotes</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$poseTab = [
				'Title' => '<h2>Victory Poses</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$sprayTab = [
				'Title' => '<h2>Sprays</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];
			$voiceTab = [
				'Title' => '<h2>Voice Lines</h2>',
				'Common' => '<p class="commonp">Common</p><div class="common">',
				'Rare' => '<p class="rarep">Rare</p><div class="rare">',
				'Epic' => '<p class="epicp">Epic</p><div class="epic">',
				'Legendary' => '<p class="legendaryp">Legendary</p><div class="legendary">'
			];


			$rewardTab = [
				'Skin' => $skinTab,
				'Highlight Intro' => $introTab,
				'Emote' => $emoteTab,
				'Victory Pose' => $poseTab,
				'Spray' => $sprayTab,
				'Voice Line' => $voiceTab
			];

			$rewards = sqlSelectRewardsByIdHero($_GET['id']);
			$rewardTypes = sqlSelectRewardTypes();
			$qualities = sqlSelectQualities();

			foreach($rewards as $reward) // ajoute les rewards du hero dans les bons type et qualité de reward
			{             //nom du type de rewards (id du tableau associatif)  //nom de la qualité de la rewards (id du tableau associatif -> 2eme degre)
				$rewardTab[$rewardTypes[$reward['id_reward_type'] - 1]['name']][$qualities[$reward['id_quality'] - 1]['name']] .= '<p>' . $reward['name'] . '</p>';
			} 
				
			foreach($rewardTab as $tab){
				$lnMaxItems = 0;
				foreach($tab as $itemQuality){
					if($itemQuality[strlen($itemQuality) - 2] == 'p' || $itemQuality[strlen($itemQuality) - 2] == '2'){ //si l'avant dernier caractere est un 'p' ou un '2' ça veut dire qu'on a ajouté une reward dans ce string donc on l'affiche
						$itemQuality .= '</div>';
						echo $itemQuality;
					}
				}
			}
			?>
		</section>
    </body>
</html>












































