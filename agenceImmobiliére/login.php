<?php
  require 'admin/connexion.php';
  $loginError = $passwordError = $login = $password = "";
  if (!empty($_POST))
  {
    $login     =  $_POST['login'];
    $password  =  $_POST['password'];
    $isSuccess =  true;
    if (empty($login))
    {
        $loginError = " Ce Champ ne peut pas etre vide ";
        $isSuccess  = false;
    }
    if (empty($password))
    {
        $passwordError = " Ce Champ ne peut pas etre vide ";
        $isSuccess  = false;
    }
    else
    {
        $isSuccess = true;
    }
    if ($isSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
        $statement->execute(array($login,$password));
        if ($users = $statement->fetch())
        {
            session_start();
            $_SESSION['PROFILE'] = $users;
        }
        Database::disconnect();
        header("location: admin/index.php");
    }
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
          <?php require_once "entete.php"; ?>
          <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Site d'agence immobiliére <span class="glyphicon glyphicon-home"></span></h1>
          <div class="container site col-md-6 col-md-offset-3">
              <h1><strong> Login </strong></h1>
              <br>
              <div class="row">
                <form class="form" action="login.php" method="post" id="form" >
                    <div class="form-group">
                      <label for="login"> Login: </label>
                      <input type="text" name="login" class="form-control" placeholder="Tapez votre nom" value="<?php echo $login ; ?>">
                      <span class="help-inline"><?php echo $loginError ?></span>
                    </div>
                    <div class="form-group">
                      <label for="password"> Password: </label>
                      <input type="password" name="password" class="form-control" placeholder="Tapez votre mot de passe" value="<?php echo $password ; ?>">
                      <span class="help-inline"><?php echo $passwordError ?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success btn-lg"> <span class="glyphicon glyphicon-user"></span> Login </button>
                    </div>
                </form>
              </div>
          </div>
    </body>
</html>
