<?php
header('Content-Type: application/json');
$file = 'data.json';

if (!file_exists($file)) {
    file_put_contents($file, json_encode(['likes' => 0, 'comments' => []]));
}

$data = json_decode(file_get_contents($file), true);

// Sécurité : s'assurer que 'comments' est toujours un array
if (!isset($data['comments'])) { $data['comments'] = []; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action'])) {
        if ($input['action'] === 'like') {
            $data['likes']++;
        } elseif ($input['action'] === 'comment' && !empty($input['name']) && !empty($input['text'])) {
            $newComment = [
                'name' => htmlspecialchars(substr($input['name'], 0, 50)),
                'text' => htmlspecialchars(substr($input['text'], 0, 300)),
                'date' => date('d/m/Y')
            ];
            array_unshift($data['comments'], $newComment);
        }
        file_put_contents($file, json_encode($data));
    }
}
echo json_encode($data);
?>