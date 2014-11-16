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
        <?php echo form_open('addCust', "data-abide id = 'add_cust'");
        echo form_fieldset('Enter details for new delivery');
        ?>

        <div class="row">
            <div class="small-4 column">
                <span class="prefix">
                    Customer Name
                </span>
                <input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="cname" name="cname">
                <small class="error">A customer name is required.</small>
            </div>
            <div class="small-4 column">
                <span class="prefix">
                    Customer Phone
                </span>
                <input type="text" placeholder="Required" required pattern="[0-9]+" id="cphone" name="cphone">
                <small class="error">A customer phone number is required.</small>
            </div>
            <div class="small-4 column">
            <span class="prefix">
                     Delivery Date
                </span>
                <input type="date" id="schd">
            </div>
        </div>

        <div class="row">
            <div class="small-4 column">
            <span class="prefix">
                     Customer Address
            </span>
                <input type="text" placeholder="Required" required pattern="[a-zA-Z0-9]+" id="address" name="address">
                <small class="error">A customer address is required.</small>
            </div>
            <div class="small-4 column">
                <span class="prefix">
                   City
                </span>
                <input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="city" name="city">
                <small class="error">A city is required.</small>
            </div>
            <div class="small-2 column">
                <span class="prefix">
                    State
                </span>
                <input type="text" placeholder="Required" required pattern="[a-zA-Z]+" id="state" name="state">
                <small class="error">A state is required.</small>
            </div>
            <div class="small-2 column">
                <span class="prefix">
                    Zip
                </span>
                <input type="text" placeholder="Required" required pattern="[0-9]+" id="zip" name="zip">
                <small class="error">A zip code is required.</small>
            </div>
        </div>
        <div class="row">
            <div class="small-4 column">
            <span class="prefix">
                    Does delivery need a checklist?
                </span>

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
                <span class="prefix">
                    Notes (optional):
                </span>
                <?php echo form_textarea($note); ?>
            </div>
        </div>
        <button type="submit" id="submit_cust" class="small button">Continue</button>

        <?php
        echo form_close();
        ?>
    </div>
    <div class="row">
        <div class="small-12 small-centered columns add_items">

        </div>
    </div>
</div>
