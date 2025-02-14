<header>
    <a class="aTitre" href="accueil.php"><h1>Accueil</h1></a>
    <a class="aImg" href="accueil.php"><img src="assets/quiznight.png" alt="logo quiznight"></a>
    <nav>
        <ul>
            <?php 
                if (isset($_SESSION['utilisateur']) == 0) {
                    echo "<li><a href='connexion.php'>Connexion</a></li>";
                    echo "<li><a href='inscription.php'>Inscription</a></li>";
                }
                else {
                    echo "<li><a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i>Se déconnecter</a></li>";
                }
            ?>
        </ul>
    </nav>
</header>