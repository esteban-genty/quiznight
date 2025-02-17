<?php
    require_once(__DIR__ . '/../config/connexion.php');
    require_once(__DIR__ . '/../utilisateur/utilisateur.php');

    $connexion = new Connexion('localhost', 'quiznight', 'root', '');
    $bddPDO = $connexion->connexionBDD();

    $user = new User($bddPDO);

    if (isset($_POST['submitbutton'])) {
        $user->nom = $_POST['nom'];
        $user->email = $_POST['email'];
        $user->motdepasse = $_POST['motdepasse'];
        $user->motdepasse_confirmation = $_POST['motdepasse_confirmation'];

        $erreur_msg = $user->register();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/inscription.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>QuizNight - Inscription</title>
</head>
<body>
    <?php require_once(__DIR__ . '/../structure/header.php'); ?>
    <main>
        <div class="Bigsection">
            <h1>Inscription</h1>
            <section class="formsection">
                <form action="" method="post">
                    <label for="">Pseudo</label>
                    <input type="text" name="nom" id="nom" required>
                    <label for="">Email</label>
                    <input placeholder="quiz@night.fr" type="email" name="email" id="email" required>
                    <label for="">Mot de passe</label>
                    <input type="password" name="motdepasse" id="motdepasse" required>
                    <label for="">Confirmation du mot de passe</label>
                    <input type="password" name="motdepasse_confirmation" id="motdepasse_confirmation" required>
                    <?php if (!empty($erreur_msg)) : ?>
                        <p style="color: red; text-align: center;"> <?= htmlspecialchars($erreur_msg) ?> </p>
                    <?php endif; ?>
                    <div id = "buttonbox">
                        <button type="submit" name="submitbutton">S'inscrire</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php require_once(__DIR__ . '/../structure/footer.php'); ?>
</body>
</html>