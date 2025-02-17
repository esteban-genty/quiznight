<?php require_once(__DIR__ . '/../config/connexion.php') ?>
<?php

if (empty($_SESSION['utilisateur'])) {
    header("Location: ../index.php");
    exit();
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
    <link rel="stylesheet" href="../styles/dashboard.css">
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
    <?php require_once __DIR__ . '/../structure/header.php'; ?>
    <main>

        <section class="dashboard">

            <h2>Bienvenue dans votre dashboard,  <?php echo htmlspecialchars($_SESSION['utilisateur']['nom']); ?></h2>
            <a href="../config/logout.php"><button class="deconnexion">Déconnexion</button></a>


            <article class="infos">
                <h3>QuizNight - Quizz</h3>
                <div class="infos-droit">
                    <ul>
                        <li><a href="../quiz/ajouter-quiz.php" class="btn-ajouter">Ajouter</a></li>
                        <li><a href="" class="btn-edit">Modifier</a></li>
                        <li><a href="../quiz/supprimer.php" class="btn-delete">Supprimer</a></li>
                    </ul>
                </div>
            </article>

            <article class="infos">
                <h3>QuizNight - Questions</h3>
                <div class="infos-droit">
                    <ul>
                        <li><a href="../quiz/ajouter-question.php" class="btn-ajouter">Ajouter</a></li>
                        <li><a href="" class="btn-edit">Modifier</a></li>
                        <li><a href="plats/supprimer-plats" class="btn-delete">Supprimer</a></li>
                    </ul>
                </div>
            </article>

            <article class="infos">
                <h3>QuizNight - Reponse</h3>
                <div class="infos-droit">
                    <ul>
                        <li><a href="../quiz/ajouter-reponse.php" class="btn-ajouter">Ajouter</a></li>
                        <li><a href="" class="btn-edit">Modifier</a></li>
                        <li><a href="plats/supprimer-plats" class="btn-delete">Supprimer</a></li>
                    </ul>
                </div>
            </article>

        </section>
    </main>
    <?php require_once __DIR__ . '/../structure/footer.php';?>





</body>