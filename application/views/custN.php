<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:16 PM
 */
$cname = array(
    'name' => 'cname',
    'class' => 'small-8 columns right'
);
$caddress = array(
    'name' => 'caddress',
    'class' => 'small-8 columns right'
);
$cphone = array(
    'name' => 'cphone',
    'class' => 'small-8 columns right'
);
$schd = array(
    'name' => 'schd',
    'class' => 'small-8 columns right'
);
$haslist = array(
    'name' => 'list',
    'id' => 'y',
    'value'       => 'Yes',
    'checked'     => TRUE
);
$nolist = array(
    'name' => 'list',
    'id' => 'n',
    'value'       => 'No',
    'checked'     => FALSE
);
$note = array(
    'name' => 'note',
    'rows' => '5',
    'style' => 'resize: vertical',
    'class' => 'small-8 columns right'
);

?>
<div class="container">

    <div class="row">
        <?php echo form_open('addCust');
        echo form_fieldset('Enter details for new delivery');
        ?>

        <div class="row">
            <div class="small-8 small-centered columns">
                <span class="prefix">
                    Customer Name
                </span>
                <?php echo form_input($cname); ?>
            </div>
        </div>

        <div class="row">
            <div class="small-8 small-centered columns">
            <span class="prefix">
                     Customer Address
                </span>
                <?php echo form_input($caddress); ?>
            </div>
        </div>

        <div class="row">
            <div class="small-8 small-centered columns">
                <span class="prefix">
                    Customer Phone
                </span>
                <?php echo form_input($cphone); ?>
            </div>
        </div>

        <div class="row">
            <div class="small-8 small-centered columns">
            <span class="prefix">
                     Delivery Date
                </span>
                <?php echo form_input($schd); ?>
            </div>
        </div>

        <div class="row">
            <div class="small-8 small-centered columns">
            <span class="prefix">
                    Does delivery need a checklist?
                </span>

                <div class="small-2 columns right">
                    <?php
                    echo form_label("No",'n');
                    echo form_radio($nolist);
                    ?>
                </div>

                <div class="small-2 columns right">
                    <?php
                    echo form_label("Yes",'y');
                    echo form_radio($haslist);
                    ?>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="small-8 small-centered columns">
                <span class="prefix">
                    Notes (optional):
                </span>
                <?php echo form_textarea($note); ?>
            </div>
        </div>

        <?php
        echo form_submit('submit', 'Submit Delivery', array('class' => 'button small'));
        echo form_close();
        ?>
    </div>
</div>