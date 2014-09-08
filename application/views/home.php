<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php Assets::css(array('foundation.css', 'normalize.css')); ?>
    <?php Assets::js(array('vendor/jquery.js', 'foundation/foundation.js', 'vendor/fastclick.js', 'vendor/modernizr.js', 'vendor/placeholder.js')) ?>
    <?php
    /*  echo link_tag('/assets/css/foundation.css');
      echo link_tag('/assets/css/normalize.css');
      echo script_tag('/assets/js/foundation/foundation.js');
          echo script_tag('/assets/js/vendor/jquery.js');
          echo script_tag('/assets/js/vendor/fastclick.js');
          echo script_tag('/assets/js/vendor/modernizr.js');
          echo script_tag('/assets/js/vendor/placeholder.js');*/

    ?>
    <title>Welcome to CodeIgniter</title>
</head>
<body>


<div id="container">
    <h1>Welcome to CodeIgniter!</h1>
    <a href="#" class="button">Fire</a>

    <div id="body">
        <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

        <p>If you would like to edit this page you'll find it located at:</p>
        <code>application/views/welcome_message.php</code>

        <p>The corresponding controller for this page is found at:</p>
        <code>application/controllers/welcome.php</code>

        <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a
                href="user_guide/">User Guide</a>.</p>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>


</div>

</body>
</html>