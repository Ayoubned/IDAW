<?php
require_once("template_header.php");
require_once("template_menu.php");
$currentPageId = 'accueil';
$currentLang = 'eng';
if (isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
}
if (isset($_GET['lang'])) {
        $currentLang = $_GET['lang'];
}
?>
<header class="header">
        <h1>My Pro WebSite !</h1>
        <img src="person.jpg" alt="Person Photo" class="profile-photo">


        <div class="lang-switch">
                <a href="index.php?page=<?php echo $currentPageId; ?>&lang=eng" class="lang-btn">EN</a>
                <a href="index.php?page=<?php echo $currentPageId; ?>&lang=fr" class="lang-btn">FR</a>
        </div>


</header>

<section class="main-content">
        <?php
        renderMenuToHTML($currentPageId, $currentLang);
        ?>
        <?php
        $pageToInclude = $currentLang . '/' . $currentPageId . '.php';
        if (is_readable($pageToInclude))
                require_once($pageToInclude);
        else
                require_once("error.php");
        ?>
</section>
<?php
require_once("template_footer.php");
?>