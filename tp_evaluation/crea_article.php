<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> CREATION ARTICLE </title>
</head>

<body>

    <?php

    include "pdo.php";
    include "requete.php"; 


    //On stock tout les articless en BdD dans $articles
   
    // $titre;
    // $article;
    // $auteur;

    // $articles = [];

    // $insert_bdd = crea_article($auteur,$article,$titre);
    ?>

    <h1 class="text-center my-5"> CREER TON ARTICLE ET 
        e la destination dans action="", la method POST ou GET
             Et enctype="multipart/form-data" pour pouvoir upload un fichier dans l'input file et créer $_FILES à l'envoi -->
        <form action="page_article.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <label for="titre" class="input-group-text"> Titre de l'oeuvre :</label>
                <input type="text" name="titre" id="titre" class="form-control">
            </div>

            <div class="input-group mb-3">
                <label for="article" class="input-group-text"> article/post :</label>
                <input type="text" name="article" id="article" class="form-control">
                
            </div>

            <div class="input-group mb-3">
                <label for="auteur" class="input-group-text"> auteur:</label>
                <input type="text" name="auteur" id="auteur" class="form-control">
            </div>
<!-- 
            <div class="input-group mb-3">
                <input type="file" name="image" class="form-control" id="inputGroupFile04"  aria-label="Upload">
            </div> -->

            <div class="input-group mb-3">
                <button class="btn btn-dark">ENVOYER</button>
            </div>
        </form>

    </div> 

    <?php

    //On vérifie si $_GEt['errors'] est bien initialisé...
    if (isset($_GET['errors'])) {
    ?>
        <!-- Si c'est le cas, j'affiche une div -->
        <div class="container alert alert-danger text-center">
            <?php

            //Et dans cette div, j'affiche un message d'erreur en fonction du contenu de $_GET['errors']
            
            if ($_GET['errors'] === "taille")
                echo "La taille de l'image dépasse 100 Ko";

            else if ($_GET['errors'] === "format")
                echo "Votre image doit être un jpg, jpeg ou png";

            else if ($_GET['errors'] === "erreur")
                echo "Le fichier uploadé n'est pas une image";

            else if ($_GET['errors'] === "ajout")
                echo "Une erreur est survenue lors de l'envoie du formulaire";

            else if ($_GET['errors'] === "fichier")
                echo "Veuillez choisir une image";
            ?>
        </div>
    <?php

    //Même chose, je vérifie si $_GET['success'] est bien initialisé...
    } else if (isset($_GET['success'])) {
    ?>
        <!-- Si oui, j'affiche une div -->
        <div class="container alert alert-success text-center">
        <?php
        
        //Et en fonction du contenu de $_GET['success'], j'affiche un message
        if ($_GET['success'] === "ajout") {
            echo "Ajout effectuée";
        } else if ($_GET['success'] === "modif") {
            echo "Modification effectuée";
        } else if ($_GET['success'] === "suppr") {
            echo "Suppression effectuée";
        }
    }
        ?>
        </div>

        <div class="container">

            <?php

            //Ce foreach parcours le tableau $articles
            //Et pour chaque ligne de ce tableau, il stock la valeur dans $value ($value existera seulement dans ce foreach)
            //Et effectue toutes les instructions entre les accolades pour chaque ligne du tableau
            
            $articles = [];
    
            foreach ($articles as $value) {
              

                    $articles->id_article;
                    $articles->image;
                    $articles -> titre;
                    $articles -> article;
                    $articles -> auteur;
                    $articles -> date;

            ?>
                <!-- Toute cette partie html s'affiche alors pour chaque ligne du tableau $articles -->
                <div class="card mx-auto mb-3" style="width: 18rem;">
                    <img src="image/<?= htmlspecialchars($value->image) ?>" class="card-img-top" alt="..." style="object-fit: cover; height: 250px;">
                    <div class="card-body">

                        <h5 class="card-title"><?= htmlspecialchars($value->titre) ?></h5>

                        <p class="card-text"><?= htmlspecialchars($value->article) ?></p>

                        <p class="card-text"><?= htmlspecialchars($value->auteur) ?></p>

                        <p class="card-text"><?= htmlspecialchars($value->date) ?></p>



                        <a href="index.php?id=<?= $value->id_article ?>" class="btn btn-outline-dark">SUPPRIMER</a>

                        <a href="page_article.php.php?name=<?= $value->auteur ?>titre=<?= $value->titre ?>article=<?= $value->article ?>date=<?= $value->date ?>" class="btn btn-outline-dark">MODIFIER</a>

                    </div>
                </div>

            <?php
            }

            ?>

        </div>

        <!-- <div class="container mt-5 mb-5 d-flex justify-content-center">
            
            <a href="#" class="btn btn-dark">RETOUR HAUT</a>
        </div> -->

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</body>

</html>