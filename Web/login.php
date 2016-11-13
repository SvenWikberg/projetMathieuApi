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
			<li class="navName"><a href="login.php"><h2>Login</h2></a></li>
        </ul>
    </header>
    <body>
        <section>
            <form>
                <p>Username</p>
                <input type="text" id="user_name"><br>
                <p>Password</p>
                <input type="password" id="user_pwd"><br>
                <br><input type="button" id="send" value="Connect">
            </form>
        </section>
        <script>
            $("input#send").click(function() {
                user_name = $("#user_name").val();
                user_pwd = $("#user_pwd").val();
                $.ajax({
                    method: 'POST',
                    url: 'functions.ajax.php',
                    data: {'user_name': user_name, 'user_pwd': user_pwd, 'function_name': 'check_login'},
                    dataType: 'json',
                    success : function(data) {
                        if (data.ReturnCode == "OK"){
                            $("#message").text(data.Message);
                            window.location.href = "index.php";
                        }
                        else if (data.ReturnCode == "ERROR"){
                            $("#message").text('Username or password incorrect');
                        }
                    }
                });
            });
        </script>
        <p id="message"></p>
        <?php
        //print_rr(sqlSelectUserByUsername('sven')['username']);
        ?>
    </body>
</html>