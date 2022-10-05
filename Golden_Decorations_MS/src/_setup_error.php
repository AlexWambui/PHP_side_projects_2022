<?php
include_once "include/functions.php";
include_once "include/html_templates.php";
start_html("App Settings"); 
?>
<section class="container setup_error_container">
    <div class="setup_error">
        <h1>Something's Not Right.</h1>
        <p>Try Contacting the Admin!!!</p>
        <p>or restart the application!!!</p>
        <a href="../index.php">Restart Application</a>
    </div>
</section>
<?php end_html() ?>