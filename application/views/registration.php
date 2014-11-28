
<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */
?>

<div class="row">

		<div class="row">
			<div class="small-10 medium-12 large-12 columns">
				<fieldset>
					<legend>Please fill-out the following fields</legend>
                    <?php echo form_open('registration', 'data-abide id="registration_form"'); ?>
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<div class="name-field">
									<label>Business Name
										<input type="text" placeholder="Required" required pattern="[a-zA-Z]+" name="name">
									</label>
									<small class="error">A business name is required.</small>
								</div>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Business Address
									<input type="text" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="baddress">
								</label>
								<small class="error">A business address is required.</small>
							</div>
						</div>
						
						<div class="row">
							<div class="small-4 medium-5 large-6 columns">
								<label>Business Phone Number
									<input type="text" placeholder="Required" required pattern="[0-9]+" name="bphone">
								</label>
								<small class="error">A business phone number is required.</small>
							</div>
							<div class="small-2 medium-3 large-3 columns">
								<label>Max Delivery Range
									<input type="text" placeholder="Required" required pattern="[1-9]+" name="radius">
								</label>
								<small class="error">A deliver range is required.</small>
							</div>
							<div class="small-4 medium-4 large-3 columns">
								<label>Max Items Allowed to Deliver
									<input type="text" placeholder="Required" required pattern="[1-9]+" name="capacity">
								</label>
								<small class="error">The capacity amount is required.</small>
							</div>
						</div>
						
						<div class="row">
							<div class="small-8 small-centered columns">
								<label>Default Business Password
									<input type="password" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="dpass">
								</label>
								<small class="error">A default business password is required.</small>
							</div>
						</div>
						
						<br />
						<hr />
						<br />
						
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<label>Manager Name
									<input type="text" placeholder="Required" required pattern="[a-zA-Z]+" name="uname">
								</label>
								<small class="error">A manager name is required and must be a string.</small>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Email
									<input type="text" placeholder="Required" required name="email">
								</label>
								<small class="error">An email address is required.</small>
							</div>
						</div>
						
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<label>Create Password
									<input type="password" placeholder="Required" required pattern="[a-zA-Z0-9]+" name="pass">
								</label>
								<small class="error">A password is required.</small>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Phone
									<input type="text" placeholder="Required" required pattern="[0-9]+" name="uphone">
								</label>
								<small class="error">A phone number is required.</small>
							</div>
						</div>
                    <button type="submit" id="register_user" class="button radius small">Continue</button>
				</fieldset>
			</div>
		</div>
    <?php echo form_close(); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>

