<?php
require_once('config.php');

try {
    $connectionString = "mysql:host=" . _MYSQL_HOST;
    if (defined('_MYSQL_PORT')) {
        $connectionString .= ";port=" . _MYSQL_PORT;
    }
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Read the SQL file
    $sqlFile = 'sql/create_db.sql';
    $sql = file_get_contents($sqlFile);

    if ($sql === false) {
        throw new Exception("Error reading SQL file");
    }

    // Execute the SQL commands to recreate the database
    $pdo->exec($sql);
    
    echo "Database created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
