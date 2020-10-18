<?php
    require 'connexion.php';
    if (!empty($_GET['id']))
    {
        $id  =  checkInput($_GET['id']);
    }
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM individu WHERE id = ?");
    $statement->execute(array($id));;
    $iv = $statement->fetch();
    Database::disconnect();
    function checkInput($data)
    {
        $data  =  trim($data);
        $data  =  stripslashes($data);
        $data  =  htmlspecialchars($data);
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
            <div class="row">
                <h1><strong> Voir un individu </strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label for="id"> id: </label><?php echo ' ' . $iv['id']; ?>
                    </div>
                    <div class="form-group">
                        <label for="nom"> Nom: </label><?php echo ' ' . $iv['nom']; ?>
                    </div>
                    <div class="form-group">
                        <label for="prenom"> Prénom: </label><?php echo ' ' . $iv['prenom']; ?>
                    </div>
                    <div class="form-group">
                        <label for="numero_de_telephone"> Numéro de téléphone: </label><?php echo ' ' . $iv['numero_de_telephone']; ?>
                    </div>
                    <div class="form-actions">
                        <a href="individu.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
