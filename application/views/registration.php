<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */

$uphone = array(
    'name' => 'uphone',
    'class' => 'small-8 columns right'
);
$name = array(
    'name' => 'uname',
    'class' => 'small-8 columns right'
);
$pass = array(
    'name' => 'pass',
    'class' => 'small-8 columns right'
);
$email = array(
    'name' => 'email',
    'class' => 'small-8 columns right'
);
$bname = array(
    'name' => 'name',
    'class' => 'small-8 columns right'
);
$address = array(
    'name' => 'baddress',
    'class' => 'small-8 columns right'
);
$range = array(
    'name' => 'radius',
    'class' => 'small-8 columns right'
);
$bphone = array(
    'name' => 'bphone',
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
        <?php echo form_open('register');
        echo form_fieldset('Simple yet effective');
        ?>
        <div class="small-8 small-centered columns">
                <span class="prefix">
                    Business name
                </span>
            <?php echo form_input($bname); ?>
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
            <?php echo form_input($bphone); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Max Delivery Range
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
        <div class="small-8 small-centered columns">
                <span class="prefix">
                    Manager name
                </span>
            <?php echo form_input($name); ?>
        </div>
        <div class="small-8 small-centered columns">
                <span class="prefix">
                     Email
                </span>
            <?php echo form_input($email); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Password
                </span>
            <?php echo form_password($pass); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Phone
                </span>
            <?php echo form_input($uphone); ?>
        </div>
        <?php echo form_submit('', 'Finish', array('class' => 'button small'));
        echo form_close();
        ?>
    </div>
</div>