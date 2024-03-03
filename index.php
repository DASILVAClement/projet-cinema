<?php
// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require "config/db-config.php";

// 2. Préparation la requête
$requete = $pdo->prepare("SELECT * FROM film");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// 1 enregistrement = 1 tableau associatif
$films = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
function convertirEnHeuresMinutes($dureeEnMinutes)
{
    $heures = floor($dureeEnMinutes / 60);
    $minutes = $dureeEnMinutes % 60;
    return "$heures h $minutes min";
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body class="">
<header>
    <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid">
            <h2>FILM.com</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <div class="row">
            <?php foreach ($films as $film) : ?>
                <div class="card col-6 col-lg-4 mt-4 mb-4">
                    <div class="card-body text-center">
                        <h3><?= $film["titre_film"] ?></h3>
                        <img src="<?= $film["image_film"] ?>" alt="<?= $film["titre_film"] ?>" class="img-fluid"><br>
                        <h6 class="card-title mt-2"><?= convertirEnHeuresMinutes($film["duree_film"]) ?></h6>
                        <a href="detail_film.php" class="btn border border-warning text-warning">En
                            savoir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

</body>
</html>