<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <?php
        include_once("functions.php");
    ?>
    <body>
        <pre>
            <?php
                print_r(search());
            ?>
        </pre>
    </body>
</html>