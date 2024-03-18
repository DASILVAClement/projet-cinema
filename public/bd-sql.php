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
$etudiants = $requete->fetchAll(PDO::FETCH_ASSOC);
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
<body>
<h1>FILM</h1>

<div class="bg-dark p-3 shadow rounded-4">
    <p>Afficher le tableau <span class="text-success">$comptes</span> sous la forme d'une table</p>
    <div class="text-center">
        <img src="../assets/images/tp/bases-enonce-1.png" alt="tab" class="img-fluid">
    </div>
    <div class="d-flex mt-2">
        <i class="bi bi-filetype-exe fs-2 text-warning text-bold"></i>
        <div class="bg-black rounded-4 p-3 flex-fill">
            <!-- Votre code -->
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col"><span class="text-warning">Prénom</span></th>
                    <th scope="col"><span class="text-warning">Nom</span></th>
                    <th scope="col"><span class="text-warning">Email</span></th>
                    <th scope="col"><span class="text-warning">Premium</span></th>
                    <th scope="col"><span class="text-warning">Action</span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($etudiants as $etudiant) : ?>
                    <tr>
                        <td><?= $etudiant["titre_film"] ?></td>
                        <td><?= $etudiant["duree_film"] ?></td>
                        <td><?= $etudiant["resume_film"] ?></td>
                        <td><?= ($etudiant["premium"]) ? "Oui" : "Non" ?></td>
                        <td>
                            <button class="btn btn-danger">Supprimer</button>
                            <button class="btn btn-warning">Modifer</button>
                            <?php if ($etudiant["premium"] == false) : ?>
                                <button class="btn btn-success">Premium</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
