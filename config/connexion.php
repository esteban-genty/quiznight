<?php
    // Information pour se connecter
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'quiznight';

    // Connexion base de donnés avec PDO
    $bddPDO = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // echo "<p><strong>Connexion réussie</strong></p>";

    // Affiche les erreurs
    $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>