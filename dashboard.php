<?php
session_start();


if (!isset($_SESSION["utilisateur"])) {
  
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations pour chaque page lors des naviga
$utilisateur = $_SESSION["utilisateur"];
$idUtilisateur = $utilisateur["id_utilisateur"];
$nomUtilisateur = $utilisateur["nom"];
$emailUtilisateur = $utilisateur["email"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="styles/dashoard.css">
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
<?php require_once __DIR__ . '/structure/header.php';?>
   
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="styles/dashoard.css">
    <link rel="stylesheet" href="/quiznight/styles/root.css">
    <link rel="stylesheet" href="/quiznight/styles/header.css">
    <link rel="stylesheet" href="/quiznight/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <?php require_once __DIR__ . '/structure/header.php';?>

    <main class="dashboard">
        <h1 class="dashboard__title">Bienvenue <?php echo htmlspecialchars($nomUtilisateur); ?>!</h1>
        <section class="dashboard__section">
   
            <p class="dashboard__text">Votre adresse email est : <?php echo htmlspecialchars($emailUtilisateur); ?></p>
            <p class="dashboard__text">Votre ID utilisateur est : <?php echo htmlspecialchars($idUtilisateur); ?></p>
            <p>Commencez par jeter un œil vous-même :</p>
<p><a href="#" class="btn">Découvrir</a></p>


        <!------------<section class="dashboard__section">
            <a class="dashboard__logout" href="deconnexion.php">Se déconnecter</a>
        </section>-------->
    </main>

    <?php require_once __DIR__ . '/structure/footer.php'; ?>
</body>
</html>

   