<?php
require_once '../base.php';
require_once  BASE_PATH. '/src/config/db-config.php';

function getUser($pseudo_utilisateur, $email_utilisateur,$mdp_utilisateur): void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO utilisateur (pseudo_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?)");
    $requete->bindParam(1, $pseudo_utilisateur);
    $requete->bindParam(2, $email_utilisateur);
    $requete->bindParam(3, password_hash($mdp_utilisateur,PASSWORD_ARGON2I));
    $requete->execute();
}

function getEmail($email_utilisateur): array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE email_utilisateur=?");
    $requete->execute([$email_utilisateur]);
    $user = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function getComptes() : array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare("SELECT * FROM utilisateur");
    $requete->execute();
    $user = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}