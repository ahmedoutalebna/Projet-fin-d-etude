<?php
    require 'connexion.php';
    $db = Database::connect();
    $statement = $db->query("SELECT SUM(prix_de_location) AS 'les recettes' FROM maison WHERE type = 'occupé'");
    $statement->execute();
    $rc = $statement->fetch();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Projet Fin d'etude </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Holtwood+One+SC" />
    </head>
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Site d'agence immobiliére <span class="glyphicon glyphicon-home"></span></h1>
        <div class="container admin">
            <div class="row">
                    <h1><strong>Voiçi les reçettes mensuelles -------> <?php echo $rc['les recettes']; ?></strong></h1>
            </div>
            <br>
            <div>
                    <a href="maisonOccupe.php" class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
            </div>
        </div>

    </body>
</html>
