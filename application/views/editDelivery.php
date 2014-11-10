<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 11/3/14
 * Time: 9:30 PM
 */
?>
<div class="delivery_table">
    <div class="row">
        <table>
            <thead>
            <tr>
                <th width="150">Customer</th>
                <th width="250">Address</th>
                <th width="150">Delivery Date</th>
                <th width="80">Item</th>
                <th width="80">Qty</th>
                <th width="80">Remove</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($deliveries as $cid => $customer) {
                echo '<tr id="removeDelivery-' . $cid . '">';
                echo '<td>' . $customer->name . '</td>';
                echo '<td>' . $customer->address . '</td>';
                echo '<td>' . $customer->schd . '</td>';
                echo '<td>' . $customer->iname. '</td>';
                echo '<td>' . $customer->qty . '</td>';
                echo '<td><button type="button" id="'.$cid.'" class="button tiny radius delete" >Delete</button></td>';
                echo form_hidden('cid', $cid);
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>