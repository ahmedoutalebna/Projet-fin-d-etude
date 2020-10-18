<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Projet Fin d'etude </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Holtwood+One+SC" />
    </head>
    <body>
        <div class="container site">
            <?php require_once "entete.php" ;  ?>
            <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Site d'agence immobiliére <span class="glyphicon glyphicon-home"></span></h1>
            <?php
                require 'admin/connexion.php';
                echo '<nav>';
                echo '  <ul class="nav nav-pills">';
                $db = Database::connect();
                $statement = $db->query('SELECT * FROM humain');
                $humain      = $statement->fetchAll();
                foreach ($humain as $element)
                {
                    if ($element['id'] == '1')
                    {
                        echo '<li role="presentation" class="active"><a href="#' . $element['id'] . '" data-toggle="tab"> ' . $element['name'] . ' </a></li>';
                    }
                    else
                    {
                        echo '<li role="presentation"><a href="#' . $element['id'] . '" data-toggle="tab"> ' . $element['name'] . ' </a></li>';
                    }
                }
                echo '</ul>';
                echo '</nav>';
                echo '<div class="tab-content">';
                foreach ($humain as $element)
                {
                    if ($element['id'] == '1')
                    {
                        echo '<div class="tab-pane active" id="'. $element['id'] .'">';
                    }
                    else
                    {
                        echo '<div class="tab-pane" id="'. $element['id'] .'">';
                    }
                    echo '<div class="row">';
                    $statement = $db->query('SELECT * FROM individu');
                    $statement->execute();
                    while ($iv = $statement->fetch())
                    {
                        echo '<div class="col-sm-6 col-md-4">';
                            echo '<div class="thumbnail">';
                                echo '<div class="id"> id : <br> --> ' . $iv['id'] . ' </div>';
                                echo '<div class="first-name"> Nom : <br> --> ' . $iv['nom'] . ' </div>';
                                echo '<div class="last-name"> Prénom : <br> --> ' . $iv['prenom'] . ' </div>';
                                echo '<div class="number"> Numéro de phone : <br> --> ' . $iv['numero_de_telephone'] . ' </div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
            ?>
        </div>
    </body>
</html>