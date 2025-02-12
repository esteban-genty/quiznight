<?php require_once(__DIR__ . '/../config/connexion.php') ?>


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

    <!-- Police d'écriture -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <main>

        <section class="dashboard">

            <h3>Bienvenue dans votre dashboard, <?php echo "Estéban Genty"; ?></h3>
            <button class="deconnexion">Déconnexion</button>

            <article class="infos">
                <h3>QuizNight - Questions</h3>
                <div class="infos-droit">
                    <ul>
                        <li><a href="quiz/ajouter-question" class="btn-ajouter">Ajouter</a></li>
                        <li><a href="" class="btn-edit">Modifier</a></li>
                        <li><a href="plats/supprimer-plats" class="btn-delete">Supprimer</a></li>
                    </ul>
                </div>
            </article>

        </section>



    </main>





</body>