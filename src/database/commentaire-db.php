<?php

require_once '../base.php';
require_once BASE_PATH . '/src/config/db-config.php';

function postCommentaire($titre_commentaire, $avis_commentaire, $note_commentaire, $date_commentaire, $heure_commentaire, $id_utilisateur, $id_film): void
{
    $pdo = getConnexion();
    // Traiter les données
    // Traitement des données (insertion dans une base de données)
    $requete = $pdo->prepare(query: "INSERT INTO commentaire (titre_commentaire, avis_commentaire, note_commentaire, date_commentaire, heure_commentaire,  id_utilisateur, id_film) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $requete->bindParam(1, $titre_commentaire);
    $requete->bindParam(2, $avis_commentaire);
    $requete->bindParam(3, $note_commentaire);
    $requete->bindParam(4, $date_commentaire);
    $requete->bindParam(5, $heure_commentaire);
    $requete->bindParam(6, $id_utilisateur);
    $requete->bindParam(7, $id_film);

    // 3. Exécution de la requête
    $requete->execute();

}

function getCommentaire($id_film): array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * FROM commentaire WHERE id_film=$id_film");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function genererEvaluation($note)
{
    // Vérifier que la note est dans la plage valide (0 à 5)
    if ($note < 0 || $note > 5) {
        return "Note invalide. La note doit être comprise entre 0 et 5.";
    }


    // Nombre d'étoiles pleines à afficher
    $fullStars = floor($note);


    // Vérifier s'il faut afficher une demi-étoile
    $hasHalfStar = ($note - $fullStars) >= 0.5;


    // Construction de la chaîne HTML des étoiles
    $starsHTML = '';


    // Ajout des étoiles pleines
    for ($i = 0; $i < $fullStars; $i++) {
        $starsHTML .= '<i class="bi bi-star-fill"></i>';
    }


    // Ajout de la demi-étoile si nécessaire
    if ($hasHalfStar) {
        $starsHTML .= '<i class="bi bi-star-half"></i>';
        $fullStars++; // Augmenter le compteur d'étoiles pleines ajoutées
    }


    // Ajout des étoiles vides restantes
    $emptyStars = 5 - $fullStars; // Calculer le nombre d'étoiles vides restantes
    for ($i = 0; $i < $emptyStars; $i++) {
        $starsHTML .= '<i class="bi bi-star"></i>';
    }


    // Retourner la chaîne HTML complète des étoiles
    return $starsHTML;
}

