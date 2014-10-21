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
						<div class="small-10 medium-12 large-12 columns">
							<label>User ID
								<input type="text" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="uname">
							</label>
							<small class="error">Please enter an User ID.</small>
						</div>
					</div>
					
					<div class="row collapse">
						<div class="small-10 medium-12 large-12 columns">
							<label>Password
								<input type="password" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="pass">
							</label>
							<small class="error">Please enter a password.</small>
						</div>
					</div>
					
				</fieldset>
				
				<br />
				
				<button type="submit">Submit</a>
				
				<br />
			
			</div>
		</div>
	<?php form_close(); ?>
</div>