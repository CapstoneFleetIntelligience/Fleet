<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:16 PM
 */

$haslist = array(
    'name' => 'list',
    'id' => 'list',
    'value' => 'Yes'
);
$nolist = array(
    'name' => 'list',
    'id' => 'list',
    'value' => 'No'
);
$note = array(
    'name' => 'note',
    'id' => 'note',
    'rows' => '3',
    'style' => 'resize: vertical',
);

?>
<div class="container">

    <div class="row">
		<div class="small-10 medium-12 large-12 columns">
		<fieldset>
			<legend>Enter details for new delivery</legend>
			<?php echo form_open('addCust', "data-abide id = 'add_cust'"); ?>
				<div class="row">
					<div class="small-3 large-4 columns">
						<div class="name-field">
							<label>Customer Name
								<input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="cname" name="cname">
							</label>
							<small class="error">A customer name is required.</small>
						</div>
					</div>
					<div class="small-3 large-4 columns">
						<div class="name-field">
							<label>Customer Phone
								<input type="text" placeholder="Required" required pattern="[0-9]+" id="cphone" name="cphone">
							</label>
							<small class="error">A customer phone number is required.</small>
						</div>
					</div>
					<div class="small-3 large-4 columns">
						<div class="name-field">
							<label>Delivery Date
								<input type="date" id="schd" name="schd">
							</label>
						</div>
					</div>
				</div>
        <?php echo form_open('addCust', "data-abide", "id = 'add_cust'");
        echo form_fieldset('Enter details for new delivery');
        ?>

        <div class="row">
            <div class="small-3 large-4 columns">
				<div class="name-field">
					<label>Customer Address
						<input type="text" placeholder="Required" required pattern="[a-zA-Z0-9]+" id="address" name="address">
					</label>
					<small class="error">A customer address is required.</small>
				</div>
            </div>
            <div class="small-3 large-4 columns">
                <div class="name-field">
					<label>City
						<input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="city" name="city">
					</label>
					<small class="error">A city is required.</small>
				</div>
			</div>
            <div class="small-2 columns">
                <div class="name-field">
					<label>State
                        <select id="state" name="state" size="1">
                            <option value="AK">AK</option>

                            <option value="AL">AL</option>
                            <option value="AR">AR</option>
                            <option value="AZ">AZ</option>
                            <option value="CA">CA</option>

                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DC">DC</option>
                            <option value="DE">DE</option>

                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="HI">HI</option>
                            <option value="IA">IA</option>

                            <option value="ID">ID</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="KS">KS</option>

                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="MA">MA</option>
                            <option value="MD">MD</option>

                            <option value="ME">ME</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MO">MO</option>

                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="NC">NC</option>
                            <option value="ND">ND</option>

                            <option value="NE">NE</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>

                            <option value="NV">NV</option>
                            <option value="NY">NY</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>

                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>

                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>

                            <option value="VA">VA</option>
                            <option value="VT">VT</option>
                            <option value="WA">WA</option>
                            <option value="WI">WI</option>

                            <option value="WV">WV</option>
                            <option value="WY">WY</option>
                        </select>
					</label>
					<small class="error">A state is required.</small>
				</div>
            </div>
            <div class="small-2 column">
				<label>Zip
					<input type="text" placeholder="Required" required pattern="[0-9]+" id="zip" name="zip">
				</label>
                <small class="error">A zip code is required.</small>
            </div>
        </div>
        <div class="row">
            <div class="small-4 column">
                <div class="right">
                        <label class="name-field">Does delivery need a checklist?</label>
                        <input type="radio" name="list" value="Yes" id="hasList"><label for="hasList">Yes</label>
                        <input type="radio" name="list" value="No" id="noList"><label
                            for="noList">No</label>
                </div>
                <small class="error">Please select "Yes" or "No".</small>
            </div>
            <div class="small-8 column">
                <div class="name-field">
                    Notes (optional):
                </div>
                <?php echo form_textarea($note); ?>
            </div>
        </div>

		<button type="submit" id="submit_cust" class="small button">Continue</button>
		
		</fieldset>
		</div>
		
        <?php echo form_close(); ?>
    </div>
    <div class="row">
        <div class="small-12 small-centered columns add_items">
        </div>
    </div>
</div>
