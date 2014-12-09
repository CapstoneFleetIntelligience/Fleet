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
        <table class="responsive">
            <thead>
            <tr>
                <th>Customer</th>
                <th >Address</th>
                <th >Delivery Date</th>
                <th >Items</th>
                <th>Qty</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($deliveries as $cid => $customer) {
                echo '<tr id="removeDelivery">';
                echo '<td>' . $customer->name . '</td>';
                echo '<td>' . $customer->address . '</td>';
                echo '<td>' . $customer->schd . '</td>';
                echo '<td><ul>';
                  foreach($customer->iname as $index => $item)
                  {

                          if(!empty($customer->qty[$index]))
                          {
                          echo '<li>';
                          echo $item;
                          echo '</li>';
                      }
                  }
                echo '</ul></td>';
                echo '<td><ul>';
                foreach($customer->qty as $qty)
                {
                    if(!empty($qty))
                    {
                        echo '<li>';
                        echo $qty;
                        echo '</li>';
                    }
                }
                echo '</ul></td>';
                echo '<td><button type="button" id="'.$customer->cid.'" class="button tiny radius delete"
                >Delete</button>'. form_hidden('schd', $customer->schd).'</td>';
                echo form_hidden('cid', $customer->cid);

                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>