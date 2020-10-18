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
            <h1><strong> Liste des individu </strong><a href="insertIndividu.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            <br>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th> id </th>
                        <th> Nom </th>
                        <th> Prénom </th>
                        <th> Numéro de téléphone </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require 'connexion.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT * FROM individu');
                    while ($iv = $statement->fetch())
                    {
                        echo '<tr>';
                            echo '<td>' . $iv['id'] . '</td>';
                            echo '<td>' . $iv['nom'] . '</td>';
                            echo '<td>' . $iv['prenom'] . '</td>';
                            echo '<td>' . $iv['numero_de_telephone'] . '</td>';
                            echo '<td width="300">';
                                echo '<a href="viewIndividu.php?id= ' . $iv['id'] . '" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                echo '<a href="updateIndividu.php?id= ' . $iv['id'] . '" class="btn btn-primary"> <span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
                                echo '<a href="deleteIndividu.php?id= '. $iv['id'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>