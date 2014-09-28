<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */
$email = array(
    'name' => 'email',
    'class' => 'small-8 columns right'
);
$bName = array(
    'name' => 'businessName',
    'class' => 'small-8 columns right'
);
$address = array(
    'name' => 'address',
    'class' => 'small-8 columns right'
);
$range = array(
    'name' => 'range',
   'class' => 'small-8 columns right'
);
$name = array(
    'name' => 'managerName',
    'class' => 'small-8 columns right'
)
?>

<div class="container">

    <div class="row">
        <?php echo form_open('register');
        echo form_fieldset('Simple yet effective');
        ?>
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
                    Business Name
                </span>
            <?php echo form_input($bName); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Address
                </span>
            <?php echo form_input($address); ?>
        </div>
        <div class="small-8 small-centered columns">
            <span class="prefix">
                    Max Delivery range
                </span>
            <?php echo form_input($range); ?>
        </div>
        <?php echo form_submit('submit', 'Continue', array('class' => 'button small'));
                echo form_close();
            ?>
    </div>
</div>