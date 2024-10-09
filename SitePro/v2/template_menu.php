<?php
function renderMenuToHTML($currentPageId) {
    $mymenu = array(
        'index' => array('Home'),
        'cv' => array('CV'),
        'projets' => array('Projects')
    );
    
    echo '<nav class="menu">';
    echo '<ul>';
    foreach  ($mymenu as $pageId => $pageName) {
        if ($pageId == $currentPageId) {
            echo '<li><a href="' . $pageId . '.php" class="active">'. $pageName[0] . '</a></li>';
        } else {
            echo '<li><a href="' . $pageId . '.php">' . $pageName[0] . '</a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}?>