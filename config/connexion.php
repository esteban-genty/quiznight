<?php
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
?>