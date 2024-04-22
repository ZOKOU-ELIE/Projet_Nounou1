<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    $destinataire = $_POST["destinataire"];

    $to = ($destinataire === "parent") ? "parent@example.com" : "nounou@example.com";

    $subject = "Nouveau message de la part de " . ucfirst($destinataire);

    // En-têtes de l'e-mail
    $headers = "eliezokou593@gmail.com\r\n";
    $headers .= "Reply-To: eliezokou593@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoyer l'e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }
}
?>
