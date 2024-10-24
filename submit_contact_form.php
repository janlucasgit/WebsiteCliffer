<?php

header('Content-Type: application/json');

$response = [];

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $empfaenger = 'ziel@email.com';
    $betreff = 'Neue Nachricht von Cliffer Kontaktformular';
    $absender_email = $_POST['email'];
    $absender_name = $_POST['name'];
    $nachricht = $_POST['message'];

    $mailinhalt = "Absender: $absender_name <$absender_email>\n\n";
    $mailinhalt .= "Nachricht:\n$nachricht";

    $mailgesendet = mail($empfaenger, $betreff, $mailinhalt);

    if ($mailgesendet) {
        $response['status'] = 'success';
        $response['message'] = 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Beim Senden der Nachricht ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Bitte füllen Sie alle Felder aus.';
}

echo json_encode($response);

?>
