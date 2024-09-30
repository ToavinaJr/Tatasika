<?php
header('Content-Type: application/json');

// Votre logique ici pour générer les données
$data = [
    'message' => 'Bonjour du serveur',
    'timestamp' => time()
];

// Encodez les données en JSON et renvoyez-les
echo json_encode($data);
exit;
?>
