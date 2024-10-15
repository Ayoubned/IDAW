<?php
require_once("init_pdo.php"); // Assuming your PDO connection is initialized here

function get_users($db) {
    $sql = "SELECT * FROM users";
    $exe = $db->query($sql);
    $res = $exe->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function create_user($db, $data) {
    $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$data['name'], $data['email']]);
    return $db->lastInsertId(); // Return the ID of the newly created user
}



function setHeaders() {
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}

setHeaders();

// =================
// Handle API Requests
// =================
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch single user
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            echo json_encode($user);
        } else {
            // Fetch all users
            $result = get_users($pdo);
            echo json_encode($result);
        }
        break;

    case 'POST':
        // Create a new user
        $data = json_decode(file_get_contents('php://input'), true); // Parse JSON input
        if (isset($data['name']) && isset($data['email'])) {
            $userId = create_user($pdo, $data);
            http_response_code(201); // Status: Created
            echo json_encode(["id" => $userId, "name" => $data['name'], "email" => $data['email']]);
        } else {
            http_response_code(400); // Status: Bad Request
            echo json_encode(["error" => "Invalid input data"]);
        }
        break;


}
?>
