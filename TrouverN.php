<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "nounou";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des informations des nounous
$sql = "SELECT * FROM utilisateurs WHERE role = 'nounou'";
$resultat = $connexion->query($sql);

if ($resultat->num_rows > 0) {
    // Affichage des informations dans un tableau HTML
    echo "<table>";
    echo "<tr><th>NOM</th><th>PRENOM</th><th>EMAIL</th><th>Disponibilité</th><th>Action</th></tr>";
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["NOM"] . "</td>";
        echo "<td>" . $row["PRENOM"] . "</td>";
        echo "<td>" . $row["EMAIL"] . "</td>";
        echo "<td>" . $row["disponibilite"] . "</td>";
        echo "<td><button class='embaucher-btn'>Embaucher</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucune nounou trouvée.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
