<!doctype html>
<html lang="fr">
    <?php
        session_start();
        include_once("functions.php");
    ?>
    <head>
        <meta charset="utf-8">
        <title>Overwatch Collection</title>
        <link rel="stylesheet" href="style-events.css">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
            
            <div id="events">
                <?php
                    $cpt = 0;
                    foreach(sqlSelectEvents() as $event){
                        

                        $tmp = "";
                        if($cpt % 2 == 0){
                            $tmp = '<div class="event_1"';
                        } else {
                            $tmp = '<div class="event_2"';
                        }
                        $tmp .= ' style=\'background-image: url("img/events/' . str_replace(' ', '', $event['name']) . '.jpg");\'>';

                        echo $tmp;
                        echo '<a href="event.php?id=' . $event['id_event'] . '">';
                        echo '<h1>' . $event['name'] . '</h1>';
                        echo '</a>';
                        echo '</div>';
                        
                        $cpt++;
                    }
                ?>  
            </div>
            
    </body>
</html>