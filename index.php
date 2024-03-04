<?php
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
include_once "fonction.php"
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
    <title>FILM.COM</title>
</head>
<body class="">

<?php include_once 'menu.php'?>

<main>
    <div class="container text-center">
        <div class="row align-items-center vh-100">
            <?php foreach ($films as $film) : ?>
                <div class="container card col-xs-12 col-md-6 col-lg-4 col-xl-3 mt-4 mb-4 " style="width: 18rem">
                    <div class="card-body text-center">
                        <h3 class="fs-4 fw-bold"><?= $film["titre_film"] ?></h3>
                        <img src="<?= $film["image_film"] ?>" alt="<?= $film["titre_film"] ?>" class="img-fluid"><br>
                        <h6 class="card-title mt-2 fst-italic"><?= convertirEnHeuresMinutes($film["duree_film"]) ?></h6>
                        <a href="detail_film.php?id_film=<?=$film["id_film"]?>" class="btn bg-warning">En
                            savoir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

</body>
</html>