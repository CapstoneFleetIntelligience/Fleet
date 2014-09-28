<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/27/14
 * Time: 9:06 PM
 */

$name = array(
    'name' => 'name',
    'class' => 'small-8 columns right'
);
$address = array(
    'name' => 'address',
    'class' => 'small-8 columns right'
);
$range = array(
    'name' => 'radius',
    'class' => 'small-8 columns right'
);
$phone = array(
    'name' => 'phone',
    'class' => 'small-8 columns right'
);
$capacity = array(
    'name' => 'capacity',
    'class' => 'small-8 columns right'
);
$defaultPass = array(
    'name' => 'dpass',
    'class' => 'small-8 columns right'
);
?>

<div class="container">
    <div class="row">
        <?php echo form_open('registerBusiness');

        echo form_fieldset('Nearly Finished');
        ?>
        <div class="small-8 small-centered columns">
                <span class="prefix">
                    Business name
                </span>
            <?php echo form_input($name); ?>
        </div>
        <div class="small-8 small-centered columns">
                <span class="prefix">
                     Address
                </span>
            <?php echo form_input($address); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Phone
                </span>
            <?php echo form_input($phone); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Max Delivery Rnage
                </span>
            <?php echo form_input($range); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Max items allowed to deliver
                </span>
            <?php echo form_input($capacity); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                Business Default Password
                </span>
            <?php echo form_password($defaultPass); ?>
        </div>
        <?php echo form_submit('', 'Finish', array('class' => 'button small'));
        echo form_close();
        ?>
    </div>
</div>