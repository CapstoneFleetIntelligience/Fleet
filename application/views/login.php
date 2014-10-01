<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/30/14
 * Time: 9:46 PM
 */
$email = array(
    'name' => 'email',
    'class' => 'small-3 columns'
);
$pass = array(
    'name' => 'pass',
    'class' => 'small-3 columns'
)
?>
<div class="container">
    <div class="row">
        <?php
        echo form_open('authenticate');
        echo form_fieldset('Login');?>
        <div class="small-8">
             <span class="prefix">
                    Email
                </span>
            <?php
            echo form_input($email);
            ?>
        </div>

        <div class="small-8">
             <span class="prefix">
                    password
                </span>
            <?php
            echo form_password($pass);?>
        </div>

        <?php
        echo form_fieldset_close();
        echo form_submit('', 'login', array('class' => 'button small'));
        ?>
    </div>
</div>