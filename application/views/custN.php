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
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
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
