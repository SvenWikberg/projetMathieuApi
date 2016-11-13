<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");
    ?>
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style-index.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <header>
        <ul id="nav">
            <li><a href="index.php"><img src="img/logo.png" alt="Logo" id="logo"></a></li>
            <li class="navName"><a href="heroes.php"><h2>Heroes</h2></a></li>
            <li class="navName"><a href="rewards.php"><h2>Rewards</h2></a></li>
			<li><a><h2 id="logout">Logout</h2></a></li>
        </ul>
    </header>
    <body>
        <?php
        print_rr($_SESSION);
        ?>
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