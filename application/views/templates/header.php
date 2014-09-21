<?php
/**
 * Created by PhpStorm.
 * User: Clifford
 * Date: 9/17/14
 * Time: 9:32 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php Assets::css(array('foundation.css', 'normalize.css', 'main.css')); ?>
    <?php Assets::js(array('vendor/jquery.js', 'foundation/foundation.js', 'foundation/topbar.js',
                           'vendor/fastclick.js',
                           'vendor/modernizr.js', 'vendor/placeholder.js')) ?>
    <title><?php echo $title ?></title>
</head>
<body>
    <div class = "row header">
         <div class="small-12 columns">
                <h1 class="center">
                    Welcome to Fleet Intelligience <a href="#" class="button small radius right">Log in</a>
                </h1>
         </div>      
    </div>
