<?php
session_start();

if (isset($_GET['css'])) {
    $chosenStyle = $_GET['css'];
    setcookie('selected_style', $chosenStyle, time() + (86400 * 30), "/");
    header("Location: index.php");
    exit();
}

if (isset($_COOKIE['selected_style'])) {
    $currentStyle = $_COOKIE['selected_style'];
} else {
    $currentStyle = 'style1';
}

$loggedIn = isset($_SESSION['login']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de style</title>
    <link rel="stylesheet" href="<?php echo $currentStyle; ?>.css">
</head>

<body>
    <form id="style_form" action="index.php" method="GET">
        <select name="css">
            <option value="style1" <?php if ($currentStyle == 'style1')
                echo 'selected'; ?>>style1</option>
            <option value="style2" <?php if ($currentStyle == 'style2')
                echo 'selected'; ?>>style2</option>
        </select>
        <input type="submit" value="Appliquer" />
    </form>

    <?php
    if ($loggedIn) {
        echo "<h1>Bienvenue, " . $_SESSION['login'] . " !</h1>";
        echo "<a href='logout.php'>Se déconnecter</a>";
    } else {
        echo '
        <form id="login_form" action="connected3.php" method="POST">
            <table>
                <tr>
                    <th>Login :</th>
                    <td><input type="text" name="login"></td>
                </tr>
                <tr>
                    <th>Mot de passe :</th>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="Se connecter..." /></td>
                </tr>
            </table>
        </form>';
    }
    ?>

</body>

</html>