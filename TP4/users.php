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
} catch (PDOException $erreur) {
    echo 'Erreur : ' . $erreur->getMessage();
}

$request = $pdo->prepare("SELECT * FROM users");
$request->execute();

$users = $request->fetchAll(PDO::FETCH_OBJ);

if ($users) {
    echo "<h1><strong>Users</strong></h1>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th></tr>";

    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user->name) . "</td>";
        echo "<td>" . htmlspecialchars($user->email) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No users found.";
}



$pdo = null;
?>
