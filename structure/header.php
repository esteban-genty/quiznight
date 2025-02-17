<header>
    <a class="aTitre" href="index.php"><h1>Accueil</h1></a>
    <a class="aImg" href="index.php"><img src="/quiznight/assets/quiznight.png" alt="logo quiznight"></a>
    <nav>
        <ul>
            <?php 
                if (isset($_SESSION['utilisateur']) == 0) {
                    echo "<li><a href='../utilisateur/connexion.php'>Connexion</a></li>";
                    echo "<li><a href='../utilisateur/inscription.php'>Inscription</a></li>";
                }
                else {
                    echo "<li><a href='../config/logout.php'><i class='fa-solid fa-right-from-bracket'></i>Se déconnecter</a></li>";
                }
            ?>
        </ul>
    </nav>
</header>