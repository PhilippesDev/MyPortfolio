<?php
header('Content-Type: application/json');
$file = 'contacts.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $nom = htmlspecialchars(trim($input['nom'] ?? ''));
    $prenom = htmlspecialchars(trim($input['prenom'] ?? ''));
    $object = htmlspecialchars(trim($input['object'] ?? ''));
    $message = htmlspecialchars(trim($input['message'] ?? ''));

    if (empty($nom) || empty($prenom) || empty($object) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    if (strlen($message) > 1500) {
        echo json_encode(['status' => 'error', 'message' => 'Message too long (max 1500).']);
        exit;
    }

    $current_data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $current_data[] = [
        'id' => uniqid(),
        'date' => date('Y-m-d H:i:s'),
        'sender' => "$prenom $nom",
        'subject' => $object,
        'content' => $message
    ];

    if (file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT))) {
        echo json_encode(['status' => 'success', 'message' => 'Merci ! Votre message a été transmis.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur serveur lors du stockage.']);
    }
}
?>