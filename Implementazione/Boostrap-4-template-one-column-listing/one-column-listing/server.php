<?php
session_start();

$errors = array();

$servername = "localhost";
$username = "root";
$password = "";
$database = "gestione_alloggi";

try {
    //Mi connetto al database
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connessione fallita: " . $e->getMessage();
}

