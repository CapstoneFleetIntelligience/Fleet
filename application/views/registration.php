
<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */
?>

<<<<<<< HEAD

<div class="row">
	<form>
		<div class="row">
			<div class="small-10 medium-12 large-12 columns">
				<fieldset>
					<legend>Please fill-out the following fields</legend>
						
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<label>Business Name
									<input type="text" name="name">
								</label>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Business Address
									<input type="text" name="baddress">
								</label>
							</div>
						</div>
						
						<div class="row">
							<div class="small-4 medium-5 large-6 columns">
								<label>Business Phone Number
									<input type="text" name="bphone">
								</label>
							</div>
							<div class="small-2 medium-3 large-3 columns">
								<label>Max Delivery Range
									<input type="text" name="radius">
								</label>
							</div>
							<div class="small-4 medium-4 large-3 columns">
								<label>Max Items Allowed to Deliver
									<input type="text" name="capacity">
								</label>
							</div>
						</div>
						
						<div class="row">
							<div class="small-8 small-centered columns">
								<label>Default Business Password
									<input type="text" name="dpass">
								</label>
							</div>
						</div>
						
						<br />
						<hr />
						<br />
						
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<label>Manager Name
									<input type="text" name="uname">
								</label>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Email
									<input type="text" name="email">
								</label>
							</div>
						</div>
						
						<div class="row">
							<div class="small-5 medium-6 large-6 columns">
								<label>Create Password
									<input type="text" name="pass">
								</label>
							</div>
							<div class="small-5 medium-6 large-6 columns">
								<label>Phone
									<input type="text" name="uphone">
								</label>
							</div>
						</div>
					
				</fieldset>
				
				<br />
				
				<div class="small-3 columns">
					<a role="button" aria-label="submit form" tabindex="0" class="button">Finish</a>
				</div>
			</div>
		</div>
	</form>
</div>
=======
<div class="container">
    <div class="row">
        <?php echo form_open('register', 'data-abide'); ?>
            <div class="row">
                <div class="small-6 small columns">
                    <div class="name-field">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Business Name
                    </span>
                    <input type="text" required pattern="[a-zA-Z]+" name="name">
                    <small class="error">Name is required and must be a string.</small>
                    </div>
                    <?php //echo form_input('name'); ?>
                </div>
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                     Business Address
                    </span>
                    <input type="text" required pattern="[a-zA-Z0-9]+" name="baddress">
                    <small class="error">An address is required and must be a string.</small>
                    <?php //echo form_input('baddress'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Phone
                    </span>
                    <input type="text" required pattern="[0-9]+" name="bphone">
                    <small class="error">A phone number is required.</small>
                    <?php //echo form_input('bphone'); ?>
                </div>
                <div class="small-3 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Max Delivery Range
                    </span>
                    <input type="text" required pattern="[1-9]+" name="radius">
                    <small class="error">A delivery range is required.</small>
                    <?php //echo form_input('radius'); ?>
                </div>
                <div class="small-3 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Max Items Allowed to Deliver
                    </span>
                    <input type="number" required pattern="[1-9]+" name="capacity">
                    <small class="error">The capacity amount is required.</small>
                    <?php //echo form_input('capacity'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-8 small-centered columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Business Default Password
                    </span>
                    <input type="password" required pattern="[a-zA-Z0-9]+" name="dpass">
                    <small class="error">A password is required.</small>
                    <?php //echo form_password('dpass'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Manager Name
                    </span>
                    <input type="text" required pattern="[a-zA-Z]+" name="uname">
                    <small class="error">A Manager Name is required and must be a string.</small>
                    <?php //echo form_input('uname'); ?>
                </div>
                <div class="small-6 small columns">
                    <div class="email-field">
                    <label><small>required</small></label>
                    <span class="prefix">
                     Email
                    </span>
                    <input type="email" name="email" required>
                    <small class="error">An email address is required.</small>
                    <?php //echo form_input('email'); ?>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Password
                    </span>
                    <input type="password" required pattern="[a-zA-Z0-9]+" name="pass">
                    <small class="error">A password is required.</small>
                    <?php //echo form_password('pass'); ?>
                </div>
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Phone
                    </span>
                    <input type="text" required pattern="[0-9]+" name="uphone">
                    <small class="error">A phone number is required.</small>
                    <?php //echo form_input('uphone'); ?>
                </div>
            <button type="submit">Finish</button>
            </form>
            </div>
        <?php //echo form_submit('', 'Finish', "class ='button small'");
        echo form_close();
        ?>
    </div>
</div>

<body>

<script>
    $(document).foundation();
</script>

</body>
>>>>>>> c136a5e84a065c9eb75cd08765111268e93d69b4
