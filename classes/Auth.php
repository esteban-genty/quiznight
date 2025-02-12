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
    
        if ($user && password_verify($mdp, $user['mdp'])) { // verifie  hash BCRYPT
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
