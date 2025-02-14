<?php
    class User {
        private $db;
        private $table_name = "utilisateur";

        public $nom;
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

            $query = "INSERT INTO " . $this->table_name . " (nom, mail, mdp) VALUES (:nom, :mail, :mdp)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':nom', $this->nom);
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
            $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
        
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($mdp, $user['mdp'])) { // verifie  hash BCRYPT
                session_start();
                $_SESSION['user_id'] = $user['id_utilisateur'];
                $_SESSION['user_mail'] = $user['mail'];
                header('Location: dashboard.php');
                exit;
            } else {
                return "Email ou mot de passe incorrect.";
            }
        }
    }
?>