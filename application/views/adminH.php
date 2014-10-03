<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 9/26/14
 * Time: 8:50 PM
 */
?>
<div class="container">
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <h3 style="text-align: center;">Managers Name</h3>
        </div>
    </div>
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
            <div class="row">
                <?php echo anchor('custN', 'New Customer(s)',array('class' => 'button small radius left')) ?>
            </div>
            <div class="row">
                <?php echo anchor('itemN', 'New Item(s)',array('class' => 'button small radius left')) ?>
                <?php echo anchor('employee_controller/addNew', 'Add Employee(s)',
                    array('class' => 'button small radius
                left')) ?>
            </div>
        </div>
        <div class="large-9 medium-9 small-12 columns">
            <div class="panel">
                <h2 style="text-align: center;">Recent Deliveries</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="panel">
                <h2 style="text-align: center;">Active Delivery Drivers</h2>
            </div>
        </div>
    </div>
</div>
