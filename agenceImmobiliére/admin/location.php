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
        <h1><strong> Location </strong><a href="loger.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Loger </a></h1>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Date de debut </th>
                <th> Date fin  </th>
                <th> id </th>
                <th> Code</th>
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'connexion.php';
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM  location');
            while ($lc = $statement->fetch())
            {
                echo '<tr>';
                    echo '<td>' . $lc['date_debut'] . '</td>';
                    echo '<td>' . $lc['date_fin'] . '</td>';
                    echo '<td>' . $lc['id'] . '</td>';
                    echo '<td>' . $lc['code'] . '</td>';
                    echo '<td width="100">';
                         echo '<a href="deleteLocation.php?id= '. $lc['id'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> annuler la location </a>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>