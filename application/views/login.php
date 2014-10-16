<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/30/14
 * Time: 9:46 PM
 */
$uname = array(
    'name' => 'uname',
    'class' => 'small-3 columns'
);
$pass = array(
    'name' => 'pass',
    'class' => 'small-3 columns'
)
?>

<div class="row">
	<?php echo form_open('authenticate', 'data-abide'); ?>
		<div class="row">
			<div class="small-10 large-12 columns">
				<fieldset>
					<legend>Login</legend>
					
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix">User ID</span>
						</div>
						<div class="small-10 columns">
							<input type="text" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="uname">
						</div>
					</div>
					
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix">Password</span>
						</div>
						<div class="password-field">
							<div class="small-10 columns">
								<input type="password" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="pass">
							</div>
						</div>
					</div>
					
				</fieldset>
				
				<br />
				<div class="row">
					<div class="small-3 columns">
						<a role="button" aria-label="submit form" class="button">Submit</a>
					</div>
				</div>
			</div>
		</div>
	<?php form_close(); ?>
</div>