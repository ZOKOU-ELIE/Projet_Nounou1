<?php
// Vérification si le formulaire a été soumis 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérification si les champs sont remplis
    if (isset($_POST["NOM"]) && isset($_POST["PRENOM"]) && isset($_POST["DATE_DE_NAISSANCE"]) && isset($_POST["ALLERGIES"]) && isset($_POST["BESOINS_SPECIAUX"]) && isset($_POST["ID_PARENT"])) {
        $nom = $_POST["NOM"];
        $prenom = $_POST["PRENOM"];
        $date_naissance = $_POST["DATE_DE_NAISSANCE"];
        $allergies = $_POST["ALLERGIES"];
        $besoins_speciaux = $_POST["BESOINS_SPECIAUX"];
        $id_parent = $_POST["ID_PARENT"]; // Récupération de l'ID du parent

        if (!empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($allergies) && !empty($besoins_speciaux) && !empty($id_parent)) {
            $serveur = "localhost";
            $utilisateur = "root"; 
            $mot_de_passe = "";
            $database = "nounou";
            $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $database);

            if ($conn->connect_error) {
                die("La connexion a échouée :" . $conn->connect_error);
            }

            // Validation pour la date de naissance
            if (strtotime($date_naissance) === false) {
                echo "La date de naissance n'est pas valide";
                exit; 
            }

            $sql = "INSERT INTO enfants (NOM, PRENOM, DATE_NAISSANCE, ALLERGIES, BESOINS_SPECIAUX, ID_PARENT) VALUES ('$nom', '$prenom', '$date_naissance', '$allergies', '$besoins_speciaux', '$id_parent')";

            if ($conn->query($sql) === TRUE) {
                echo "Informations enregistrées avec succès";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "Tous les champs doivent être remplis.";
        }
    } else {
        echo "Des champs manquent.";
    }
}
?>
