<?php
session_start();
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password']; 

    if ($login === 'admin' && $password === 'password') {
        $_SESSION['login'] = $login;
        
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Identifiants incorrects. Veuillez <a href='index.php'>réessayer</a>.</p>";
        
    }
}
?>
