<?php
session_start();
$pseudo = null;

if (isset($_SESSION['pseudo_utilisateur'])) {
    $pseudo = $_SESSION['pseudo_utilisateur'];
}

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';

$films = getFilms();

require_once BASE_PROJET . '/src/fonction/fonction_duree.php';
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
    <link rel="stylesheet" href="index.css">
    <title>FILM.COM</title>
</head>

<body class="bg-dark">

<!--Menu-->
<?php require_once BASE_PROJET . '/src/_partials/header.php'; ?>

<main>
    <?php if ($pseudo) : ?>
        <p>Prénom : <?= $pseudo ?></p>
    <?php endif; ?>
    <div class="container">
        <h1 class="border-bottom border-warning border-4 text-white mt-3">Films</h1>
        <div class="row align-items-center">

            <?php foreach ($films as $film) : ?>

                <div class="container card col-xs-12 col-md-6 col-lg-4 col-xl-3 mt-4 mb-4 rounded-5"
                     style="width: 18rem">
                    <div class="card-body text-center">
                        <h3 class="fs-4 fw-bold"><?= $film["titre_film"] ?></h3>
                        <a href="detail_film.php?id_film=<?= $film["id_film"] ?>"><img
                                    style="width: 175px; height: 250px" src="<?= $film["image_film"] ?>"
                                    alt="<?= $film["titre_film"] ?>" class="img-fluid"></a>
                        <br>
                        <h6 class="card-title mt-2 fst-italic"><?= convertirEnHeuresMinutes($film["duree_film"]) ?></h6>
                        <a href="detail_film.php?id_film=<?= $film["id_film"] ?>" class="btn bg-warning ">En
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