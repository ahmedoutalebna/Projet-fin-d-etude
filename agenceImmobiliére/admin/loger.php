<?php
    require 'connexion.php';
    $dateDebutError = $dateFinError = $idError = $codeError = $dateDebut = $dateFin = $id = $code = "";
    if (!empty($_POST))
    {
        $dateDebut    =    checkInput($_POST['date_debut']);
        $dateFin      =    checkInput($_POST['date_fin']);
        $id           =    checkInput($_POST['id']);
        $code         =    checkInput($_POST['code']);
        $isSuccess     =     true;
        if (empty($dateDebut))
        {
            $dateDebutError = ' Ce champ ne peut pas etre vide ';
            $isSuccess      =  false;
        }
        if (empty($dateFin))
        {
            $dateFinError = ' Ce Champ ne peut pas etre vide ';
            $isSuccess     =  false;
        }
        if (empty($id))
        {
            $idError = ' Ce Champ ne peut pas etre vide ';
            $isSuccess        = false;
        }
        if (empty($code))
        {
            $codeError = ' Ce Champ ne peut pas etre vide ';
            $isSuccess = false;
        }
        else
        {
            $isSuccess  = true;
        }
        if ($isSuccess)
        {
            $db = Database::connect();
            $req1 = "INSERT INTO location (date_debut,date_fin,id,code) VALUES (?,?,?,?)";
            $statement = $db->prepare($req1);
            $statement->execute(array($dateDebut,$dateFin,$id,$code));
            if ($req1 == true)
            {
                $req2 = " UPDATE maison SET type = 'occupé' WHERE code = ?";
                $statement = $db->prepare($req2);
                $statement->execute(array($code));
            }
            header("location: location.php");
        }
    }
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
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
            <h1><strong> Loger une maison </strong></h1>
            <br>
            <form method="post" action="loger.php" class="form" id="form" role="form">
                <div class="form-group">
                    <label for="date_debut"> Date de debut : </label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="<?php echo $dateDebut ; ?>" placeholder="le date debut de location" >
                    <span class="help-inline"><?php echo $dateDebutError;  ?></span>
                </div>
                <div class="form-group">
                    <label for="date_fin"> Date Fin : </label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="<?php echo $dateFin ; ?>" placeholder="le date de fin de location">
                    <span class="help-inline"><?php echo $dateFinError ; ?></span>
                </div>
                <div class="form-group">
                    <label for="id"> id: </label>
                    <select name="id" id="id" class="form-control">
                        <?php
                            $db = Database::connect();
                            foreach($db->query('SELECT id FROM individu') as $row)
                            {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . '</option>';
                            }
                            Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $idError;  ?></span>
                </div>
                <div class="form-group">
                    <label for="code"> Code: </label>
                    <select name="code" id="code" class="form-control">
                        <?php
                            $db = Database::connect();
                            foreach($db->query(" SELECT code FROM maison WHERE type = 'libre' ") as $row)
                            {
                                echo '<option value="' . $row['code'] . '">' . $row['code'] . '</option>';
                            }
                            Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $codeError;  ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Loger </button>
                    <a href="location.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
                </div>
            </form>
        </div>
    </body>
</html>