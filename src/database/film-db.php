<?php

require_once '../base.php';
require_once BASE_PATH . '/src/config/db-config.php';

function getFilms(): array
{
    $pdo = getConnexion();
    // 2. Préparation de la requête
    $requete = $pdo->prepare("SELECT * FROM film");

// 3. Exécution de la requête
    $requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
    return $requete->fetchAll(PDO::FETCH_ASSOC);

}

function getFilmId(?int $id_film): array|bool
{
    $pdo = getConnexion();
// 2. Préparation de la requête
    $requete = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");

// 3. Lier le paramètre
    $requete->bindValue(':id', $id_film);

// 4. Exécution de la requête
    $requete->execute();

    return $requete->fetch(PDO::FETCH_ASSOC);
}

function postFilm($titre_film, $duree_film, $resume_film, $date_sortie, $pays_sortie, $image_film, $id_utilisateur): void
{
    $pdo = getConnexion();
    // Traiter les données
    // Traitement des données (insertion dans une base de données)
    $requete = $pdo->prepare(query: "INSERT INTO film (titre_film, duree_film, resume_film, date_sortie, pays_sortie, image_film, id_utilisateur) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $requete->bindParam(1, $titre_film);
    $requete->bindParam(2, $duree_film);
    $requete->bindParam(3, $resume_film);
    $requete->bindParam(4, $date_sortie);
    $requete->bindParam(5, $pays_sortie);
    $requete->bindParam(6, $image_film);
    $requete->bindParam(7, $id_utilisateur);

    // 3. Exécution de la requête
    $requete->execute();

}

function getFilmUser(?int $id_utilisateur) : array|bool
{
    $pdo=getConnexion();
// 2. Préparation de la requête
    $requete = $pdo->prepare( "SELECT * FROM film WHERE id_utilisateur = :id");

// 3. Lier le paramètre
    $requete->bindValue(':id', $id_utilisateur);

// 4. Exécution de la requête
    $requete->execute();

    return $requete->fetch(PDO::FETCH_ASSOC);
}

?>