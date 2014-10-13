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


<div class="container">
	<div class="row">
		<?php
			echo form_open('authenticate');
			echo form_fieldset('Login');
		?>
			<div class="small-8">
				<span class="prefix">
					userid
				</span>
				<?php
					echo form_input($uname);
				?>
			</div>
			<div class="small-8">
				<span class="prefix">
					password
				</span>
				<?php
					echo form_password($pass);
				?>
			</div>

		<?php
			echo form_fieldset_close();
			echo form_submit('', 'login', array('class' => 'button small'));
		?>
	</div>
</div>


<div class="row">
	<form>
		<div class="row">
			<div class="small-10 large-12 columns">
				<fieldset>
					<legend>Login</legend>
					
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix">User ID</span>
						</div>
						<div class="small-10 columns">
							<input type="text" name="uname">
						</div>
					</div>
					
					<div class="row collapse">
						<div class="small-2 columns">
							<span class="prefix">Password</span>
						</div>
						<div class="small-10 columns">
							<input type="text" name="pass">
						</div>
					</div>
					
				</fieldset>
				
				<br />
				<div class="small-3 columns">
					<a role="button" aria-label="submit form" tabindex="0" class="button">Submit</a>
				</div>
			</div>
		</div>
	</form>
</div>