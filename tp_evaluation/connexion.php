<?php
// session_start() nous permet d'utiliser $_SESSION sur cette page
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <?php
    // Ces deux include nous permettent d'utiliser les fonctionnalités de "pdo.php" et "requete.php" 
    include "pdo.php";
    include "requete.php";

    // Si déjà connecté, on redirige vers index.php
    if (!empty($_SESSION['user'])) {
        header('location: index.php');
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- 
                    Ici notre formulaire nous renverra sur cette même page car l'action est vide, et il utilisera la méthode POST  
                    On n'oublie pas de mettre un name aux inputs
                -->
                <form action="" method="POST" class="mb-5">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-outline-dark" name="btn_connexion">Se connecter</button>
                </form>
            </div>
        </div>
        <a href="inscription.php">Pas encore inscrit ?</a>
    </div>
    <div class="container">
        <?php 
            // Ici on affichera un message de succés ou d'erreur pour l'inscription
            if (isset($_GET['existe'])) {
                if($_GET['existe'] === "0") {
                    echo "<p>Inscription effectuée</p>";
                } else {
                    echo "<p>Echec inscription</p>";
                }
            }
        ?>
    </div>


    <?php
    // On vérifie si le $_POST['btn_connexion'] est bien initialisé, btn_connexion est le name donné au bouton de mon formulaire
    if (isset($_POST['btn_connexion'])) {

        // J'appelle ma fonction qui récupère les infos de l'utilisateur entré dans le formulaire, et je stock le résultat dans une variable
        $users = requete_findUser($_POST['pseudo']);

        // Ici je vérifie si un utilisateur a été trouvé puis stocké dans la variable $user
        if (!$users) {

            // Si aucun utilisateur n'est trouvé, j'affiche un message d'erreur
            echo "<p>Pseudo inexistant !</p>";

            // Sinon, je vérifie si les infos entrées dans le formulaire correspondent bien avec celles enregistrées en BdD
            // J'utilise la fonction password_verify() pour vérifier le mdp entré dans le formulaire avec le celui "hashé" en BdD
        } else if ($_POST['pseudo'] === $users->pseudo && password_verify($_POST['password'],$users->password)) {

            // Si elles correspondent, je créé la session
            $_SESSION['user'] = $_POST['pseudo'];
            $_SESSION['id_role'] = $users-> role;
            $_SESSION['id_users'] = $users->id_users;

            // Puis je redirige sur index.php
            header('location: index.php');

            // Si aucune des conditions précédentes ne sont respectées, j'affiche un autre message d'erreur
        } else {
            echo "<p>Mot de passe ou identifiant incorrect !</p>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>