<?php
// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require "config/db-config.php";

// 2. Préparation la requête
$requete = $pdo->prepare("SELECT resume_film FROM film");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// 1 enregistrement = 1 tableau associatif
$films = $requete->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Résumé du Film</title>
</head>
<body>

<main>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Résumé du Film
            </div>
            <?php foreach ($films as $film) : ?>
                <div class="card-body">
                    <p class="card-text"><?= $film["resume_film"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

</body>
</html>