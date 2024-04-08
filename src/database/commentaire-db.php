<?php

require_once '../base.php';
require_once BASE_PATH . '/src/config/db-config.php';

function postCommentaire($titre_commentaire, $avis_commentaire, $note_commentaire, $date_commentaire, $id_utilisateur, $id_film): void
{
    $pdo = getConnexion();
    // Traiter les données
    // Traitement des données (insertion dans une base de données)
    $requete = $pdo->prepare(query: "INSERT INTO film (titre_commentaire, avis_film, note_film, date_commentaire, id_utilisateur, id_film) VALUES (?, ?, ?, ?, ?, ?)");

    $requete->bindParam(1, $titre_commentaire);
    $requete->bindParam(2, $note_commentaire);
    $requete->bindParam(3, $avis_commentaire);
    $requete->bindParam(4, $date_commentaire);
    $requete->bindParam(5, $id_utilisateur);
    $requete->bindParam(6, $id_film);

    // 3. Exécution de la requête
    $requete->execute();

}