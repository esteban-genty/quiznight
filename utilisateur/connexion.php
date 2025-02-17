<?php
session_start();


// Connexion à la base de données
$connexion = Connexion::getInstance()->getPdo();

class Connexion {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=quiznight;charset=utf8mb4", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connexion();
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }
}

class Utilisateur {
    private $pdo;

    public function __construct() {
        $this->pdo = Connexion::getInstance()->getPdo();
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}


$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["motdepasse"])) {
        $email = trim($_POST["email"]);
        $motdepasse = trim($_POST["motdepasse"]);

        $utilisateur = new Utilisateur();
        $userData = $utilisateur->getUserByEmail($email);

        if ($userData && password_verify($motdepasse, $userData["motdepasse"])) {
            $_SESSION["utilisateur"] = [
                "id_utilisateur" => $userData["id_utilisateur"],
                "nom" => $userData["nom"],
                "email" => $userData["email"]
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
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
<?php require_once __DIR__ . '/../structure/header.php';?>
    <main>
        <h1>Connexion</h1>
        <section class="formsection">
            <form method="POST">
                <label for="email">Email :</label>
                <input type="email" name="email" required>

                <label for="motdepasse">Mot de passe :</label>
                <input type="password" name="motdepasse" required>

                <div id="buttonbox">
                    <button type="submit">Se connecter</button>
                </div>
                <?php if (!empty($error)) : ?>
                    <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </form>
        </section>
    </main>
    <?php require_once __DIR__ . '/../structure/footer.php'; ?>
</body>
</html>
