<?php
    class User {
        private $db;
        private $table_name = "utilisateur";

        public $nom;
        public $email;
        public $motdepasse;
        public $motdepasse_confirmation;

        public function __construct($db) {
            $this->db = $db;
        }

        public function register() {
            if ($this->motdepasse !== $this->motdepasse_confirmation) {
                return "Les mots de passe ne correspondent pas";
            }

            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return "Adresse e-mail invalide";
            }

            $this->motdepasse = password_hash($this->motdepasse, PASSWORD_BCRYPT);

            $query = "INSERT INTO " . $this->table_name . " (nom, email, motdepasse) VALUES (:nom, :email, :motdepasse)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':motdepasse', $this->motdepasse);

            if ($stmt->execute()) {
                $_SESSION['utilisateur'] = ['email' => $this->email];
                header('Location: inscription.php');
                exit();
            } else {
                return "Erreur lors de l'inscription";
            }
        }

        public function login($email, $motdepasse) {
            $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($motdepasse, $user['motdepasse'])) { // verifie  hash BCRYPT
                session_start();
                $_SESSION['user_id'] = $user['id_utilisateur'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: dashboard.php');
                exit;
            } else {
                return "Email ou mot de passe incorrect.";
            }
        }
    }
?>