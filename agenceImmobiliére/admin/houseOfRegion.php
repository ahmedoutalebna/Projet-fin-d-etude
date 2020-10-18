<?php
  require 'connexion.php';
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
        <?php require_once "heading.php"; ?>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Site d'agence immobiliére <span class="glyphicon glyphicon-home"></span></h1>
        <div class="container admin">
            <h1><strong> Les Maisons Selon ces Communes </strong></h1>
            <br>
            <div class="row">
                <form method="post" action="searchHouseOfRegion.php" class="form" role="form">
                    <div class="form-group">
                        <label for="region"> Region: </label>
                        <select name="region" id="region" class="form-control">
                            <?php
                                $db = Database::connect();
                                foreach($db->query('SELECT region FROM maison') as $row)
                                {
                                    echo '<option value="' . $row['region'] . '">' . $row['region'] . '</option>';
                                }
                                Database::disconnect();
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Chercher  </button>
                        <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
