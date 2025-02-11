<?php require_once(__DIR__ . '/../config/connexion.php') ?>



<?php

class Quiz_animal{

    private $bddPDO;

    public function __construct($bddPDO) {
        $this->bddPDO = $bddPDO;
    }

    public function requeteAnimal(){
        $requete = "SELECT * FROM animal";
        $requete_animal = $this->bddPDO->prepare($requete);
        $requete_animal->execute();
        return $requete_animal;
    }

    public function afficherQuestion(){

        $requete_animal = $this->requeteAnimal();

        while ($choisir_reponses = $requete_animal->fetch(PDO::FETCH_ASSOC)) {
                echo '<form action="" method="POST">';
                echo "<h2>" . $choisir_reponses["questions"] . "</h2>";
                echo '<button class="vrai" type="submit"> Vrai </button>';
                echo '<button class="faux" type="submit"> Faux </button>';
                echo '</form>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site de quiz">
    <meta name="keywords" content="QuizNight, Quiz en ligne">
    <meta name="author" content="Estéban, Antoine, Sébastien">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizNight - Choix de catégories</title>

    <!-- Fichier styles -->
    <link rel="stylesheet" href="../styles/quiz.css">
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

    <section class="quiz-animal">

        <img src="../assets/quiznight.png" />
        <h1>Questions</h1>

        <?php
        
        $quiz_animal = new Quiz_animal($bddPDO);

        $quiz_animal->afficherQuestion();
        
        
        ?>





    </section>






</body>