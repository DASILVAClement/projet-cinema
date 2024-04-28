<?php

session_start();

require_once '../base.php';
require_once BASE_PROJET . '/src/database/film-db.php';
require_once BASE_PROJET . '/src/database/utilisateur-db.php';
require_once BASE_PROJET . '/src/database/commentaire-db.php';
require_once BASE_PROJET . '/src/fonction/fonction_duree.php';
require_once BASE_PROJET . '/src/fonction/fonction-etoile-avis.php';

$id_film = null;
if (isset($_GET['id_film'])) {
    $id_film = filter_var($_GET['id_film'], FILTER_VALIDATE_INT);
}

$id = getFilmId($id_film);

$commentaires = getCommentaire($id_film);

$utilisateur = null;
if (isset($_SESSION["utilisateur"])) {
    $utilisateur = $_SESSION["utilisateur"];
}

$moyenne_nb_commentaires = getMoyenneNoteEtCommentaire($id_film);

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
<body class="bg-dark">

<?php
require_once BASE_PROJET . '/src/_partials/header.php';
?>

<div class="container">
    <?php if ($utilisateur) : ?>
        <p class="text-white">Bienvenue <?= $utilisateur["pseudo_utilisateur"] ?> </p>
    <?php endif; ?>
</div>

<main>
    <div class="container bg-white rounded-3">

        <h1 class="border-bottom border-3 border-warning mt-4">Les Détails du film</h1>
        <div class="table d-flex text-center">
            <div class="mt-3">

                <?php
                if ($film = $id) : ?>
                <img src="<?= $film['image_film'] ?>" alt='' height='300'>

            </div>

            <div class="mt-3 text-black bg-white p-4 text-start">

                <?php foreach ($moyenne_nb_commentaires as $moyenne_nb_commentaire) : ?>

                    <p><?= $moyenne_nb_commentaire["moyenne_note"] ?>
                        <?= genererEtoiles($moyenne_nb_commentaire["moyenne_note"]) ?>

                        <?php
                        if ($moyenne_nb_commentaire["nombre_commentaire"] == null) {
                            echo "Aucun commentaire pour ce film...";

                        }elseif ($moyenne_nb_commentaire["nombre_commentaire"] == 1) {
                            echo $moyenne_nb_commentaire["nombre_commentaire"] ." commentaire";

                        }elseif ($moyenne_nb_commentaire["nombre_commentaire"] >1) {
                            echo $moyenne_nb_commentaire["nombre_commentaire"] ." commentaires";

                        }?>
                    </p>
                <?php endforeach; ?>

                <p><i class="bi bi-camera-reels-fill"></i><span
                            class='fw-bold'>Titre du film : </span><?= $film['titre_film'] ?></p>

                <p><i class="bi bi-clock-fill"></i><span
                            class="fw-bold">Durée du film :</span> <?= convertirEnHeuresMinutes($film['duree_film']) ?>
                </p>

                <p><i class="bi bi-calendar"></i><span
                            class="fw-bold">Date de sortie :</span><?= date("d/m/Y", strtotime($film['date_sortie'])) ?>
                </p>

                <p><i class="bi bi-flag-fill"></i><span
                            class="fw-bold">Pays de production :</span><?= $film['pays_sortie'] ?></p>

                <h5 class="fw-semibold">Synopsis du film :</h5>
                <p class="fst-italic"><?= $film['resume_film'] ?></p>

                <p class='fw-bold'>Film crée par : </p>
                <?php
                $id_utilisateur = isset($film['id_utilisateur']) ? $film['id_utilisateur'] : null;
                $utilisateur = getPseudo($id_utilisateur);
                echo $utilisateur["pseudo_utilisateur"];
                elseif (getFilmId($id_film) == null) : ?>

            </div>

            <div>
                <div>Film introuvable...</div>
            </div>

            <?php endif; ?>

        </div>
    </div>
</main>

<main>
    <div class="container bg-white rounded-3">
        <div class="row border-bottom border-3 border-warning">
            <div class="row">

                <h1 class="mt-4 col-10">Commentaires</h1>

                <?php if ($_SESSION) : ?>

                    <a href="ajout-commentaire.php?id_film=<?= $film["id_film"] ?>"
                       class="col-2 mt-4 mb-3 btn btn-warning">Ajouter un
                        commentaire</a>

                <?php endif; ?>
            </div>
        </div>


        <?php foreach ($commentaires as $commentaire) : ?>

            <div class="container">

                <ul class="list-group">

                    <li class="list-group-item border-warning border-2 mt-3">
                        <div class="row">
                            <p class="col-9 fs-4 fw-bold"><?= $commentaire["titre_commentaire"] ?></p>
                            <p class="col-3">Avis écrit
                                le <?= date("d/m/Y", strtotime($commentaire['date_commentaire'])) ?>
                                à <?= date("H:i:s", strtotime($commentaire['heure_commentaire'])) ?></p>
                        </div>
                        <div class="row">
                            <p class="col-10"><?= $commentaire["avis_commentaire"] ?></p>
                            <h5 class="col-1 btn btn-warning rounded-5"><?= $commentaire["note_commentaire"] ?><i
                                        class="bi bi-star"></i></h5>
                        </div>

                        <p>Cet avis a été écrit
                            par <?= getPseudo($commentaire['id_utilisateur'])['pseudo_utilisateur'] ?></p>

                    </li>

                </ul>

            </div>

        <?php endforeach; ?>

</main>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
