<?php
if (isset($_GET['id_film'])) {
$id_film = $_GET['id_film'];

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require 'config/db-config.php';

// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_film = :id");

// 3. Lier le paramètre
$requete->bindParam(':id', $id_film);

// 4. Exécution de la requête
$requete->execute();

require 'fonction_duree.php'
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
    <link rel="stylesheet" href="index.css">
    <title>Film.com</title>
</head>
<body class="bg-dark">

<!--Menu-->
<?php include_once "_partials/header.php" ?>

<div class="container bg-white rounded-3">
    <h1 class=" border-bottom border-3 border-warning mt-4">Les Détails du film </h1>
    <div class="table d-flex text-center">
        <div class="mt-3 ">
            <?php
            if ($film = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
            <img src="<?=$film['image_film']?>" alt='' height='300'>
        </div>
        <div class="mt-3 text-black bg-white  p-4 text-start">
            <p><i class="bi bi-camera-reels-fill"></i><span class='fw-bold'>Titre du film : </span><?=$film['titre_film']?></p>
            <p><i class="bi bi-clock-fill"></i><span class="fw-bold">Durée du film :</span> <?=convertirEnHeuresMinutes($film['duree_film'])?></p>
            <p><i class="bi bi-calendar"></i><span class="fw-bold">Date de sortie :</span><?=date("d/m/Y", strtotime($film['date_sortie']))?></p>
            <p><i class="bi bi-flag-fill"></i><span class="fw-bold">Pays de production :</span><?=$film['pays_sortie']?></p>
            <h5 class="fw-semibold">Synopsis du film :</h5>
            <p class="fst-italic"><?=$film['resume_film']?></p>
            <?php
            } else {
                echo "Film introuvable";
            }
            } else {
                echo "Film introuvable";
            }
            ?>
        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>