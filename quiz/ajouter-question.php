<?php require_once(__DIR__ . '/../config/connexion.php') ?>

<?php

class Ajouter extends Connexion{

    private $bddPDO;

    // Constructeur
    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', ''); // Tu peux adapter ce passage selon ta structure
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

        echo '<select name="categories_quiz" id="categories_quiz">';
        echo '<option value="choisir-categories">Choisir Categorie</option>';
        while ($choisir_categories = $requete_categories->fetch(PDO::FETCH_ASSOC)) {
            foreach ($choisir_categories as $table) {
                echo "<option value='" .$table . "'>" . $table . "</option>";
            }
        }
        echo "</select>";

        echo '<input placeholder="Question" type="text" name="question" required>';
        echo '<input placeholder="Vrai ou Faux" type="text" name="reponse" required>';
        echo '<button type="submit" name="enregistrer">Ajouter</button>';
    }

    public function ajouterQuestion(){

        if (isset($_POST['enregistrer'])) {

            $categorie = htmlspecialchars($_POST['categories_quiz']);

            if($categorie == "choisir-categories"){
                echo "<p>Veuillez choisir une catégorie.</p>";
                exit();
            }else{
                $categorie = htmlspecialchars($_POST['categories_quiz']);
            }

            $question = htmlspecialchars($_POST['question']);
            $reponse = htmlspecialchars($_POST['reponse']);
            $table = htmlspecialchars($_POST['categories_quiz']);

            if($reponse == strtolower('vrai') || $reponse == strtolower('faux')){

                if(!empty($question) && !empty($reponse)){

                    $requete = $this->bddPDO->prepare("INSERT INTO `$table` (questions, reponses) VALUES (:question, :reponse)");

                    // Change les valuer des paramètres de la requête SQL
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