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
    <?php echo link_tag('assets/css/foundation.css'); ?>
    <?php echo link_tag('assets/css/normalize.css'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.js'); ?>
    <?php echo script_tag('assets/js/vendor/modernizr.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.cookie.js'); ?>
    <?php echo script_tag('assets/js/vendor/fastclick.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.tab.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.reveal.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.topbar.js'); ?>
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
    <dl class="small-12 tabs text-center" data-options="sticky_on: large" data-tab>
                <dd class="active"><?php echo anchor('adminH', 'Home'); ?></dd>
                <dd><?php echo anchor('analytics', 'Analytics') ?></dd>
                <dd><?php echo anchor('adminE', 'Edit')?></dd>
            </dl>
</div>

