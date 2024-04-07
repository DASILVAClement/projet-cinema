<?php
session_start();

if (empty($_SESSION)) {
    header("Location: connexion-compte.php");
} elseif (!empty($_SESSION)) {
    $_SESSION = [];
    header("Location: /");
}