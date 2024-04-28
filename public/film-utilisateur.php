<?php


session_start();

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';
require_once BASE_PROJET . '/src/database/utilisateur-db.php';
require_once BASE_PROJET . '/src/database/commentaire-db.php';
require_once BASE_PROJET . '/src/fonction/fonction_duree.php';
require_once BASE_PROJET . '/src/fonction/fonction-etoile-avis.php';

$films = getFilms();

$utilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $utilisateur=$_SESSION["utilisateur"];
}

if (empty($_SESSION)) {
    header("Location: index.php");
}
$nbFilms = 0;
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
    <title>FILM.COM</title>
</head>

<?php
require_once BASE_PROJET . '/src/_partials/header.php';
?>

<body class="bg-dark" >

<div class="container">
    <?php if ($utilisateur) : ?>
        <p class="text-white">Bienvenue <?= $utilisateur["pseudo_utilisateur"] ?> </p>
    <?php endif; ?>
</div>

<div class="container ">

    <h1 class="border-bottom border-3 border-warning mt-4 text-white">Listes de vos films</h1>

    <div class="row text-center " href="#home">
        <?php foreach ($films as $film) : ?>
            <?php if ($film['id_utilisateur'] == $utilisateur['id_utilisateur']) :  ?>
                <?php $films = getFilmUser($film['id_utilisateur']); ?>
                <?php $nbFilms = 1; ?>

                <div class="card rounded-4  mb-4 me-2" style="max-width: 20rem ">
                    <div class="card-body ">
                        <h4 class="card-title"><img src="<?= $film["image"] ?>" alt=""</h4>
                        <p class="card-text fs-4 text-dark" ><?= $film["titre"] ?></p>
                        <p class="fs-5 text-dark"> <?= "<i class='bi bi-hourglass-split '></i>".convertirEnHeuresMinutes($film["duree"])  ?></p>
                        <p class="card-text">
                            <a class="btn " style="background-color: #86C232 " role="button"
                               href="detail-film.php?id_film=<?= $film['id_film'] ?>
                        ">Détails du film</a></p>

                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($nbFilms==0) : ?>
            <div class="loader"></div>
        <?php endif; ?>

    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>