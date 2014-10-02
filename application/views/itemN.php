<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:33 PM
 */
$name = array(
    'name' => 'iname',
    'class' => 'small-8 columns right'
);
$description = array(
    'name' => 'description',
    'rows' => '4',
    'class' => 'small-8 columns right'
);
$isdefault = array(
    'name'      => 'default',
    'id'        => 'y',
    'value'     => '1',
    'checked'   => FALSE
);
$notdefault = array(
    'name'      => 'default',
    'id'        => 'n',
    'value'     => '0',
    'checked'   => TRUE
);
?>
<div class="container">

    <div class="row">
        <?php echo form_open('addItem');
        echo form_fieldset('Enter details for new item');
        ?>
        <div class="row">
            <div class="small-8 small-centered columns">
                <span class="prefix">
                    Item Name
                </span>
                <?php echo form_input($name); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-8 small-centered columns">
            <span class="prefix">
                    This item is found<br> in every checklist
                </span>
                <div class="small-2 columns right">
                    <?php
                    echo form_label("No",'n');
                    echo form_radio($notdefault);
                    ?>
                </div>

                <div class="small-2 columns right">
                    <?php
                    echo form_label("Yes",'y');
                    echo form_radio($isdefault);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="small-8 small-centered columns">
                <span class="prefix">
                    Description
                </span>
                <?php echo form_textarea($description); ?>
            </div>
        </div>


        <?php echo form_submit('submit', 'Continue', array('class' => 'button small'));
        echo form_close();
        ?>
    </div>
</div>