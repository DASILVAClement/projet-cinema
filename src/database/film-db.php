<?php
require_once '../base.php';
require_once  BASE_PATH. '/src/config/db-config.php';

function getFilms(): array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * FROM film");
    $requete->execute();
    return $films = $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getDetail($id_film)
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_film = :id");
    $requete->bindParam(':id', $id_film);
    $requete->execute();
    $film = $requete->fetch(PDO::FETCH_ASSOC);
    return $film;
}

function getFormulaire($titre_film, $duree_film, $resume_film, $date_sortie, $pays_sortie, $image_film): void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO film (titre_film, duree_film, resume_film, date_sortie, pays_sortie, image_film) VALUES (?, ?, ?, ?, ?, ?)");

    $requete->bindParam(1, $titre_film);
    $requete->bindParam(2, $duree_film);
    $requete->bindParam(3, $resume_film);
    $requete->bindParam(4, $date_sortie);
    $requete->bindParam(5, $pays_sortie);
    $requete->bindParam(6, $image_film);

    $requete->execute();
}
