<?php
session_start();
// connexion.php
require_once '../config/connexion.php';
require_once 'utilisateur.php';



if (isset($_SESSION['id_utilisateur'])) {
    // header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail'], $_POST['mdp'])) {
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $mdp = "mdp";
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
   
    
    $error ="";


    $database = new Connexion('localhost','quiznight','root','');
    $db = $database->connexionBDD();

    $connexion = new User($db);
    if ($connexion->login($mail, $mdp)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/quiznight/styles/connexion.css">
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
<?php require_once(__DIR__ . '/../structure/header.php'); ?>
    <main>
      
   
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
    <?php require_once(__DIR__ . '/../structure/footer.php'); ?>
</body>
</html>
