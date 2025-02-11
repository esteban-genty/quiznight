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

        if ($user && $this->verifyPassword($mdp, $user['mdp'])) {
            session_start();
            $_SESSION['user_mail'] = $user['mail'];
            header('Location: dashboard.php');
            exit;
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }

    private function verifyPassword($mdp, $hashedPassword) {
        // * le hash est bien au format BCRYPT
        if (password_get_info($hashedPassword)['algo'] === PASSWORD_BCRYPT) {
            return password_verify($mdp, $hashedPassword);
        } else {
            return false; //* hash n'est pas au bon format
        }
    }
}
?>
