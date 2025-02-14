<?php require_once(__DIR__ . '/../config/connexion.php'); ?>

<?php

class AjouterQuizz extends Connexion {

    private $bddPDO;

    // Constructeur
    public function __construct() {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $this->connexionBDD();  // On récupère la connexion à la BDD ici
    }

    public function afficherAjoutQuizz(){
        echo '<h1>Ajouter un quizz</h1>';
        echo '<form action="" method="POST">';
        echo '<input placeholder="titre" type="text" name="titre" required>';
        echo '<input placeholder="description" type="text" name="description" required>';
        echo '<button type="submit" name="enregistrer">Ajouter</button>';
        echo '</form>';
    }

    public function AjouterQuizz(){
        // Vérifier si la session est démarrée avant d'y accéder
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['enregistrer'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            
            // Vérifier si l'utilisateur est bien connecté avant d'accéder à $_SESSION
            if (isset($_SESSION['id_utilisateur'])) {
                $id_utilisateur = $_SESSION['id_utilisateur'];
            } else {
                echo "Utilisateur non connecté.";
                return;
            }

            if (!empty($titre) && !empty($description)) {
                $requete = $this->bddPDO->prepare("INSERT INTO `quizz` (titre, description, id_utilisateur) VALUES (:titre, :description, :id_utilisateur)");

                $requete->bindValue(':titre', $titre, PDO::PARAM_STR);
                $requete->bindValue(':description', $description, PDO::PARAM_STR);
                $requete->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

                $result = $requete->execute();

                if ($result) {
                    echo "Quizz ajoutée avec succès";
                } else {
                    echo "Erreur lors de l'ajout du quizz";
                }
            } else {
                echo "Veuillez remplir tous les champs";
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
        <section class="ajouter-quizz">
            <?php
                // Connexion à la base de données
                $quizz = new AjouterQuizz();
                $quizz->afficherAjoutQuizz();
                $quizz->AjouterQuizz();
            ?>
        </section>
    </main>
</body>
</html>
