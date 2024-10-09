<?php
function renderMenuToHTML($currentPageId, $currentLang)
{
    $mymenu = array(
        'accueil' => array('Home', 'Accueil'),
        'cv' => array('CV', 'CV'),
        'projets' => array('Projects', 'Projets'),
        'contact' => array('Contact Me', 'Me contacter')
    );

    echo '<nav class="menu">';
    echo '<ul>';

    foreach ($mymenu as $pageId => $pageNames) {
        $url = 'index.php?page=' . $pageId . '&lang=' . $currentLang;

        $pageName = ($currentLang == 'fr') ? $pageNames[1] : $pageNames[0];

        if ($pageId == $currentPageId) {
            echo '<li><a href="' . $url . '" class="active">' . $pageName . '</a></li>';
        } else {
            echo '<li><a href="' . $url . '">' . $pageName . '</a></li>';
        }
    }

    echo '</ul>';
    echo '</nav>';
}
?>
