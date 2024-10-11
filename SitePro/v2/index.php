<?php
require_once('template_header.php');
?>
<body>
    <div class="header">
        <h1>My Pro WebSite !</h1>
        <img src="person.jpg" alt="Person Photo" class="profile-photo">
    </div>

    <div class="main-content">
    <?php
require_once('template_menu.php');
renderMenuToHTML('index');

?>

        <div class="content">
            <h1>Welcome to My Professional Website!</h1>
            <br>
            <p>Hello! I'm Ayoub, a passionate software engineering student at IMT Nord Europe. This website is a glimpse into my world as a developer, where I showcase my skills, projects, and experiences.</p>
            <p>Feel free to explore my portfolio, learn about my academic journey, and connect with me. Whether you're interested in collaborating on a project or just want to discuss technology, I'm always open to new opportunities.</p>
            <p>Thank you for visiting, and I hope you enjoy your time here!</p>
        </div>
    </div>
    <?php
require_once('template_footer.php');
?>
   
</body>
</html>