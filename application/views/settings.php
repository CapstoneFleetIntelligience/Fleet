<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/7/14
 * Time: 4:26 PM
 */
$bpass = array(
    'name' => 'bpass',
    'id' => 'bpass',
    'class' => 'small-6 small-centered'
);
?>
<div class="container">
    <div class="row">
        <div class="small-6 small-centered">
            <span>Employee(s)</span>
            <?php echo anchor(
                'editEmploy', 'Edit',
                'id="editEmployee" class="right small button radius"'
            ) ?>
            <div id="employee_table" class="row hide">
                <?php $this->load->view('editEmployee', array('employees' => $employees)); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span>Deliveries</span>
            <?php echo anchor(
                'editDelivery', 'Edit',
                'id="editDelivery" class="right small button radius"'
            ) ?>
            <div id="delivery_table" class="row hide">
                <?php //$this->load->view('editDelivery'); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span>Checklist Items</span>
            <?php echo anchor(
                'editChklist', 'Edit',
                'id="editChklist" class="right small button radius"'
            ) ?>
            <div id="item_table" class="row hide">
                <?php $this->load->view('templates/item_table'); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span> Business Password</span>
            <?php echo anchor('editPass', 'Edit', 'id="editPass" class="right small button radius"') ?>
        </div>
        <div class="row hide" id="pass_field">
            <?php echo form_open('changePass');
            echo form_password($bpass);
            echo form_submit('submit', 'Submit', "class='tiny button' id='submitPass'");
            echo form_close();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span>Delivery Range</span>
            <?php echo anchor('editRange', 'Edit', 'id="editRange" class="right small button radius"') ?></span>
        </div>
        <div id="range_field" class="row hide">
            <?php echo form_open('changeRange');
            $radius = array(
                'type' => 'number',
                'name'  => 'radius',
                'id' => 'radius',
                'value' => $business->radius,
                'min' => '0',
                'max' => '1000',
                'step' => '1'
            );
            echo form_input($radius);
            echo form_submit('update', 'update', 'id = "updateRange"  class="small button radius"');
            echo form_close();
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#editChklist").click(function () {
        $("#item_table").toggleClass("hide");
        return false;
    });

    $('#editEmployee').click(function () {
        $('#employee_table').toggleClass('hide');
        return false;
    });

    $("#editDelivery").click(function () {
        $("#delivery_table").toggleClass('hide');
        return false;
    });

    $('#editPass').click(function () {
        $('#pass_field').toggleClass('hide');
        return false;
    });

    $('#submitPass').click(function() {
        var pass = {
            bpass: $('#bpass').val(),
            name: "<?php echo $business->name ?>"
        };

        $.ajax({
            url: "<?php echo site_url('Settings_controller/editPass')?>",
            type: 'POST',
            data: pass,
            success: function (msg) {
                console.log(msg);
            }
        });
    return false;
    });


    $('#updateRange').click(function(){
       var radius = {
           radius: $('#radius').val(),
           name: "<?php echo $business->name ?>"
       };
        $.ajax({
            url: "<?php echo site_url('Settings_controller/editRange')?>",
            type: 'POST',
            data: radius,
            success: function (data) {

            }
        });

        return false;
    });



    $('#editRange').click(function () {
        $('#range_field').toggleClass('hide');
        return false;
    });
</script>

