<!doctype html>
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
            <div class="row">
                <h1>
                    <strong> Liste des Maisons </strong> <a href="insertHouse.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter </a>
                    <a href="freeHouse.php" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span> Les Maisons Libres
                    </a>
                    <a href="maisonOccupe.php" class="btn btn-warning btn-lg">
                        <span class="glyphicon glyphicon-home"></span> Les Maisons Occupeés
                    </a>
                </h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Code </th>
                            <th> Region </th>
                            <th> Nombre de chambre </th>
                            <th> Prix de location </th>
                            <th> Type </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    require 'connexion.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT * FROM maison');
                    while ($ms = $statement->fetch())
                    {
                        echo '<tr>';
                            echo '<td>' . $ms['code'] . '</td>';
                            echo '<td>' . $ms['region'] . '</td>';
                            echo '<td>' . $ms['nombre_de_chambre'] . '</td>';
                            echo '<td>' . $ms['prix_de_location'] . '</td>';
                            echo '<td>' . $ms['type'] . '</td>';
                            echo '<td width=300>';
                                echo '<a href="viewHouse.php?code= ' . $ms['code'] . '" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                echo '<a href="updateHouse.php?code= ' . $ms['code'] . '" class="btn btn-primary"> <span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
                                echo '<a href="deleteHouse.php?code= '. $ms['code'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
