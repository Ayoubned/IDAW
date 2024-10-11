<?php
if (isset($_GET['login']) && isset($_GET['password'])) {
    $login = $_GET['login']; 
    $password = $_GET['password']; 
    
    if (!empty($login) && !empty($password)) {
        echo "<h1>Bienvenue, $login!</h1>";
        echo "<p>Vous êtes maintenant connecté.</p>";
        echo "<p>Votre mot de pass est: $password</p>";
    } else {
        echo "<h1>Erreur</h1>";
        echo "<p>Veuillez fournir à la fois un login et un mot de passe.</p>";
    }
} else {
    echo "<h1>Erreur</h1>";
    echo "<p>Aucune donnée soumise.</p>";
}
?>
