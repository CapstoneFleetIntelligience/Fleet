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
    <?php echo link_tag('assets/css/jquery-ui.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.structure.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.theme.css'); ?>
    <?php echo script_tag('assets/js/vendor/modernizr.js'); ?>
    <?php echo script_tag('assets/js/vendor/fastclick.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery-ui.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.cookie.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.tab.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.abide.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.reveal.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.topbar.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.alert.js'); ?>
    <title><?php echo $title ?></title>
</head>

<body>
	<div class="sticky">
		<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large"> 
			<ul class="title-area"> 
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone --> 
				<li class="toggle-topbar"></li> 
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

<div class="row header">
    <div class="small-6 medium-6 large-8 columns">
        <h1>Fleet Intelligence</h1>
	</div>
	<div class="row">
		<div class="small-4 columns">
			<?php $role = $this->session->userdata('role');
					if(!($role)) {
                        echo anchor('', 'Register', array('class' => 'button',
                                                          'data-reveal-id' => 'registrationModal'));
                        echo anchor('', 'Log In', array('class' => 'button', 'data-reveal-id' => 'loginModal', ));
                    }
					else echo anchor('logout', 'Log Out', array('class' => 'button'));

			?>
		</div>
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
    <div id="loginModal" class="reveal-modal" data-reveal>
        <?php $this->load->view('login'); ?>
    </div>
    <div id="registrationModal" class="reveal-modal xlarge" data-reveal>
        <?php $this->load->view('registration'); ?>
    </div>
	
</body>
</html>
	
