<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 11/6/14
 * Time: 9:37 PM
 */
$note = array(
    'name' => 'note',
    'id' => 'note',
    'rows' => '3',
    'style' => 'resize: vertical',
);
$options = array();
foreach ($customers as $index => $customer) {
    $options[$customer->cid] = $customer->cname;
}
?>

<div class="container">
    <div class="small-centered">
        <?php echo form_open('', "id= 'add_delivery'"); ?>
        <div class="row">
            <div class="small-12 columns">
                <label class="prefix">Select Customer</label>
                <?php echo form_dropdown('cid', $options); ?>
                <?php /*echo form_hidden('bname', $customer->bname);*/ ?>
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                  <span class="prefix">
                     Delivery Date
                </span>
                <input name="ischd" type="date" id="delDate">
            </div>
        </div>
    </div>
    <?php echo $this->load->view('bChkList', array('items' => $items, 'delivery' => null)); ?>
    <div class="row">
                <span class="prefix">
                    Notes (optional):
                </span>
        <?php echo form_textarea($note); ?>
    </div>

    <?php echo form_submit('', 'create', "id = 'submit_delivery' class = 'button small'"); ?>
    <?php echo form_close(); ?>
</div>
</div>