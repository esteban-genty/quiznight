<?php
    require_once(__DIR__ . '/../config/connexion.php');
    class Supprimer extends Connexion {

        private $bddPDO;

        // Constructeur
        public function __construct() {
            parent::__construct('localhost', 'quiznight', 'root', '');
            $this->bddPDO = $this->connexionBDD();  // On récupère la connexion à la BDD ici
        }

        //Requete pour recuperer des catégories sur la bdd pour le menu select
        public function ReqSel() {
            $reqID = "SELECT id_quizz, titre FROM quizz";
            $reqIDQ = $this->bddPDO->prepare($reqID);
            $reqIDQ->execute();
    
            return $reqIDQ;
        }

        public function delete($id_quiz) {
            $reqDelete = "DELETE FROM quizz WHERE id_quizz = :id_quizz";
            $reqD = $this->bddPDO->prepare($reqDelete);
            $reqD->bindParam(':id_quizz', $id_quiz, PDO::PARAM_INT);
            $reqD->execute();
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
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/supprimer.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>Supprimer Quiz - QuizNight</title>
</head>
<body>
    <?php require_once(__DIR__ . '/../structure/header.php'); ?>
    <main>

    <section class="Bigsection">
        <h1>Liste de quiz</h1>
        <section class="formsection">
            <form action="" method="POST">
                <select name="cat" id="">
                    <option value="">Choisissez une catégorie</option>
                    <?php 
                        $connexion = new Connexion('localhost', 'quiznight', 'root', '');
                        $bddPDO = $connexion->connexionBDD();

                        $sel = new Supprimer($bddPDO);
                        $reqIDQ = $sel->ReqSel();

                        while ($choisir_quiz = $reqIDQ->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $choisir_quiz['id_quizz'] . "'>" . $choisir_quiz['titre'] . "</option>";
                        }
                    ?>
                </select>

                <input type="submit" name="suppB" id="suppB" value="Supprimer">
            </form>

            <?php
            // Vérifier si un quiz a été sélectionné
            if (isset($_POST['cat']) && !empty($_POST['cat'])) {
                $id_quiz = $_POST['cat'];
                $sel->delete($id_quiz);
            }
            ?>
        </section>
    </section>

    </main>
    <?php require_once(__DIR__ . '/../structure/footer.php'); ?>
</body>
</html>