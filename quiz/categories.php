<?php require_once(__DIR__ . '/../config/connexion.php') ?>
<<<<<<< HEAD
<?php require_once(__DIR__ . '/../classes/categories.php')?>

=======

<?php
class Categories extends Connexion {

    private $bddPDO;

    public function __construct($bddPDO) {
        parent::__construct('localhost', 'quiznight', 'root', '');
        $this->bddPDO = $bddPDO;
    } 

    // Requête pour récupérer les titres des quizz
    public function requeteQuizz() {        
        $requete = "SELECT titre  FROM quizz";
        $requete_quizz = $this->bddPDO->prepare($requete);
        $requete_quizz->execute();
        return $requete_quizz;
    }

    // Afficher les quizz sous forme de liens
    public function afficherCategories() {
        $requete_quizz = $this->requeteQuizz();

        while ($choisir_quizz = $requete_quizz->fetch(PDO::FETCH_ASSOC)) {
            foreach ($choisir_quizz as $table) {
                echo '<a href="quiz-' . $table . '.php"> <div>' . $table . '</div></a>';
            }
        }
    }
}
?>
>>>>>>> fonctionnalité/quiz

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
            // Création de l'objet Connexion pour récupérer l'objet PDO
            $connexion = new Connexion('localhost', 'quiznight', 'root', '');
            $bddPDO = $connexion->connexionBDD();

            // Création de l'objet Categories avec l'objet PDO
            $categories = new Categories($bddPDO);

            // Afficher les catégories
            $categories->afficherCategories();
        ?>
    </section>

</main>

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fonctionnalité/quiz
