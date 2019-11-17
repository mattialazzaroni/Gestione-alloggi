<?php

session_start();

//Dichiaro le variabili per potermi connettere al database.
$errors = array();
require 'credenzialiDatabase.php';

//Provo a connettermi al database.
try {
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
} catch (PDOException $e) {
    //Stampo un messaggio di errore se non riesco a connettermi al database.
    echo "Connessione fallita: " . $e->getMessage();
}

