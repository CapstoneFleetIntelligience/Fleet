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
    <?php echo link_tag('assets/css/main.css'); ?>
    <?php Assets::css(array('foundation.css', 'normalize.css')); ?>
    <?php Assets::js(
        array(
            'vendor/jquery.js', 'jquery.cookie.js','vendor/modernizr.js','vendor/fastclick.js','foundation/foundation.js','vendor/placeholder.js',
            'foundation/foundation.tab.js',
            'foundation/foundation.topbar.js', 'foundation/foundation.reveal.js',
             'foundation/foundation.alert.js', 'foundation/foundation.slider.js',
            'foundation/foundation.offcanvas.js'
        )
    ) ?>
    <title><?php echo $title ?></title>
</head>
<body>
<div class="row header">
    <div class="small-6 columns">
        <h1 class="center">
            Welcome to Fleet Intelligience
        </h1>
        </div>
    <div class="small-6 columns">
        <?php echo anchor('registration', 'please register', array('class' => 'right')) ?>
        <?php echo anchor(
            'login', 'Log in',
            array('class' => 'button small radius right')
        ) ?>
    </div>
</div>
<div class="row">
    <div class="contain-to-grid sticky">
        <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">Home</a></h1>
                </li>
            </ul>
            <ul class="inline-list">
                <li>
                    <a href=""></a>
                </li>
            </ul>
        </nav>
    </div>
</div>