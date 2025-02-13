<?php
  class User {
    private $db;
    private $table_name = "utilisateur";

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($mail, $mdp) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->bindParam(':email', $mail);
        
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['motdepasse']))
        {
            session_start([
                'cookie_lifetime' => 86400,
                'cookie_httponly' => true,
                'cookie_secure' => isset($_SERVER['HTTPS']),
                'use_strict_mode' => true
            ]);
            $_SESSION['user_id'] = $user['utilisateur_id'];
            $_SESSION['user_mail'] = $user['mail'];
            return true;
        } else {
            return false;
        }
    }
}
?>