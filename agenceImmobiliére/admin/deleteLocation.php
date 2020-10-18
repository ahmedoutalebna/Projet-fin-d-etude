<?php
    require 'connexion.php';
    if (!empty($_GET['id']))
    {
        $id               =  checkInput($_GET['id']);
    }
    if (!empty($_POST))
    {
        $id              =  checkInput($_POST['id']);
        $db                =  Database::connect();
        $req1  = "DELETE FROM location WHERE id = ?";
        $statement = $db->prepare($req1);
        $statement->execute(array($id));
        if ($req1 == true)
        {
            $statement = $db->prepare("UPDATE maison SET type = 'libre' FROM location,individu,maison ON maison.code = location.code AND individu.id = location.id WHERE id = ?");
            $statement->execute(array($code));
        }
        Database::disconnect();
        header("location: location.php");
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
    <h1><strong> Annuler une location </strong></h1>
    <br>
    <div class="row">
        <form method="post" name="form" action="deleteLocation.php" class="form" role="form">
            <input type="hidden" name="id" value="<?php echo $id ; ?>">
            <p class="alert alert-warning"> Etes vous sures de vouloir annuler la location ? </p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning"> Oui </button>
                <a href="location.php" class="btn btn-default"> Non </a>
            </div>
        </form>
    </div>
</div
</body>
</html>