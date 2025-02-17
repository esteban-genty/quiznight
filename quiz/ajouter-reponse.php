<?php require_once(__DIR__ . '/../config/connexion.php') ?>

<?php

if (empty($_SESSION['utilisateur'])) {
    header("Location: index.php");
    exit();
}

class Ajouter extends Connexion {

    private $bddPDO;

    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function requeteAjouter(){
        $requete = "SELECT id_question, question FROM question";
        $requete_question = $this->bddPDO->prepare($requete);
        $requete_question->execute();
        return $requete_question;
    }

    public function afficherAjoutReponse(){
        $requete_question = $this->requeteAjouter();

        echo '<form action="" method="POST">';
        echo '<select name="question_quiz" id="question_quiz">';
        echo '<option value="choisir-question">Choisir une question</option>';
        while ($choisir_question = $requete_question->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $choisir_question['id_question'] . "'>" . $choisir_question['question'] . "</option>";
        }
        echo "</select>";

        echo '<input placeholder="Réponse 1" type="text" name="reponse1" required>';
        echo '<input placeholder="Réponse 2" type="text" name="reponse2" required>';
        echo '<input placeholder="Réponse 3" type="text" name="reponse3" required>';
        echo '<input placeholder="Réponse 4" type="text" name="reponse4" required>';

        echo '<p>Choisir la réponse correcte :</p>';
        echo '<input type="radio" name="correct" value="1">';
        echo '<input type="radio" name="correct" value="2">';
        echo '<input type="radio" name="correct" value="3">';
        echo '<input type="radio" name="correct" value="4">';

        echo '<button type="submit" name="enregistrer">Ajouter</button>';
        echo '</form>';
    }

    public function ajouterReponse(){
        if (isset($_POST['enregistrer'])) {

            $reponse1 = htmlspecialchars($_POST['reponse1']);
            $reponse2 = htmlspecialchars($_POST['reponse2']);
            $reponse3 = htmlspecialchars($_POST['reponse3']);
            $reponse4 = htmlspecialchars($_POST['reponse4']);

            if (!empty($reponse1) && !empty($reponse2) && !empty($reponse3) && !empty($reponse4)) {

                $question_id = $_POST['question_quiz'];

                if (isset($_POST['correct'])) {

                    $correct = $_POST['correct'];

                    $this->insererReponse($reponse1, ($correct == 1) ? 1 : 0, $question_id);
                    $this->insererReponse($reponse2, ($correct == 2) ? 1 : 0, $question_id);
                    $this->insererReponse($reponse3, ($correct == 3) ? 1 : 0, $question_id);
                    $this->insererReponse($reponse4, ($correct == 4) ? 1 : 0, $question_id);

                    echo 'Réponses ajoutées avec succès';
                } else {
                    echo "Veuillez sélectionner la réponse correcte.";
                }

            } else {
                echo "Toutes les réponses doivent être renseignées.";
            }
        }
    }

    private function insererReponse($reponse, $correct, $question_id) {
        $requete = $this->bddPDO->prepare("INSERT INTO `reponse` (reponse, correct, id_question) VALUES (:reponse, :correct, :id_question)");

        $requete->bindValue(':reponse', $reponse);
        $requete->bindValue(':correct', $correct, PDO::PARAM_INT);
        $requete->bindValue(':id_question', $question_id);

        return $requete->execute();
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
    <link rel="stylesheet" href="../styles/ajouter-reponse.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/root.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once __DIR__ . '/../structure/header.php';?>
    <main>
        <section class="ajouter-reponse">
            <h1>Ajouter une Réponse</h1>
            <?php
                $bddPDO = $connexion->connexionBDD();
                $ajouter = new Ajouter($bddPDO);
                $ajouter->afficherAjoutReponse();
                $ajouter->ajouterReponse();
            ?>
        </section>
    </main>
    <?php require_once __DIR__ . '/../structure/footer.php';?>
</body>
</html>
