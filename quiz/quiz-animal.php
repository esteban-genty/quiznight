<?php require_once(__DIR__ . '/../config/connexion.php'); ?>

<?php

class Quiz_animal extends Connexion {

    private $bddPDO;

    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }



    public function requeteQuestions() {
        $requete = "SELECT id_question, question FROM question WHERE id_quizz = 8";
        $requete_questions = $this->bddPDO->prepare($requete);
        $requete_questions->execute();
        return $requete_questions;
    }



    public function requeteReponses($id_question) {
        $requete = "SELECT id_reponse, reponse FROM reponse WHERE id_question = :id_question";
        $requete_reponse = $this->bddPDO->prepare($requete);
        $requete_reponse->bindValue(':id_question', $id_question, PDO::PARAM_INT);
        $requete_reponse->execute();
        return $requete_reponse;
    }


    public function afficherQuizz(){
        
        $requete_questions = $this->requeteQuestions();


        while ($question = $requete_questions->fetch(PDO::FETCH_ASSOC)) {
            echo "<h2>" . $question['question'] . "</h2>";
    

            $reponses = $this->requeteReponses($question['id_question']);
            echo '<form action="" method="POST">';


            while ($reponse = $reponses->fetch(PDO::FETCH_ASSOC)) {
                echo '<label>';
                echo '<input type="radio" name="reponse_' . $question['id_question'] . '" value="' . $reponse['id_reponse'] . '"> ' . $reponse['reponse'];
                echo '</label><br>';
            }
    
            echo '<button type="submit" name="soumettre_' . $question['id_question'] . '">Soumettre</button>';
            echo '</form>';
            
            
            if (isset($_POST['soumettre_' . $question['id_question']])) {

                if (isset($_POST['reponse_' . $question['id_question']])) {

                    $reponse_utilisateur = $_POST['reponse_' . $question['id_question']];
                    echo $this->verifierReponse($question['id_question'], $reponse_utilisateur);
                } else {
                    echo "<p>Veuillez sélectionner une réponse.</p>";
                }
            }
        }
    }


    public function verifierReponse($id_question, $reponse_utilisateur) {
        $requete_reponse = $this->bddPDO->prepare("SELECT id_reponse, reponse, correct FROM reponse WHERE id_question = :id_question");
        $requete_reponse->bindValue(':id_question', $id_question, PDO::PARAM_INT);
        $requete_reponse->execute();

        while ($reponse = $requete_reponse->fetch(PDO::FETCH_ASSOC)) {
            if ($reponse_utilisateur == $reponse['id_reponse'] && $reponse['correct'] == 1) {
                return "<p class='bonne-reponse'>Bonne réponse !</p>";
            }
        }

        return "<p class='mauvaise-reponse'>Mauvaise réponse. Essayez encore !</p>";
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
    <title>QuizNight - Quiz Animal</title>

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

        <img src="../assets/quiznight.png" alt="QuizNight Logo" />
        <h1>Quiz Animal</h1>

        <?php
        $bddPDO = $connexion->connexionBDD();

        $quiz_animal = new Quiz_animal($bddPDO);
        $quiz_animal->afficherQuizz();
        ?>

    </section>

</body>
</html>
