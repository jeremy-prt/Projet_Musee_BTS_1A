<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../directrice/style_login.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="../main.js"></script>
    <title>Musée - Gestion visiteurs Administrateur</title>
</head>

<body>
    <!-- SIDEBAR -->
    <div id="sidebar">
        <div class="title">
            <span class="material-symbols-outlined"> admin_panel_settings </span>
            <h3>Panel de contrôle</h3>
        </div>
        <ul>
            <li>
                <a href="#">
                    <span class="material-symbols-outlined"> dashboard </span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-outlined"> Add </span>
                    Ajouter un visiteur
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-outlined"> Remove </span>
                    Supprimer un visiteur
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-outlined"> List </span>
                    Liste des visiteurs
                </a>
            </li>

            <li class="account">
                <a href="../Index.php">
                    <span class="material-symbols-outlined"> Account_Circle </span>
                    Compte accueil
                </a>
            </li>

            <li class="logout">
                <a href="#">
                    <span class="material-symbols-outlined"> Logout </span>
                    Se déconnecter
                </a>
            </li>
        </ul>
    </div>
    <!-- HEADER -->
    <header>
        <label class="menu-hamburger" onclick="toggleSidebar()">
            <span class="material-symbols-outlined"> menu </span>
            <span>Menu</span>
        </label>
        <div class="switch-mode">
            <button class="switch-mode" onclick="toggleTheme()">
                <div id="switch" class="switch-left"></div>
            </button>
        </div>
    </header>
    <main>
        <section id="title">
            <h1>Veuillez vous</h1>
            <h1><span>identifier</span></h1>
        </section>
        <section id="formulaire">
            <!-- formulaire de login -->
            <div class="content">
                <h2>Connexion</h2>
                <form method="post" action="">
                    <label for="username">Identifiant*</label>
                    <input type="text" id="username" name="username" placeholder="Saisir un identifiant" required>
                    <label for="password">Mot de passe*</label>
                    <input type="password" id="password" name="password" placeholder="Saisir un mot de passe" required>
                    <input type="submit" name="submit" value="Se connecter" class="send">
                </form>
                <?php
        session_start(); // démarrer la session

        if (isset($_POST['submit'])) { // si le formulaire a été envoyé 
            $username = "test";
            $password = "test"; 

            if ($_POST['username'] == $username && $_POST['password'] == $password) { // si l'identifiant et le mot de passe sont corrects
                $_SESSION['username'] = $username; // stocker l'identifiant dans la session
                header('Location: index_directrice.php'); // rediriger vers l'autre page
            } else { // sinon afficher un message d'erreur
                echo '<div id="msg_error_50" style="text-align:center; color:red;">Identifiant ou mot de passe incorect.</div>';
            }
        }
        ?>

            </div>
        </section>
        <footer>Copyright © 2023 JEX-NL. All Rights Reserved</footer>
    </main>
</body>