<?php
//Stockage des informations pour l'utilisateur connecté
session_start();

//Vérification si le formulaire a été soumis et si les clés existent dans $_POST
if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["EMAIL"]) && isset($_POST["MOT_DE_PASSE"]) && isset($_POST["ROLE"])) {

    //Récupérer les données du formulaire
    $email = $_POST["EMAIL"];
    $mot_de_passe = $_POST["MOT_DE_PASSE"];
    $role = $_POST["ROLE"];

    //Connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "";
    $database = "nounou";

    //Création à la base de données

    $conn = new mysqli ($serveur, $utilisateur, $mot_de_passe, $database);

    //Vérification de la connexion
    if ($conn -> connect_error) {
        die "la connexion a echouée" . $conn -> connect_error
    }

    //Préparation de la rêquete SQL pour récupérer l'utilisateur en fonction de l'email et du mot de passe
    $sql = "SELECT * FROM utilisateur WHERE EMAIL = '$email' AND MOT_DE_PASSE = '$mot_de_passe' AND ROLE = '$role'";

    //Exécution de la rêquete SQL
    $resultat = $conn -> query($sql);

    //Vérification de l'existence de l'utilisateur dans la base de données
    if ($resultat -> num_rows > 0) {
        //Utilisateur trouvé, enregistrement de ses informations
        $_SESSION["EMAIL"] = $email;
        $_SESSION["MOT_DE_PASSE"] = $mot_de_passe;

        //Rédirection de l'utilisateur en fonction de son rôle
        if ($role == "parent") {
            header("Location: parents.html");
            exit(); 
        } else if ($role == "nounou") {   
            header("Location: emploi.html");
            exit();
        }
    } else {
        echo "Email ou Mot de passe incorrect.";
    }

    $conn -> close();
} else {
    echo "Des champs manquent.";
}
?>