<?php
    require 'connexion.php';
    $phoneNumberError = $lastNameError = $firstNameError = $phoneNumber = $lastName = $firstName = "";
    if (!empty($_GET['id']))
    {
        $id     =     checkInput($_GET['id']);
    }
    if (!empty($_POST))
    {
        $firstName     =    checkInput($_POST['nom']);
        $lastName      =    checkInput($_POST['prenom']);
        $phoneNumber   =    checkInput($_POST['numero_de_telephone']);
        $isSuccess     =    true;
        if (empty($firstName))
        {
            $firstNameError    = 'ce champ ne peut pas etre vide';
            $isSuccess         =  false;
        }
        if (empty($lastName))
        {
            $lastNameError     = 'ce champ ne peut pas etre vide';
            $isSuccess         =  false;
        }
        if (empty($phoneNumber))
        {
            $phoneNumberError  = 'ce champ ne peut pas etre vide';
            $isSuccess         =  false;
        }
        else
        {
            $isSuccess         =  true;
        }
        if ($isSuccess)
        {
           $db = Database::connect();
           $statement = $db->prepare("UPDATE individu set nom = ?, prenom = ?, numero_de_telephone = ? WHERE id = ?");
           $statement->execute(array($firstName,$lastName,$phoneNumber,$id));
           Database::disconnect();
           header("location: individu.php");
        }
    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM individu WHERE id = ?");
        $statement->execute(array($id));
        $iv = $statement->fetch();
        $firstName    =   $iv['nom'];
        $lastName     =   $iv['prenom'];
        $phoneNumber  =   $iv['numero_de_telephone'];
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
            <h1><strong> Modifier un individu </strong></h1>
            <div class="row">
                <form method="post" action="<?php echo 'updateIndividu.php?id=' . $id ; ?>"  id="form" class="form"  role="form">
                    <div class="form-group">
                        <label for="id"> id: </label>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id ; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nom"> Nom: </label>
                        <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $firstName ; ?>">
                        <span class="help-inline"><?php echo $firstNameError ; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="prenom"> Prénom: </label>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $lastName ; ?>">
                        <span class="help-inline"><?php echo $lastNameError ; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="numero_de_telephone"> Numéro de telephone: </label>
                        <input type="text" name="numero_de_telephone" id="numero_de_telephone" class="form-control" value="<?php echo $phoneNumber ; ?>">
                        <span class="help-inline"><?php echo $phoneNumberError ; ?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier </button>
                        <a href="individu.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>