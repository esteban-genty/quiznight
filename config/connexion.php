<?php
<<<<<<< HEAD
    $host = 'localhost';
    $dbname = 'quiznight';
    $username = 'root';  
    $password = ''; 
    
    try {

        $bddPDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        exit();
    }
=======
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
>>>>>>> 81df5bdbea77dc28f4d1b0c0f0b24c794b65719c
?>