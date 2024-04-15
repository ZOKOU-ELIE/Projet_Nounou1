<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "votre_base_de_donnees";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des informations des enfants
$sql = "SELECT * FROM enfants";
$resultat = $connexion->query($sql);

if ($resultat->num_rows > 0) {
    // Affichage des informations dans un tableau HTML
    echo "<table>";
    echo "<tr><th>Nom</th><th>Âge</th><th>Adresse</th><th>Action</th></tr>";
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["adresse"] . "</td>";
        echo "<td><form action='postuler.php' method='post'><input type='hidden' name='id_enfant' value='" . $row["id"] . "'><button type='submit'>Postuler</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun enfant trouvé.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_enfant"])) {
        $id_enfant = $_POST["id_enfant"];

        
        $nounou_a_deja_postule = true; 

        if ($nounou_a_deja_postule) {
            echo "Cet enfant a déjà été pris en charge par une autre nounou. Vous pouvez voir les autres enfants disponibles.";
        } else {
           
            echo "Votre postulation a été enregistrée avec succès.";
        }
    } else {
        echo "L'identifiant de l'enfant non fourni.";
    }
}
?>
