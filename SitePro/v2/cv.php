<?php
require_once('template_header.php');
?>
<body>
    <div class="header">
        <h1>My CV !</h1>
        <img src="person.jpg" alt="Person Photo" class="profile-photo">
    </div>

    <div class="main-content">
    <?php
require_once('template_menu.php');
renderMenuToHTML('cv');
?>

        <div class="content">
            <h2>Ayoub Ned-El Hadj</h2>
            <p>Élève ingénieur en génie logiciel à IMT Nord Europe.</p>
            <br>
            <h3>Contact</h3>
            <p>Email: <a href="mailto:ayoub.ned.el.hadj@etu.imt-nord-europe.fr">ayoub.ned.el.hadj@etu.imt-nord-europe.fr</a></p>
            <p>Phone: +33 7 58 86 62 90</p>
            <p>Github: <a href="https://github.com/Ayoubned" target="_blank">github.com/Ayoubned</a></p>
            <p>LinkedIn: <a href="https://www.linkedin.com/in/ayoub-ned-el-hadj-961771227" target="_blank">linkedin.com/in/ayoub-ned-el-hadj</a></p>
            <br>
            <h3>Formation</h3>
            <p><strong>Diplôme ingénieur en génie logiciel </strong> - Institut Mines-Télécom (IMT Nord Europe) - Lille Douai, France</p>
            <p><strong>Classes préparatoires aux grandes écoles - TSI </strong> - CPGE Reda Slaoui, Agadir, Maroc</p>
<br>
            <h3>Compétences</h3>
            <ul>
                <li><strong>Langages de programmation:</strong> Python, Java, C</li>
                <li><strong>Front-end:</strong> HTML, CSS, JavaScript, Bootstrap, Angular</li>
                <li><strong>Back-end:</strong> Spring Boot, Django, Java EE</li>
                <li><strong>Base de données:</strong> MySQL, PostgreSQL, MongoDB, Oracle</li>
                <li><strong>Modélisation:</strong> UML</li>
            </ul>
<br>
            <h3>Langues</h3>
            <ul>
                <li>Arabe</li>
                <li>Français</li>
                <li>Anglais</li>
            </ul>
            
        </div>
    </div>

    <?php
require_once('template_footer.php');
?>
</body>
</html>