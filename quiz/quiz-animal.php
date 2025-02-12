<?php require_once(__DIR__ . '/../config/connexion.php') ?>

<?php

class Quiz_animal extends Connexion{

    private $bddPDO;

    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', ''); // Tu peux l'adapter selon ta structure
        $this->bddPDO = $bddPDO;
    }

    public function requeteAnimal() {
        $requete = "SELECT * FROM animal";
        $requete_animal = $this->bddPDO->prepare($requete);
        $requete_animal->execute();
        return $requete_animal;
    }

    public function afficherReponse($id_question, $reponse_utilisateur) {

        $requete_reponse = $this->bddPDO->prepare("SELECT reponses FROM animal WHERE id_question = :id_question");
        $requete_reponse->bindValue(':id_question', $id_question, PDO::PARAM_INT);
        $requete_reponse->execute();
        $reponse_correcte = $requete_reponse->fetch(PDO::FETCH_ASSOC)['reponses'];

        if (strtolower($reponse_utilisateur) == strtolower($reponse_correcte)) {
            return "<p class='bonne-reponse'>Bonne réponse</p>";
        } else {
            return "<p class='mauvaise-reponse'>Mauvaise Réponse</p>";
        }
    }

    public function afficherQuestion() {
        $requete_animal = $this->requeteAnimal();

        while ($choisir_reponses = $requete_animal->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="" method="POST">';
            echo "<h2>" . $choisir_reponses["questions"] . "</h2>";

            echo "<input type='hidden' name='id_question' value='" . $choisir_reponses['id_question'] . "'>";
            echo '<input type="submit" name="reponse" value="vrai" class="vrai">';
            echo '<input type="submit" name="reponse" value="faux" class="faux">';
            echo '</form>';


            if (isset($_POST['reponse']) && $_POST['id_question'] == $choisir_reponses['id_question']) {
                $reponse_utilisateur = $_POST['reponse'];
                $id_question = $_POST['id_question'];
                echo $this->afficherReponse($id_question, $reponse_utilisateur);
            }
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
        
        $bddPDO = $connexion->connexionBDD();

        // Création de l'objet Quiz_animal avec l'objet PDO
        $quiz_animal = new Quiz_animal($bddPDO);

        // Affichage des questions et réponses
        $quiz_animal->afficherQuestion();
        
        ?>

    </section>

</body>
</html>
