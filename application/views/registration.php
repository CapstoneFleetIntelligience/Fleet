<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */
?>

<div class="container">
    <div class="row">
        <?php echo form_open('register'); ?>
        <div class="row">
            <div class="small-6 small columns">
                <span class="prefix">
                    Business name
                </span>
                <?php echo form_input('name'); ?>
            </div>
            <div class="small-6 small columns">
                <span class="prefix">
                     Address
                </span>
                <?php echo form_input('baddress'); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-6 small columns">
            <span class="prefix">
                    Phone
                </span>
                <?php echo form_input('bphone'); ?>
            </div>
            <div class="small-3 small columns">
            <span class="prefix">
                    Max Delivery Range
                </span>
                <?php echo form_input('radius'); ?>
            </div>
            <div class="small-3 small columns">
            <span class="prefix">
                    Max items allowed to deliver
                </span>
                <?php echo form_input('capacity'); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-8 small-centered columns">
            <span class="prefix">
                Business Default Password
                </span>
                <?php echo form_password('dpass'); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-6 small columns">
                <span class="prefix">
                    Manager name
                </span>
                <?php echo form_input('uname'); ?>
            </div>
            <div class="small-6 small columns">
                <span class="prefix">
                     Email
                </span>
                <?php echo form_input('email'); ?>
            </div>
        </div>
        <div class="row ">
            <div class="small-6 small columns">
            <span class="prefix">
                    Password
                </span>
                <?php echo form_password('pass'); ?>
            </div>
            <div class="small-6 small columns">
            <span class="prefix">
                    Phone
                </span>
                <?php echo form_input('uphone'); ?>
            </div>
        </div>
        <?php echo form_submit('', 'Finish', "class ='button small'");
        echo form_close();
        ?>
    </div>
</div>