<?php
function genererEtoiles($note)
{
// Vérifier que la note est dans la plage valide (0 à 5)
if ($note < 0 || $note > 5) {
return "Note invalide. La note doit être comprise entre 0 et 5.";
} elseif ($note == null) {
return "";
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