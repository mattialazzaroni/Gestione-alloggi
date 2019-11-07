<?php
session_start();

$errors = array();

$servername = "efof.myd.infomaniak.com";
$username = "efof_i16lazmat";
$password = "Alloggi_Admin2019";
$database = "efof_i16lazmat";

try {
    //Mi connetto al database
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connessione fallita: " . $e->getMessage();
}

