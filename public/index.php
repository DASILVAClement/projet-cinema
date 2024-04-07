<?php
session_start();

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';


$films = getFilms();
require_once BASE_PROJET . '/src/fonction/fonction_duree.php';


$utilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $utilisateur=$_SESSION["utilisateur"];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>FILM.COM</title>

</head>

<body class="bg-dark" >

<?php
require_once BASE_PROJET . '/src/_partials/header.php';
?>

<main>
        <div class="container ">

            <?php if ($utilisateur) : ?>
                <p class="text-white">Bienvenue <?= $utilisateur["pseudo_utilisateur"] ?> </p>
            <?php endif; ?>

            <h1 class="border-bottom border-warning border-4 text-white mt-3">Films</h1>

            <div class="row align-items-center">

                <?php foreach ($films as $film) : ?>

                    <div class="container card col-xs-12 col-md-6 col-lg-4 col-xl-3 mt-4 mb-4 rounded-5"
                         style="width: 18rem">
                        <div class="card-body text-center">
                            <h3 class="fs-4 fw-bold"><?= $film["titre_film"] ?></h3>
                            <a href="detail-film.php?id_film=<?= $film["id_film"] ?>"><img
                                        style="width: 175px; height: 250px" src="<?= $film["image_film"] ?>"
                                        alt="<?= $film["titre_film"] ?>" class="img-fluid"></a>
                            <br>
                            <h6 class="card-title mt-2 fst-italic"><?= convertirEnHeuresMinutes($film["duree_film"]) ?></h6>
                            <a href="detail-film.php?id_film=<?= $film["id_film"] ?>" class="btn bg-warning ">En
                                savoir plus</a>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
</main>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>