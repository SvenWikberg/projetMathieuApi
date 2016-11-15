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
            <div id="connection">
                <form>
                    <h1>Login</h1>
                    <p>Username</p>
                    <input type="text" id="user_name_l"><br>
                    <p>Password</p>
                    <input type="password" id="user_pwd_l"><br>
                    <br><input type="button" id="login" value="Connect">
                    <br><br><p id="message_l"></p>
                </form>
                <form>
                    <h1>Register</h1>
                    <p>Username*</p>
                    <input type="text" id="user_name_r"><br>
                    <p>Password*</p>
                    <input type="password" id="user_pwd_r"><br>
                    <p>Email*</p>
                    <input type="email" id="user_email_r"><br>
                    <br><input type="button" id="register" value="Register">
                    <br><br><p id="message_r"></p>
                </form>
            </div>
        </section>
        <script>
            $("input#login").click(function() {
                user_name = $("#user_name_l").val();
                user_pwd = $("#user_pwd_l").val();
                $.ajax({
                    method: 'POST',
                    url: 'functions.ajax.php',
                    data: {'user_name': user_name, 'user_pwd': user_pwd, 'function_name': 'check_login'},
                    dataType: 'json',
                    success : function(data) {
                        if (data.ReturnCode == "OK"){
                            $("#message_l").text(data.Message);
                            window.location.href = "account.php";
                        }
                        else if (data.ReturnCode == "ERROR"){
                            $("#message_l").text(data.Message);
                        }
                    }
                });
            });

            $("input#register").click(function() {
                user_name = $("#user_name_r").val();
                user_pwd = $("#user_pwd_r").val();
                email = $("#user_email_r").val();

                $.ajax({
                    method: 'POST',
                    url: 'functions.ajax.php',
                    data: {'user_name': user_name, 'user_pwd': user_pwd, 'email': email, 'function_name': 'register'},
                    dataType: 'json',
                    success : function(data) {
                        if (data.ReturnCode == "OK"){
                            window.location.href = "account.php";
                        }
                        else if (data.ReturnCode == "ERROR"){
                            $("#message_r").text(data.Message);
                        }
                    }
                });
            });
        </script>
        <p id="message"></p>
        <?php

        ?>
    </body>
</html>