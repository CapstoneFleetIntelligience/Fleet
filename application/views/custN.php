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
								<input type="date" id="schd">
							</label>
						</div>
					</div>
				</div>

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
						<input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="state" name="state">
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
				<div class="name-field">
					Does delivery need a checklist?
				</div>

                <div class="small-2 columns right">
                    <?php
                    echo form_label("No", 'n');
                    echo form_radio($nolist);
                    ?>
                </div>
                <div class="small-2 columns right">
                    <?php
                    echo form_label("Yes", 'y');
                    echo form_radio($haslist);
                    ?>
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
