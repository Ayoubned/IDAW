<?php
require_once("init_pdo.php"); 

function get_users($db)
{
    $sql = "SELECT * FROM users";
    $exe = $db->query($sql);
    $res = $exe->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function create_user($db, $data)
{
    $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$data['name'], $data['email']]);
    return $db->lastInsertId(); 
}
function update_user($db, $id, $data)
{
    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$data['name'], $data['email'], $id]);
}

function delete_user($db, $id)
{
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$id]);
}


function setHeaders()
{
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
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if (json_encode($user)=='false') {
                http_response_code(404);
                echo json_encode(["error" => "User not found"]);
                break;
            }
            echo json_encode($user);
        } else {
            $result = get_users($pdo);
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true); 
        if (isset($data['name']) && isset($data['email'])) {
            $userId = create_user($pdo, $data);
            http_response_code(201);
            echo json_encode(["id" => $userId, "name" => $data['name'], "email" => $data['email']]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input data"]);
        }
        break;
        
    case 'PUT':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = json_decode(file_get_contents('php://input'), true); 
            if (isset($data['name']) && isset($data['email'])) {
                if (update_user($pdo, $id, $data)) {
                    http_response_code(200); 
                    echo json_encode(["id" => $id, "name" => $data['name'], "email" => $data['email']]);
                } else {
                    http_response_code(500); 
                    echo json_encode(["error" => "Failed to update user"]);
                }
            } else {
                http_response_code(400); 
                echo json_encode(["error" => "Invalid input data"]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["error" => "User ID is required"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            if (delete_user($pdo, $_GET['id'])) {
                http_response_code(200);
                echo json_encode(["message" => "User deleted"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to delete user"]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["error" => "User ID is required"]);
        }
        break;

    default:
        http_response_code(405); 
        echo json_encode(["error" => "Method not allowed"]);

}
?>