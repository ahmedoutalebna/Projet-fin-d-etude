<?php
    require 'connexion.php';
    if (!empty($_POST))
    {
        $region = checkInput($_POST['region']);
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM maison WHERE region =?");
        $statement->execute(array($region));
        Database::disconnect();
    }
    function checkInput($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
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
            <h1><strong> Les Maisons par region </strong></h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th> Code </th>
                        <th> Region </th>
                        <th> Nombre de chambre </th>
                        <th> Prix de location </th>
                        <th> Type </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($ms= $statement->fetch()) { ?>
                        <tr>
                            <td><?php echo $ms['code'];  ?></td>
                            <td><?php echo $ms['region'];  ?></td>
                            <td><?php echo $ms['nombre_de_chambre'];  ?></td>
                            <td><?php echo $ms['prix_de_location'];  ?></td>
                            <td><?php echo $ms['type'];  ?></td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
            <br>
            <div class="form-actions">
              <a href="houseOfRegion.php" class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
            </div>
        </div>

    </body>
</html>
