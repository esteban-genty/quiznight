<?php require_once(__DIR__ . '/../config/connexion.php') ?>


<?php
class Categories{

    private $bddPDO;

    public function __construct($bddPDO) {
        $this->bddPDO = $bddPDO;
    }

    public function requeteCategories(){        
        $requete = "SHOW TABLES IN quiznight";
        $requete_categories = $this->bddPDO->prepare($requete);
        $requete_categories->execute();
        return $requete_categories;
    }

    public function afficherCategories(){

        $requete_categories = $this->requeteCategories();

        while ($choisir_categories = $requete_categories->fetch(PDO::FETCH_ASSOC)) {
            foreach ($choisir_categories as $table) {
                echo '<a href="quiz-' . $table . '.php"> <div>' . $table . '</div></a>';
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
    <link rel="stylesheet" href="../styles/categories.css">
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

<main>

    <section class="quiz-categories">

        <img src="../assets/quiznight.png" />
        <h1>Catégories</h1>


        <?php
            $categories = new Categories($bddPDO);

            // Afficher les catégories
            $categories->afficherCategories();

        ?>
    </section>

</main>

</body>