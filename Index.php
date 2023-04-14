<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="./main.js"></script>
    <title>Musée - Gestion visiteurs</title>
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


            <li class="account">
                <a href="./directrice/login.php">
                    <span class="material-symbols-outlined"> Account_Circle </span>
                    Compte directrice
                </a>
            </li>

            <li class="logout">
                <a href="./directrice/login.php">
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
            <h1>Bienvenue sur le</h1>
            <h1><span>Dashboard</span></h1>
        </section>
        <section id="add_del">
            <div class="container-left">
                <div class="content">
                    <h2>Nouveau visiteur</h2>
                    <form method="post">
                        Nom*
                        <input class="button1" name="nom" placeholder="Saisir un nom" required="" type="text" />
                        Prénon*
                        <input class="button1" name="prenom" placeholder="Saisir un prenom" required="" type="text" />
                        Type de ticket*
                        <div class="ticket">
                            <label>
                                <input type="checkbox" name="tickets[]" value="Temporaire" />
                                <span class="hoverable-text">Temporaire</span>
                            </label>

                            <label>
                                <input type="checkbox" name="tickets[]" value="Permanent" />
                                <span class="hoverable-text">Permanent</span>
                            </label>
                        </div>

                        <input class="send" name="submit_add" type="submit" value="Ajouter" />
                    </form><?php
				                $sqlHost = 'localhost';
                                $sqlUser = 'u952339516_admin_musee';
                                $sqlPassword = 'i$3T^FJ?ExA!';
                                $dbName = 'u952339516_musee';
                                 
                                $bdd = new PDO('mysql:host='.$sqlHost.';dbname='.$dbName.';charset=utf8',$sqlUser,$sqlPassword);
                                
                                
				                // Vérification de la connexion (si la connexion échoue, message d'erreur)
				                if (!$bdd) {
				                    die("Connexion échouée : " . mysqli_connect_error());
				                }
                                    // Vérification que les champs du formulaire ne sont pas vides sinon message d'erreur
				                    else{    
				                        if ((empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['tickets'])) && isset($_POST['submit_add'])) {
				                        echo '<div id="message_erreur" style="text-align:center; color:red;">Erreur : veuillez cocher le type de ticket !</div>';
				                        echo '<script>setTimeout(function(){ document.getElementById("message_erreur").style.display = "none"; }, 3000);</script>';
				                        mysqli_close($conn);  
				                        }

                                        // Vérification que le nombre de visiteurs dans le musée n'est pas déjà supérieur ou égal à 50 sinon message d'erreur
				                        $sql_total = "SELECT COUNT(*) as count_total FROM utilisateurs";
				                        $result_total = mysqli_query($conn, $sql_total);
				                        $row_total = mysqli_fetch_assoc($result_total);
				                        $count_total = $row_total["count_total"];
				                        if (isset($_POST["submit_add"]) && $count_total>=50) {
				                            echo '<div id="msg_error_50" style="text-align:center; color:red;">Désolé, vous avez atteint le nombre maximal de visiteurs autorisés !</div>';
				                            echo '<script>setTimeout(function(){ document.getElementById("msg_error_50").style.display = "none"; }, 3000);</script>'; 
				                        } 
				                              
				                        elseif (isset($_POST["submit_add"])){
				                            $nom = $_POST["nom"];
				                            $prenom = $_POST["prenom"];
				                            $ticket = implode(" et ", $_POST["tickets"]); 
				                            // Insérez les données dans la base de données
				                            $sql = "INSERT INTO utilisateurs (nom, prenom, ticket, heure_come) VALUES ('$nom', '$prenom', '$ticket', NOW())";
				                            // Exécution de la requête SQL
				                            mysqli_query($conn, $sql);
				                            // Fermeture de la connexion SQL
				                            mysqli_close($conn);  
				                        }
				                    }    
				                ?>
                </div>
            </div>
            <div class="container-right">
                <div class="content">
                    <h2>Supprimer visiteur</h2>
                    <form action="" method="post" style="display: flex; flex-direction: column; gap: 1em">
                        <select name="id" size="8"> <?php
						                        // Informations de connexion à la base de données
                                                $servername = "127.0.0.1:3306";
                                                $username = "u952339516_musee";
                                                $password = "v#cku7vHWd5!";
                                                $dbname = "u952339516_musee";
						                        $conn = mysqli_connect($servername, $username, $password, $dbname);

						                       /// Vérification de la connexion (si la connexion échoue, message d'erreur)
						                        if (!$conn) {
						                            die("Erreur : " . mysqli_connect_error());
						                        }

						                        // Traitement du formulaire de suppression
						                        if (($_POST["submit_del"])) {
						                            // Récupération de l'ID de l'utilisateur à supprimer
						                            $id = $_POST["id"];

                                                    // Récupération de l'heure à laquelle le visiteur est suprimé
						                            $sql1 ="UPDATE utilisateurs SET heure_leave=NOW()";

						                            //Déplace les données dans la table utilisateurs_archive pour réaliser les stats plus tard
						                            $sql2 = "INSERT INTO utilisateurs_archive (id, nom, prenom, ticket, heure_come, heure_leave) SELECT id, nom, prenom, ticket, heure_come, heure_leave  FROM utilisateurs WHERE id = $id";
						                            mysqli_query($conn, $sql1);
						                            mysqli_query($conn, $sql2);

						                            // Suppression des données dans la première table
						                            $sql3 = "DELETE FROM utilisateurs WHERE id = $id";
						                            mysqli_query($conn, $sql3);
						                        }

						                        // Récupération des utilisateurs depuis la base de données
						                        $sql4 = "SELECT id, nom, prenom FROM utilisateurs ORDER BY nom";
						                        $result = mysqli_query($conn, $sql4);
						                        while ($row = mysqli_fetch_assoc($result)) {
						                            // Affichage des utilisateurs dans la liste déroulante de la section supprimer
						                            echo '<option value="' . $row["id"] . '">'. '#' . $row["id"] . ' ' . $row["nom"] . ' ' . $row["prenom"] . '</option>';
						                        } 
						                        ?></select>
                        <input class="del" name="submit_del" type="submit" value="Supprimer" />
                    </form>
                </div>
            </div>
        </section>
        <hr />
        <section id="exist">
            <div class="content">
                <h2>Visiteurs présent dans le musée</h2>
                <p>Nombre total de visiteurs présent dans le musée : <?php
                        //Affiche le nombre d'utilisateur dans le musée
			            $sql_total = "SELECT COUNT(*) as count_total FROM utilisateurs";
			            $result_total = mysqli_query($conn, $sql_total);
			            $row_total = mysqli_fetch_assoc($result_total);
			            $count_total = $row_total["count_total"];
			            echo $count_total; ?></p>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Type de ticket</th>
                        <th>Date/heure d'arrivée</th>
                    </tr>
                    <?php
				                $sql = "SELECT * FROM utilisateurs";
				                $result = mysqli_query($conn, $sql);
				                while ($row = mysqli_fetch_assoc($result)) {
				                    echo "<tr><td>" . '#' . $row["id"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["ticket"] . "</td><td>" . $row["heure_come"] . "</td></tr>";
				                }
				                // Fermeture de la connexion SQL
				                mysqli_close($conn);
				                ?>
                </table>
            </div>
        </section>
        <footer>Copyright © 2023 JEX-NL. All Rights Reserved</footer>
    </main>
</body>

</html>