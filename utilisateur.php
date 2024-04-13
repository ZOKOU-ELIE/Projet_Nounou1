<?php
//Vérification du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Vérification des champs
    if(isset($_POST["NOM"]) && isset($_POST["PRENOM"]) && isset($_POST["EMAIL"]) && isset($_POST["MOT_DE_PASSE"]) && isset($_POST["NUMERO_TELEPHONE"]) && isset($_POST["ROLE"])) {
        
    //Récupération des données du formulaire
    $nom = $_POST["NOM"];
    $prenom = $_POST["PRENOM"];
    $email = $_POST["EMAIL"];
    $mot_de_passe = $_POST["MOT_DE_PASSE"];
    $numero_telephone = $_POST["NUMERO_TELEPHONE"];
    $role = $_POST["ROLE"];

    //Connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "";
    $database = "nounou";

    //Création de la connexion
    $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $database);
    
    //Vérification de la connexion
    if ($conn -> connect_error) {
        die("la connexion a echouée :" .$conn -> connect_error);
    }

    //Préparation de la rêquete SQL
    $sql = "INSERT INTO utilisateur (NOM, PRENOM, EMAIL, MOT_DE_PASSE, NUMERO_TELEPHONE, ROLE) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe', '$numero_telephone', '$role')";


    //Exécution de la rêquete SQL
    if ($conn -> query($sql) === TRUE) {
        echo "Inscription Réussié";
    } else {
        echo "Erreur" . "<br>" . $conn -> error;
    }

    //Fermer la connexion à la base de données
    $conn -> close();
    }
}
?>
