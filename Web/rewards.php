<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");
    ?>
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style-rewards.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
        <section id="playerIcon">
            <h2>Player Icons</h2>
            <div>
                <?php
                    foreach(sqlSelectPlayerIcons() as $playerIcon){
                        echo '<p class="rewardp">' . $playerIcon['name'] . '<var hidden>' . $playerIcon['id_reward'] . '</var></p>';
                    }
                ?>
            </div>
        </section>
        <section>
            <h2>Sprays</h2>
            <div>
                <?php
                    foreach(sqlSelectSprays() as $sprays){
                        echo '<p class="rewardp">' . $sprays['name'] . '<var hidden>' . $sprays['id_reward'] . '</var></p>';
                    }
                ?>
            </div>
        </section>
		<script>
			$("p.rewardp").click(function() {
				id_reward = $(this).find("var").html();
				$.ajax({
					method: 'POST',
					url: 'functions.ajax.php',
					data: {'id_user': 2, 'id_reward': parseInt(id_reward), 'function_name': 'insert_users_rewards'},
					dataType: 'json',
					success: function(data) {
					}
				});
				$( this ).css('color', '#00FF4C');
			});
		</script>
    </body>
</html>