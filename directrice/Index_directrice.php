<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../directrice/style_directrice.css" />
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
            <h1>Bienvenue</h1>
            <h1><span>Mme la Directrice</span></h1>
        </section>
        <section id="stats">
            <div class="content">
                <h2>Statistiques journaliers</h2>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Temps Moyen</th>
                        <th>Nombre de visiteurs</th>
                        <th>% de Permanent</th>
                        <th>% de Temporaire</th>
                        <th>% de Permanent et Temporaire</th>
                    </tr><?php


				// Informations de connexion à la base de données
				$servername = "localhost";
				$username = "root";
				$password = "root";
				$dbname = "musée";

				// Création d'une connexion à la base de données
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Vérification de la connexion (si la connexion échoue, message d'erreur)
				if (!$conn) {
				    die("Connexion échouée : " . mysqli_connect_error());
				}

				else{
                    $sql = "SELECT DATE(heure_come) AS jour, 
                    COUNT(*) AS nombre_de_visiteurs,
                    ROUND(AVG(TIME_TO_SEC(TIMEDIFF(heure_leave, heure_come)) / 60), 2) AS temps_moyen,
                    ROUND (COUNT(CASE WHEN ticket = 'Permanent' THEN 1 END) / COUNT(*) * 100,2) AS pourcentage_permanent,
                    ROUND (COUNT(CASE WHEN ticket = 'Temporaire' THEN 1 END) / COUNT(*) * 100,2) AS pourcentage_temporaire,
                    ROUND (COUNT(CASE WHEN ticket = 'Temporaire et Permanent' THEN 1 END) / COUNT(*) * 100,2) AS pourcentage_mixte
                    FROM utilisateurs_archive
                    GROUP BY jour;";
				                               
                    $result = mysqli_query($conn, $sql);
				    while ($row = mysqli_fetch_assoc($result)) {
				         echo "<tr><td>" . $row["jour"] . "</td><td>" . $row["temps_moyen"]. ' minutes' . "</td><td>" . $row["nombre_de_visiteurs"]."</td><td>" . $row["pourcentage_permanent"]."</td><td>" . $row["pourcentage_temporaire"]."</td><td>" . $row["pourcentage_mixte"]."</td></tr>";
				    }
				    // Fermeture de la connexion SQL
				    mysqli_close($conn);
				} 
				    ?>
                </table>
            </div>
        </section>
        <footer>Copyright © 2023 JEX-NL. All Rights Reserved</footer>
    </main>
</body>