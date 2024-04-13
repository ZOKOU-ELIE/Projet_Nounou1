<?php
// Vérification si le formulaire a été soumis 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérification si les champs sont remplis
    if (isset($_POST["NOM"]) && isset($_POST["PRENOM"]) && isset($_POST["DATE_DE_NAISSANCE"]) && isset($_POST["ALLERGIES"]) && isset($_POST["BESOINS_SPECIAUX"])) {
        
        // Récupération des données du formulaire
        $nom = $_POST["NOM"];
        $prenom = $_POST["PRENOM"];
        $date_naissance = $_POST["DATE_DE_NAISSANCE"];
        $allergies = $_POST["ALLERGIES"];
        $besoins_speciaux = $_POST["BESOINS_SPECIAUX"];

        // Validation pour la date de naissance
        if (strtotime($date_naissance) === false) {
            echo "La date de naissance n'est pas valide";
            exit; // Arrêt automatique du script si la date n'est pas valide
        
        }

        // Vérification si les champs ne sont pas vides
        if (!empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($allergies) && !empty($besoins_speciaux)) {

            // Connexion à la base de données
            $serveur = "localhost";
            $utilisateur = "root";
            $mot_de_passe = "";
            $database = "nounou";

            // Création de la connexion
            $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $database);

            // Vérification de la connexion
            if ($conn -> connect_error) {
                die("La connexion a échouée :" . $conn -> connect_error); 
            }

            // Préparation de la requête SQL pour insérer les données dans la base de données
            $sql = "INSERT INTO enfants (NOM, PRENOM, DATE_NAISSANCE, ALLERGIES, BESOINS_SPECIAUX) VALUES ('$nom', '$prenom', '$date_naissance', '$allergies', '$besoins_speciaux')";

            // Exécution de la requête SQL
            if ($conn -> query($sql) === TRUE) {
                echo "Informations enregistrées avec succès";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn -> error;
            }

            // Fermer la connexion à la base de données
            $conn -> close();
        } else {
            echo "Tous les champs doivent être remplis.";
        }    
    } else {
        echo "Des champs manquent.";
    }
}
?>
