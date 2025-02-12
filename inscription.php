<?php
    session_start();
    require_once(__DIR__ . '/config/connexion.php'); 
    $erreur_msg = "";
    class Utilisateur {
        private $bddPDO;
    
        public function __construct($bddPDO) {
            $this->bddPDO = $bddPDO;
        }
    
        public function inscrire($mail, $mdp, $mdp_confirmation) {
            if ($mdp !== $mdp_confirmation) {
                return "Les mots de passe ne correspondent pas";
            }
            
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                return "Adresse e-mail invalide";
            }
            
            $mdp_hashed = password_hash($mdp, PASSWORD_BCRYPT);
            
            $req = $this->bddPDO->prepare("INSERT INTO utilisateurs (mail, mdp) VALUES (:mail, :mdp)");
            $req->execute([
                'mail' => $mail,
                'mdp' => $mdp_hashed
            ]);
            
            if ($req->rowCount() > 0) {
                $_SESSION['utilisateur'] = ['mail' => $mail];
                header('Location: inscription.php');
                exit();
            }
            
            return "Erreur lors de l'inscription";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/root.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/inscription.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>QuizNight - Inscription</title>
</head>
<body>
    <?php require_once(__DIR__ . '/structure/header.php'); ?>
    <main>
        <!-- <section class="sectionImg">
            <img src="assets/quiznight.png" alt="logo quiznight">
        </section> -->
        <div class="Bigsection">
            <h1>Inscription</h1>
            <section class="formsection">
                <form action="" method="post">
                    <label for="">Email</label>
                    <input placeholder="quiz@night.fr" type="email" name="mail" id="mail" required>
                    <label for="">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp" required>
                    <label for="">Confirmation du mot de passe</label>
                    <input type="password" name="mdp_confirmation" id="mdp_confirmation" required>
                    <?php if ($erreur_msg): ?>
                        <p style="color: red;"><?php echo $erreur_msg; ?></p>
                    <?php endif; ?>
                    <div id = "buttonbox">
                        <button type="submit" name="submitbutton">S'inscrire</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php require_once(__DIR__ . '/structure/footer.php'); ?>
</body>
</html>