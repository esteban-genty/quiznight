<?php
    class User {
        private $db;
        private $table_name = "utilisateurs";

        public $mail;
        public $mdp;
        public $mdp_confirmation;

        public function __construct($db) {
            $this->db = $db;
        }

        public function register() {
            if ($this->mdp !== $this->mdp_confirmation) {
                return "Les mots de passe ne correspondent pas";
            }

            if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
                return "Adresse e-mail invalide";
            }

            $this->mdp = password_hash($this->mdp, PASSWORD_BCRYPT);

            $query = "INSERT INTO " . $this->table_name . " (mail, mdp) VALUES (:mail, :mdp)";
            $stmt = $this->mdp_confirmation->prepare($query);

            $stmt->bindParam(':mail', $this->mail);
            $stmt->bindParam(':mdp', $this->mdp);

            if ($stmt->execute()) {
                $_SESSION['utilisateur'] = ['mail' => $this->mail];
                header('Location: inscription.php');
                exit();
            } else {
                return "Erreur lors de l'inscription";
            }
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