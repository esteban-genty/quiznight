<?php
class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($mail, $mdp) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($mdp, $user['mdp'])) {
            session_start();
            $_SESSION['user_id'] = $user['utilisateur_id'];
            $_SESSION['user_mail'] = $user['mail'];
            header('Location: dashboard.php');
            exit;
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }
    
    
}
?>

<?php

// connexion.php
require_once 'config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    $connexion = new Connexion('localhost', 'quiznight', 'root', '');
    $bddPDO = $connexion->connexionBDD();

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
<?php require_once(__DIR__ . '/structure/header.php'); ?>
    <main>
        <section class="sectionimg">
        <img src="assets/quiznight.png" alt="lolo">
        </section>
   
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
    <?php require_once(__DIR__ . '/structure/footer.php'); ?>
</body>
</html>