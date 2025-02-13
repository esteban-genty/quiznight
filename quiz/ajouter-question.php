<?php require_once(__DIR__ . '/../config/connexion.php'); ?>

<?php

class AjouterQuestion extends Connexion {

    private $bddPDO;

    // Constructeur
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function requeteAfficherQuizz(){
        $requete = "SELECT * FROM quizz";
        $requete_quizz = $this->bddPDO->prepare($requete);
        $requete_quizz->execute();
        return $requete_quizz;
    }

    public function afficherAjoutQuestions(){
        $requete_quizz = $this->requeteAfficherQuizz();

        echo '<h1>Ajouter une question</h1>';
        echo '<form action="" method="POST">';

        echo '<select name="question_quiz" id="question_quiz" required>';
        echo '<option value="">Choisir un quiz</option>';
        while ($choisir_quizz = $requete_quizz->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $choisir_quizz['id_quizz'] . "'>" . $choisir_quizz['titre'] . "</option>";
        }
        echo "</select>";

        echo '<input placeholder="Question" type="text" name="question" required>';
        echo '<button type="submit" name="enregistrer">Ajouter</button>';
        echo '</form>';
    }

    public function ajouterQuestion(){
        if (isset($_POST['enregistrer'])) {

            // Vérification de la question et du quiz
            $question = htmlspecialchars($_POST['question']);
            $id_quizz = $_POST['question_quiz']; // Récupération de l'ID du quiz sélectionné

            if (!empty($question) && !empty($id_quizz)) {

                // Insertion de la question dans la base de données
                $requete = $this->bddPDO->prepare("INSERT INTO `question` (question, id_quizz) VALUES (:question, :id_quizz)");

                $requete->bindValue(':question', $question);
                $requete->bindValue(':id_quizz', $id_quizz, PDO::PARAM_INT);

                $result = $requete->execute();

                if ($result) {
                    echo 'Question ajoutée avec succès';
                } else {
                    echo 'Erreur lors de l\'ajout de la question';
                }

            } else {
                echo "La question et le quiz doivent être sélectionnés.";
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
    <title>QuizNight - Ajouter une question</title>

    <!-- Fichier styles -->
    <link rel="stylesheet" href="../styles/ajouter-question.css">
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <section class="ajouter-question">
            <?php
                // Connexion à la base de données
                $bddPDO = $connexion->connexionBDD();

                // Création de l'objet AjouterQuestion et appel des méthodes
                $ajouter = new AjouterQuestion($bddPDO);
                $ajouter->afficherAjoutQuestions();
                $ajouter->ajouterQuestion();
            ?>
        </section>
    </main>
</body>
</html>
