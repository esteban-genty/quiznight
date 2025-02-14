<?php
class Connexion{
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function connexionBDD(){
        try {
            $bddPDO = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion réussie";
            return $bddPDO;
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            exit();
        }
    }
}


$connexion = new Connexion('localhost', 'quiznight', 'root', '');


$connexion->connexionBDD();
?>