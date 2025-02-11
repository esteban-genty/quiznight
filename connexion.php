<?php

// connexion.php
require_once 'Database.php';
require_once 'Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    $database = new Database();
    $db = $database->connect();

    $auth = new Auth($db);
    $error = $auth->login($mail, $mdp);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles/connexion.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
  
    <main>
    <img src="assets/quiznight.png" alt="lolo">
    <h1>Connexion</h1>
        <section class="formsection">
    
            <form method="POST">
               
                <label for="mail">Email :</label>
                <input type="email" name="mail" required>

                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" required>

                <div id="buttonbox">
                    <button type="submit">Se connecter</button>
                </div>
                <?php if (isset($error)) : ?>
                    <p style="color: red; text-align: center;"> <?= htmlspecialchars($error) ?> </p>
                <?php endif; ?>
            </form>
        </section>
    </main>
</body>
</html>
