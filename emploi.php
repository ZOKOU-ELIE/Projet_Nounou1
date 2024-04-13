<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["DATE"]) && isset($_POST["EMAIL"]) && isset($_POST["HEURE_DEBUT"]) && isset($_POST["HEURE_FIN"])) {

        $date = $_POST["DATE"];
        $email = $_POST["EMAIL"];
        $heure_debut = $_POST["HEURE_DEBUT"];
        $heure_fin = $_POST["HEURE_FIN"];

        if (!empty($date) && !empty($email) && !empty($heure_debut) && !empty($heure_fin)) {

            $serveur = "localhost";
            $utilisateur = "root";
            $mot_de_passe = "";
            $database = "nounou";

            $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $database);

            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            $sql = "INSERT INTO emploidutemps (DATE, EMAIL, HEURE_DEBUT, HEURE_FIN) VALUES ('$date', '$email', '$heure_debut', '$heure_fin')";

            if ($conn->query($sql) === TRUE) {
                echo "Informations enregistrées avec succès.";
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
