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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY">
    </script>

    <?php echo link_tag('assets/css/foundation.css'); ?>
    <?php echo link_tag('assets/css/normalize.css'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.js'); ?>
    <?php echo script_tag('assets/js/vendor/modernizr.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.cookie.js'); ?>
    <?php echo script_tag('assets/js/vendor/fastclick.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.tab.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.abide.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.reveal.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.topbar.js'); ?>
    <?php //echo script_tag('assets/js/maps.google.polygon.containsLatLng.js'); ?>
    <title><?php echo $title ?></title>
</head>

<body>
<<<<<<< HEAD
	<div class="sticky">
		<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large"> 
			<ul class="title-area"> 
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone --> 
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li> 
			</ul> 
			<section class="top-bar-section"> 
				<!-- Left Nav Section --> 
				<ul class="left"> 
					<li><?php echo anchor('adminH', 'Home'); ?></li>
					<li><?php echo anchor('analytics', 'Analytics') ?></li>
					<li><?php echo anchor('adminE', 'Edit')?></li> 
					
				</ul>
			</section>
		</nav>
	</div>

	<br />
=======
<div class="row header">
    <div class="small-6 columns">
        <h1 class="center">
            Welcome to Fleet Intelligence
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
                        echo '<dd class="active">'.anchor('overview', 'Home').'</dd>';
                        echo '<dd>'.anchor('assignments', 'Route Assignment').'</dd>';
                        echo '<dd>'.anchor('contact', 'contact').'</dd>';
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
>>>>>>> c136a5e84a065c9eb75cd08765111268e93d69b4

	<div class="row header">
		<div class="small-4 medium-6 large-6 columns">
			<h1>Fleet Intelligence</h1>
		</div>
		<div class="small-5 columns">
			<ul class="button-group right">
				<li><?php echo anchor('login', 'Log In', array('class' => 'button')) ?></li>
				<li><?php echo anchor('registration', 'Register', array('class' => 'button')) ?></li>
			</ul>
		</div>
	</div>
	
	<!--
	<div class="row">
		<dl class="small-12 tabs text-center" data-options="sticky_on: large" data-tab>
					<dd class="active"><?php echo anchor('adminH', 'Home'); ?></dd>
					<dd><?php echo anchor('analytics', 'Analytics') ?></dd>
					<dd><?php echo anchor('adminE', 'Edit')?></dd>
		</dl>
	</div>
	//-->
	
</body>
</html>
	
