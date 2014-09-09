<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/8/14
 * Time: 10:24 PM
 */
?>

<html>
<head>
    {<?php Assets::css(array('foundation.css', 'normalize.css')); ?>}
    { <?php Assets::js(
        array(
            'vendor/jquery.js', 'foundation/foundation.js', 'vendor/fastclick.js',
            'vendor/modernizr.js', 'vendor/placeholder.js'
        )
    ) ?>}

    <title>{$title}</title>
</head>
<body>
<div class="medium-5 medium-centered columns">
    {$content}
</div>

Testing the template I think it works
</body>
</html>

