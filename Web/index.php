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
        <h1>Overwatch Collection</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porta risus ut leo imperdiet, ac sodales tortor pharetra. Sed pulvinar rutrum ex eu luctus. Nullam vulputate mauris sit amet enim laoreet faucibus. Aliquam ac purus urna. Suspendisse eget ultricies ante. Morbi vel dictum dui. Morbi dignissim diam ac bibendum fringilla. Morbi tristique, est ut tempus luctus, libero tellus malesuada augue, ut tristique lorem nulla congue lectus. Aenean diam tellus, volutpat varius metus a, ultrices consectetur magna. Curabitur pharetra, lectus sed ultrices accumsan, nulla magna dapibus orci, vitae elementum tortor leo vitae nisi.</p>
        <p>Proin non ultrices metus, ac mollis lorem. Ut vitae facilisis leo, eget semper odio. Sed efficitur, metus nec feugiat eleifend, nunc tortor ultricies ante, accumsan pharetra ante nisi ac ante. Aenean vitae ullamcorper purus, eu eleifend mauris. Pellentesque sagittis fringilla aliquam. Sed in augue dui. Nam rhoncus tempor tortor, vitae volutpat orci semper at. Donec non commodo ligula, ut eleifend felis.</p>
    </body>
</html>