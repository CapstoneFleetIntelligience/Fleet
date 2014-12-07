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
        <div class="row">
            <div class="small-12 columns">
            <fieldset>
                    <?php echo form_open('', "id= 'add_delivery'"); ?>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Select Customer</label>
                            <?php echo form_dropdown('cid', $options); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Delivery Date</label>
                            <input name="ischd" type="text" id="delDate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <?php echo $this->load->view('bChkList', array('items' => $items, 'delivery' => null)); ?>
                        </div>
                    </div>
                <div class="row">
                    <div class="small-12 medium-8 columns">
                        <div class="name-field">
                            Notes (optional):
                        </div>
                        <?php echo form_textarea($note); ?>
                    </div>
                </div>
            
                <?php echo form_submit('', 'create', "id = 'submit_delivery' class = 'button small'"); ?>
            </fieldset>
            
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script type="application/javascript">

    $('#submit_cust').click(function () {
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
        var address = $("#address").val();
        var caddress = address + ', ' + city + ', ' + state + ' ' + zip;
        var form_data = {
            cname: $('#cname').val(),
            caddress: caddress,
            cphone: $('#cphone').val(),

        };
        var delivery_data = {
            schd: $('#schd').val(),
            note: $('#note').val()
        };
        var list = {
            list: $('#haslist').val()
        };
        console.log(list);

/*        $.ajax({
            url: "<?php echo site_url('admin_controller/addCust'); ?>",
            type: 'POST',
            data: {
                customer: form_data,
                delivery: delivery_data,
                list: $('input:radio[name=list]:checked').val()
            },
            success: function (data) {
                if (data == 'reset') {
                    $("#add_cust").trigger('reset');
                    alert('Delivery Set');
                }
                else {
                    $(".add_items").html(data);
                    $("#add_cust :input").prop('disabled', true);
                    $("#submit_cust").prop('disabled', true);
                }
            }
        });*/
        return false;
    });
</script>
