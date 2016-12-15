<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");
    ?>
    <head>
        <meta charset="utf-8">
        <title>Overwatch Collection</title>
        <link rel="stylesheet" href="style-account.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <link rel="shortcut icon"  type="image/x-icon" href="img/logo.ico" />
    </head>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
            <li class="navName"><a href="events.php"><h2>Events</h2></a></li>
			<li><a><h2 id="logout">Logout</h2></a></li>
        </ul>
    </header>
    <body>
        <section id="statistics">
            <h1>Your stats:</h1>
            <div id="rewards">
                <?php
                    $reward_count = sqlSelectRewardCount();
                    $reward_owned_count = sqlSelectRewardCountByIdUser($_SESSION['id_user']);

                    $ratio = $reward_owned_count / $reward_count * 100;
                ?>
                <h3>Rewards, <?php echo $reward_owned_count . '/' . $reward_count; ?></h3>
            
                <div style="width: 100%; height: 25px; border: 2px solid #01C2FD; border-radius: 5px;">
                    <?php
                        echo '<div style="width: ' . $ratio . '% ;height: 25px ;background-color: #01C2FD;"></div>'
                    ?>  
                </div>
            </div>

            <div id="events_rewards">
                <?php
                foreach(sqlSelectEvents() as $event){
                    echo '<div style="width: 45%;">';

                    $reward_count_e = sqlSelectRewardCountByIdEvent($event['id_event']);
                    $reward_owned_count_e = sqlSelectRewardCountByIdEventIdUser($event['id_event'], $_SESSION['id_user']);

					if($reward_count_e == 0){
						$ratio_e = 0;
					}else{
						$ratio_e = $reward_owned_count_e / $reward_count_e * 100;
					}

                    echo '<h3>' . $event['name'] . ', ' . $reward_owned_count_e . '/' . $reward_count_e . '</h3>';
                ?>            
                <div style="width: 100%; height: 25px; border: 2px solid #000000; border-radius: 5px;">
                <?php
                        echo '<div style="width: ' . $ratio_e . '% ;height: 25px ;background-color: #000000;"></div>'
                ?>  
                </div>

                <?php
                    echo '</div>';
                }
                ?>
            </div>

            <div id="heroes_rewards">
                <?php
                foreach(sqlSelectHeroes() as $hero){
                    echo '<div style="width: 45%;">';

                    $reward_count_e = sqlSelectRewardCountByIdHero($hero['id_hero']);
                    $reward_owned_count_e = sqlSelectRewardCountByIdHeroIdUser($hero['id_hero'], $_SESSION['id_user']);

					if($reward_count_e == 0){
						$ratio_e = 0;
					}else{
						$ratio_e = $reward_owned_count_e / $reward_count_e * 100;
					}

                    echo '<h3>' . $hero['name'] . ', ' . $reward_owned_count_e . '/' . $reward_count_e . '</h3>';
                ?>            
                <div style="width: 100%; height: 25px; border: 2px solid #000000; border-radius: 5px;">
                <?php
                        echo '<div style="width: ' . $ratio_e . '% ;height: 25px ;background-color: #000000;"></div>'
                ?>  
                </div>

                <?php
                    echo '</div>';
                }
                ?>
            </div>
        </section>
        <script>
			$("#logout").click(function() {
				$.ajax({
					method: 'POST',
					url: 'functions.ajax.php',
					data: {'function_name': 'logout'},
					dataType: 'json',
					complete : function(data) {
                        window.location.href = "index.php";
					}
				});
			});
		</script>
    </body>
</html>