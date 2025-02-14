<?php
  class User {
    private $db;
    private $table_name = "utilisateur";

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($email, $motdepasse) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->bindParam(':email', $email);
        
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($motdepasse, $user['motdepasse']))
        {
            //session_start([
               // 'cookie_lifetime' => 86400,
                //'cookie_httponly' => true,
                //'cookie_secure' => isset($_SERVER['HTTPS']),
                //'use_strict_mode' => true
           // ]);
           //var_dump($_SESSION);
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
            $_SESSION['user_email'] = $user['email'];
            return true;
        } else {
            return false;
        }
    }
}
?>