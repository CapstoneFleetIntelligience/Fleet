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
            <?php echo anchor('', 'Edit', array('class' => 'button radius small right',
                                                     'data-reveal-id'=>'employeeModal'));?>
            <div id="employeeModal" class="reveal-modal small" data-reveal>
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
                'editChklist', 'Edit', array('class' => 'right button small radius', 'data-reveal-id'=>'editItemModal')
            ) ?>
            <div id="editItemModal" class="reveal-modal medium" data-reveal>
                <?php $this->load->view('templates/item_table'); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span> Business Password</span>
            <?php echo anchor('', 'Edit', array('class' => 'right small button radius',
                                                'data-reveal-id' => 'editPassModal')) ?>
        </div>
        <div class="reveal-modal tiny" id="editPassModal" data-reveal>
            <?php echo form_open('changePass');
            echo form_hidden('business', $business->name, 'id= "bname"');
            echo form_password($bpass);
            echo form_submit('submit', 'Submit', "class='tiny button' id='updateBusinessPass'");
            echo form_close();
            ?>
            <a class="close-reveal-modal">&#215;</a>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span>Delivery Range</span>
            <?php echo anchor('', 'Edit', array('class' => 'radius button small right',
                                                         'data-reveal-id' => 'editRadiusModal')); ?>
        </div>
        <div id="editRadiusModal" class="reveal-modal tiny" data-reveal>
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
            echo form_hidden('business', $business->name, 'id = "bname"');
            echo form_input($radius);
            echo form_submit('update', 'update', 'id = "updateRange"  class="tiny button radius"');
            echo form_close();
            ?>
            <a class="close-reveal-modal">&#215;</a>
        </div>

    </div>
</div>
