<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/styles.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>QuizNight - Accueil</title>
</head>
<body>
    <?php require_once(__DIR__ . '/structure/header.php'); ?>
    <main>
        <img src="assets/quiznight.png" alt="">
        <div class="divCTA">
            <a id="aJeu" href="quiz/categories.php">JOUEZ MAINTENANT</a>
            <label for="">Créez vos propres Quiz en vous</label>
            <a href="utilisateur/inscription.php">Inscrivant</a>
            <p>ou</p>
            <a id="aCo" href="utilisateur/connexion.php">connectant</a>
        </div>
    </main>
    <?php require_once(__DIR__ . '/structure/footer.php'); ?>
</body>
</html>