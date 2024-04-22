<?php
// Vérification du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérification des champs
    if (isset($_POST["NOM"]) && isset($_POST["PRENOM"]) && !empty($_POST["EMAIL"]) && !isset($_POST["MOT_DE_PASSE"]) && isset($_POST["NUMERO_TELEPHONE"]) && isset($_POST["ROLE"])) {
        
        // Connexion à la base de données
        $serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $database = "nounou";
        $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $database);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Récupération des données du formulaire
        $nom = $_POST["NOM"];
        $prenom = $_POST["PRENOM"];
        $email = $_POST["EMAIL"];
        $mot_de_passe = $_POST["MOT_DE_PASSE"];
        $numero_telephone = $_POST["NUMERO_TELEPHONE"];
        $role = $_POST["ROLE"];

        // Préparation de la requête SQL pour l'insertion de l'utilisateur
        $sql = "INSERT INTO utilisateur (NOM, PRENOM, EMAIL, MOT_DE_PASSE, NUMERO_TELEPHONE, ROLE) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe', '$numero_telephone', '$role')";

        // Exécution de la requête SQL pour l'insertion de l'utilisateur
        if ($conn->query($sql) === TRUE) {
            // Récupération de l'identifiant de l'utilisateur
            $user_id = $conn->insert_id;

            // Redirection en fonction du rôle de l'utilisateur
            if ($role === "parent") {
                // Redirection vers la page d'enregistrement de l'enfant avec l'identifiant du parent comme paramètre
                header("Location: enfant.php?parent_id=$user_id");
                exit(); // Assure que le script s'arrête ici pour la redirection
            } elseif ($role === "nounou") {
                // Redirection vers la page d'enregistrement de l'emploi du temps avec l'identifiant de la nounou comme paramètre
                header("Location: emploi.php?nounou_id=$user_id");
                exit(); // Assure que le script s'arrête ici pour la redirection
            }
        } else {
            echo "Erreur : " . "<br>" . $conn->error;
        }

        // Fermer la connexion à la base de données
        $conn->close();
    }
}
?>
