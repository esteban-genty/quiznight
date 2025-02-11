<?php 



?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device,initiale-scale=1.0">
    <title>QuizNight</title>
   <!------------Google Fonts---------------->
   <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    
   <!------------Styles Css---------------->
    <link rel="stylesheet" href="styles/connexion.css">
</head>
<body>

<main>

        <img src="assets/quiznight.png" alt="logo">
        
       
        <h1>Connexion</h1>
        <section class="formsection">
            
            <form action="" method="post">
           
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>

                <div id="buttonbox">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
        </section>

       
    </main>
</body>
</html>