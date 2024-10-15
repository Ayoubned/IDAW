<?php
require_once('config.php');

$connectionString = "mysql:host=" . _MYSQL_HOST;
if (defined('_MYSQL_PORT')) {
    $connectionString .= ";port=" . _MYSQL_PORT;
}
$connectionString .= ";dbname=" . _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$pdo = NULL;

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle Create/Update form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        
        // Check if we are in 'Update' mode (form includes hidden 'id' field)
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update existing user
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);
        } else {
            // Create new user
            $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->execute([$name, $email]);
        }
    }

    // Handle Delete request (with GET method)
    if (isset($_GET['delete_id'])) {
        $id = (int)$_GET['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Fetch all users for display
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Unset the $user variable to prevent form from using last fetched user
if (!isset($_GET['edit_id'])) {
    unset($user);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
</head>
<body>

<h2>Liste des Utilisateurs</h2>

<table border="1">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php if ($users): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->name) ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td>
                    <!-- Link to populate form with user data for editing -->
                    <a href="crud_users.php?edit_id=<?= $user->id ?>">Modifier</a> |
                    <!-- Delete button -->
                    <a href="crud_users.php?delete_id=<?= $user->id ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach;unset($user); ?>
    <?php else: ?>
        <tr><td colspan="3">Aucun utilisateur trouvé.</td></tr>
    <?php endif; ?>
</table>

<!-- Add New User Button -->
<button onclick="window.location.href='crud_users.php'">Ajouter Utilisateur</button>

<h2><?= isset($_GET['edit_id']) ? 'Modifier Utilisateur' : 'Ajouter Utilisateur' ?></h2>

<!-- Form to add/update a user -->
<form method="POST" action="crud_users.php">
    <?php
    // Check if we are editing a user
    if (isset($_GET['edit_id'])) {
        $edit_id = (int)$_GET['edit_id'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$edit_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
    }
    ?>
    <?php if (isset($user)): ?>
        <!-- Hidden field for user ID (only present when editing) -->
        <input type="hidden" name="id" value="<?= $user->id ?>">
    <?php endif; ?>
    <label for="name">Nom:</label>
    <input type="text" name="name" value="<?= isset($user) ? htmlspecialchars($user->name) : '' ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= isset($user) ? htmlspecialchars($user->email) : '' ?>" required>
    <br>
    <input type="submit" value="<?= isset($user) ? 'Mettre à jour' : 'Ajouter' ?>">
</form>

</body>
</html>

<?php
// Close the database connection
$pdo = null;
?>
