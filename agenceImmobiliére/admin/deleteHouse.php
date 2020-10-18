<?php
    require 'connexion.php';
    if (!empty($_GET['code']))
    {
        $code  =  checkInput($_GET['code']);
    }
    if (!empty($_POST))
    {
        $code     =     checkInput($_POST['code']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM maison WHERE code = ?");
        $statement->execute(array($code));
        Database::disconnect();
        header("location: index.php");
    }
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
        <h1><strong> Supprimer une maison </strong></h1>
        <br>
        <div class="row">
            <form method="post" class="form" action="deleteHouse.php" role="form">
                <input type="hidden" name="code" value="<?php echo $code; ?>">
                <p class="alert alert-warning"> Etes vous sur de vouloir supprimer ? </p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning"> Oui </button>
                    <a href="index.php" class="btn btn-default"> Non </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
