<?php
    require 'connexion.php';
    if (!empty($_GET['id']))
    {
        $id  =  checkInput($_GET['id']);
    }
    if (!empty($_POST))
    {
        $id  =  checkInput($_POST['id']);
        $db  =  Database::connect();
        $statement = $db->prepare("DELETE FROM individu WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("location: individu.php");
    }
    function checkInput($data)
    {
        $data  =  trim($data);
        $data  =  stripslashes($data);
        $data  =  htmlspecialchars($data);
        return $data;
    }
?>
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Site d'agence immobiliére <span class="glyphicon glyphicon-home"></span></h1>
            <div class="container admin">
                <h1><strong> Supprimer un individu </strong></h1>
                <br>
                <div class="row">
                    <form method="post" name="form" action="deleteIndividu.php" class="form" role="form">
                        <input type="hidden" name="id" value="<?php echo $id ; ?>">
                        <p class="alert alert-warning"> Etes vous sures de vouloir supprimer ? </p>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning"> Oui </button>
                            <a href="individu.php" class="btn btn-default"> Non </a>
                        </div>
                    </form>
                </div>
            </div
    </body>
</html>