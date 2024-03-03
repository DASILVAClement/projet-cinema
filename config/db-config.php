<?php
//Définir les informations de connexion
const DB_HOST = "localhost:3306";
const DB_NAME = "db_intro";
const DB_USER = "root";
const DB_PASSWORD = "";

//Utiliser PDO pour créer une connexion à la DB
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);