<?php
require_once('template_header.php');
?>
<body>
    <div class="header">
        <h1>My Projects !</h1>
        <img src="person.jpg" alt="Person Photo" class="profile-photo">
    </div>

    <div class="main-content">
    <?php
require_once('template_menu.php');
renderMenuToHTML('projets');
?>

        <div class="content">
            <h1>Projects</h1>
        <br>
        <div class="project">
            <h3>Web Application</h3>
            <p>Developed and deployed a decentralized web application using Spring Boot for the backend and Angular for the frontend. Designed RESTful services and integrated a responsive user interface.</p>
            <p><strong>Technologies:</strong> Spring Boot, Angular</p>
        </div>
        <br>
            <div class="project">
                <h3>Web Application</h3>
                <p>Development of a web application dedicated to equipment lending, with complete management functionalities: adding, deleting, modifying, and displaying products.</p>
                <p><strong>Technologies:</strong> HTML, CSS, JavaScript, Bootstrap, Spring Boot</p>
            </div>
   
    <br>
            <div class="project">
                <h3>Failover System Implementation</h3>
                <p>Set up a Failover system using pfSense to ensure service continuity by configuring redundant servers and automatic connection switching. Performed reliability tests and system validation.</p>
            </div>
            
        </div>
    </div>

    <?php
require_once('template_footer.php');
?>
</body>
</html>