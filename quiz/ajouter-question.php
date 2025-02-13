<?php require_once(__DIR__ . '/../config/connexion.php') ?>

<?php

class Ajouter extends Connexion{

    private $bddPDO;

    // Constructeur
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    }

    public function requeteAjouter(){

        $requete = "SHOW TABLES IN quiznight";
        $requete_categories = $this->bddPDO->prepare($requete);
        $requete_categories->execute();
        return $requete_categories;
    }

    public function afficherAjoutQuestions(){

        $requete_categories = $this->requeteAjouter();

        echo '<h1>Ajouter une questions</h1>';
        echo '<form action="" method="POST">';

        echo '<input placeholder="Question" type="text" name="question" required>';

        echo '<input placeholder="Réponse 1" type="text" name="reponse1" required>';
        echo '<input placeholder="Réponse 2" type="text" name="reponse2" required>';
        echo '<input placeholder="Réponse 3" type="text" name="reponse3" required>';
        echo '<input placeholder="Réponse 4" type="text" name="reponse4" required>';

        echo '<button type="submit" name="enregistrer">Ajouter</button>';
    }

    public function ajouterQuestion(){

        if (isset($_POST['enregistrer'])) {

            $question = htmlspecialchars($_POST['question']);
            $reponse1 = htmlspecialchars($_POST['reponse1']);
            $reponse2 = htmlspecialchars($_POST['reponse2']);
            $reponse3 = htmlspecialchars($_POST['reponse3']);
            $reponse4 = htmlspecialchars($_POST['reponse4']);

            if($reponse == strtolower('vrai') || $reponse == strtolower('faux')){

                if(!empty($question) && !empty($reponse)){

                    $requete = $this->bddPDO->prepare("INSERT INTO `$table` (questions, reponses) VALUES (:question, :reponse)");

                    $requete->bindValue(':question', $question);
                    $requete->bindValue(':reponse', $reponse);
                    //$requete->bindValue(':utilisateur', $_SESSION['utilisateur']['utilisateur_id']);

                    $result = $requete->execute();

                    if($result){

                        echo 'question / réponse ajouter';
                    }else{
                        echo 'erreur';
                    }

                }
            }else{
                echo "vrai ou faux";
            }

        }else{
            echo 'rien';
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

                $bddPDO = $connexion->connexionBDD();

                
                $ajouter = new Ajouter($bddPDO);
                $ajouter->afficherAjoutQuestions();
                $ajouter->ajouterQuestion();

            ?>

        </section>



    </main>





</body>