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
        <link rel="stylesheet" href="style-rewards.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
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
        <section id="playerIcon">
            <h2>Player Icons</h2>
            <div>
                <?php
                    foreach(sqlSelectPlayerIcons() as $playerIcon){
                    $check = '';
                        if(isset($rewards_owned))
                            foreach($rewards_owned as $id_reward){
                                if($id_reward['id_reward'] == $playerIcon['id_reward']){
                                    $check = ' style="color: #00FF4C"';
                                }
                            }
                        echo '<p ' . $check . ' class="rewardp">' . $playerIcon['name'] . '<var hidden>' . $playerIcon['id_reward'] . '</var></p>';
                    }
                ?>
            </div>
        </section>
        <section>
            <h2>Sprays</h2>
            <div>
                <?php
                    foreach(sqlSelectSprays() as $sprays){
                        $check = '';
                        if(isset($rewards_owned))
                            foreach($rewards_owned as $id_reward){
                                if($id_reward['id_reward'] == $sprays['id_reward']){
                                    $check = ' style="color: #00FF4C"';
                                }
                            }
                        echo '<p ' . $check . ' class="rewardp">' . $sprays['name'] . '<var hidden>' . $sprays['id_reward'] . '</var></p>';
                    }
                ?>
            </div>
        </section>
		<script>
			$("p.rewardp").click(function() {
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
        <?php
        
        ?>
        <p id="error"></p>
    </body>
</html>