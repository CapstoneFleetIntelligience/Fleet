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
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY">
    </script>

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
        <?php $role = $this->session->userdata('role');
        //var_dump($role);
                if(!($role))
                {
                    echo anchor('registration', 'please register', array('class' => 'right'));
                    echo anchor('login', 'Log in', array('class' => 'button small radius right'));
                }
                else
                {
                    echo anchor('logout', 'logout', array('class' => 'button small radius right'));
                }

        ?>
    </div>
</div>
<div class="row">
    <dl class="small-12 tabs text-center" data-options="sticky_on: large" data-tab>
        <?php
                switch ($role)
                {
                    case 'E':
                        echo '<dd class="active">'.anchor('employH', 'Home').'</dd>';
                        echo '<dd>'.anchor('employD', 'Data').'</dd>';
                        echo '<dd>'.anchor('employE', 'Edit').'</dd>';
                        break;
                    case 'M':
                        echo '<dd class="active">'. anchor('adminH', 'Home').'</dd>';
                        echo '<dd>'.anchor('analytics', 'Analytics').'</dd>';
                        echo '<dd>'.anchor('manE', 'Edit');
                        break;
                    case 'A':
                        echo '<dd class="active">'. anchor('adminH', 'Home').'</dd>';
                        echo '<dd>'.anchor('analytics', 'Analytics').'</dd>';
                        echo '<dd>'.anchor('adminE', 'Edit').'</dd>';
                        break;
                    default:
                        break;
                }
        ?>
            </dl>
</div>

