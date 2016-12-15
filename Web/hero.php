<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");

		if(isset($_SESSION['id_user']))
			$rewards_owned = sqlSelectIdRewardByIdUser($_SESSION['id_user']);
    ?>
    <head>
        <meta charset="utf-8">
        <title>Overwatch Collection</title>
        <link rel="stylesheet" href="style-hero.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="img/logo.ico" />
    </head>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
            <li class="navName"><a href="events.php"><h2>Events</h2></a></li>
            <?php
            if(isset($_SESSION['id_user'])){
			echo '<li class="navName"><a href="account.php"><h2>Account</h2></a></li>';
            }else{
			echo '<li class="navName"><a href="login.php"><h2>Login</h2></a></li>';
            }
            ?>
        </ul>
    </header>
    <body>
		<script>
			$(document).ready(function(){
				$('#hero_infos_h2').click(function(){
					$('#hero_infos').show();
					$('#rewards').hide();
				});
			});

			$(document).ready(function(){
				$('#rewards_h2').click(function(){
					$('#rewards').show();
					$('#hero_infos').hide();
				});
			});
        </script>
		<div id="infosRewardsNav">
			<h2 id="hero_infos_h2">Infos</h2>
			<h2>/</h2>
			<h2 id="rewards_h2">Rewards</h2>
		</div>
		<section id="hero_infos">
			<section id="lore">

				<?php $hero = sqlSelectHeroById($_GET['id']); ?>

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
		</section>
		<section id="rewards" hidden>
			<?php
			echo '<h1>' . sqlSelectHeroById($_GET['id'])['name'] . '\'s Rewards</h1>';

			$legTab = [
                'Skin' => '<h2 style="color: #FF9C1E;">Skin</h2><div>',
                'Highlight Intro' => '<h2 style="color: #FF9C1E;">Highlight Intros</h2><div>',
                'Emote' => '<h2 style="color: #FF9C1E;">Emotes</h2><div>',
                'Victory Pose' => '<h2 style="color: #FF9C1E;">Victory Poses</h2><div>',
                'Spray' => '<h2 style="color: #FF9C1E;">Sprays</h2><div>',
                'Voice Line' => '<h2 style="color: #FF9C1E;">Voice Lines</h2><div>',
                'Player Icon' => '<h2 style="color: #FF9C1E;">Player Icon</h2><div>'
            ];
            $epicTab = [
                'Skin' => '<h2 style="color: #FE01FE;">Skin</h2><div>',
                'Highlight Intro' => '<h2 style="color: #FE01FE;">Highlight Intros</h2><div>',
                'Emote' => '<h2 style="color: #FE01FE;">Emotes</h2><div>',
                'Victory Pose' => '<h2 style="color: #FE01FE;">Victory Poses</h2><div>',
                'Spray' => '<h2 style="color: #FE01FE;">Sprays</h2><div>',
                'Voice Line' => '<h2 style="color: #FE01FE;">Voice Lines</h2><div>',
                'Player Icon' => '<h2 style="color: #FE01FE;">Player Icon</h2><div>'
            ];
            $rareTab = [
                'Skin' => '<h2 style="color: #01C2FD;">Skin</h2><div>',
                'Highlight Intro' => '<h2 style="color: #01C2FD;">Highlight Intros</h2><div>',
                'Emote' => '<h2 style="color: #01C2FD;">Emotes</h2><div>',
                'Victory Pose' => '<h2 style="color: #01C2FD;">Victory Poses</h2><div>',
                'Spray' => '<h2 style="color: #01C2FD;">Sprays</h2><div>',
                'Voice Line' => '<h2 style="color: #01C2FD;">Voice Lines</h2><div>',
                'Player Icon' => '<h2 style="color: #01C2FD;">Player Icon</h2><div>'
            ];
            $commonTab = [
                'Skin' => '<h2 style="color: #AAAAAA;">Skin</h2><div>',
                'Highlight Intro' => '<h2 style="color: #AAAAAA;">Highlight Intros</h2><div>',
                'Emote' => '<h2 style="color: #AAAAAA;">Emotes</h2><div>',
                'Victory Pose' => '<h2 style="color: #AAAAAA;">Victory Poses</h2><div>',
                'Spray' => '<h2 style="color: #AAAAAA;">Sprays</h2><div>',
                'Voice Line' => '<h2 style="color: #AAAAAA;">Voice Lines</h2><div>',
                'Player Icon' => '<h2 style="color: #AAAAAA;">Player Icon</h2><div>'
            ];

            $rewardTab = [
                'Legendary' => [$legTab, '#FF9C1E'],
                'Epic' => [$epicTab, '#FE01FE'],
                'Rare' => [$rareTab, '#01C2FD'],
                'Common' => [$commonTab, '#AAAAAA']
            ];


            $rewards = sqlSelectRewardsByIdHero($_GET['id']);
            $rewardTypes = sqlSelectRewardTypes();
            $qualities = sqlSelectQualities();

            //print_rr($heroes);

            foreach($rewards as $reward){// ajoute les rewards du hero dans les bons type et qualité de reward
			    $check = '';
				if(isset($rewards_owned))
					foreach($rewards_owned as $id_reward){
						if($id_reward['id_reward'] == $reward['id_reward']){
							$check = ' style="color: #00FF4C"';
						}
					}     
				//nom du type de rewards (id du tableau associatif)  //nom de la qualité de la rewards (id du tableau associatif -> 2eme degre)
				$rewardTab[$qualities[$reward['id_quality'] - 1]['name']][0][$rewardTypes[$reward['id_reward_type'] - 1]['name']] .= '<p ' . $check . ' class="rewardp">' . $reward['name'] . '<var hidden>' . $reward['id_reward'] . '</var></p>';
                
            }

            foreach($rewardTab as $tab){
				$lnMaxItems = 0;

                echo '<div style="border: 5px solid ' . $tab[1] . ';">';
				foreach($tab[0] as $rewardType){
					if($rewardType[strlen($rewardType) - 2] == 'p'){ //si l'avant dernier caractere est un 'p' ou un '2' ça veut dire qu'on a ajouté une reward dans ce string donc on l'affiche
						$rewardType .= '</div>';
                        echo $rewardType;
					}
				}
                echo '</div>';
			}
			?>			
		</section>
		<script>
			$("section#rewards p.rewardp").click(function() {
				id_reward = $(this).find("var").html();
                id_user = '<?php echo $_SESSION['id_user']; ?>';
				this_p = this;

				$.ajax({
					method: 'POST',
					url: 'functions.ajax.php',
					data: {'id_user': id_user, 'id_reward': parseInt(id_reward), 'function_name': 'insert_delete_users_rewards'},
					dataType: 'json',
					success : function(data) {
						
                        if(data.ReturnCode == "ADDED"){
                            $(this_p).css('color', '#00FF4C');
                        } else if (data.ReturnCode == "DELETED") {
                            $(this_p).css('color', '#4A4C4E');
                        }
					},
					error : function(data) {
						$('#error').text(data);
					}
				});
			});
		</script>
		<p id="error"></p>
		<?php
		
		?>
    </body>
</html>












































