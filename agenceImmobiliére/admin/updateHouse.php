<?php
    require 'connexion.php';
    $codeError = $regionError = $priceError = $nombreDeChambreError = $code = $region = $price = $nbrDeChambre = "";
    if (!empty($_GET['code']))
    {
        $code  =  checkInput($_GET['code']);
    }
    if (!empty($_POST))
    {
        $region          =     checkInput($_POST['region']);
        $nbrDeChambre    =     checkInput($_POST['nombre_de_chambre']);
        $price           =     checkInput($_POST['prix_de_location']);
        $isSuccess       =     true;
        if (empty($region))
        {
            $regionError = ' ce champ ne peut pas etre vide ';
            $isSuccess   = false;
        }
        if (empty($nbrDeChambre))
        {
            $nbrDeChambre          = ' ce champ ne peut pas etre vide ';
            $isSuccess             = false;
        }
        if (empty($price))
        {
            $priceError  =  ' ce champ ne peut pas etre vide ';
            $isSuccess   = false;
        }
        else
        {
            $isSuccess   = true;
        }
        if ($isSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("UPDATE maison set region = ?, nombre_de_chambre = ?, prix_de_location = ? WHERE code = ?");
            $statement->execute(array($region,$nbrDeChambre,$price,$code));
            Database::disconnect();
            header("location: index.php");
        }
    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM maison WHERE code = ?");
        $statement->execute(array($code));
        $ms = $statement->fetch();
        $region         =  $ms['region'];
        $nbrDeChambre   =  $ms['nombre_de_chambre'];
        $price          =  $ms['prix_de_location'];
        Database::disconnect();
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
            <h1><strong> Modifier une maison </strong></h1>
            <div class="row">
                <form method="post" action="<?php echo 'updateHouse.php?code=' . $code ; ?>" class="form" id="form" role="form">
                    <div class="form-group">
                        <label for="code"> Code: </label>
                        <input type="hidden" id="code" name="code" class="form-control" value="<?php echo $code ; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="region"> Region: </label>
                        <input name="region" id="region" type="text" class="form-control" value="<?php echo $region; ?>" placeholder=" Tapez ici le Region">
                        <span class="help-inline"><?php echo $regionError;  ?></span>
                    </div>
                    <div class="form-group">
                        <label for="nombre_de_chambre"> Nombre de chambre: </label>
                        <input type="number" name="nombre_de_chambre" id="nombre_de_chambre" class="form-control" value="<?php echo $nbrDeChambre ; ?>" placeholder=" Tapez ici le Nombre de chambre">
                        <span class="help-inline"><?php echo $nombreDeChambreError ;  ?></span>
                    </div>
                    <div class="form-group">
                        <label for="prix_de_location"> Prix de location: </label>
                        <input type="number" step="100" name="prix_de_location" id="prix_de_location" class="form-control" value="<?php echo $price ; ?>" placeholder="Tapez ici le Prix de Location">
                        <span class="help-inline"><?php echo $priceError ;  ?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier  </button>
                        <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>