<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:16 PM
 */
$cname = array(
    'name' => 'cname',
    'id' => 'cname',
    'class' => 'small-8 columns right'
);
$address = array(
    'name' => 'address',
    'id' => 'address'
);
$city = array(
    'name' => 'city',
    'id' => 'city'
);
$zip = array(
    'name' => 'zip',
    'id' => 'zip'
);
$state = array(
    'name' => 'state',
    'id' => 'state'
);
$cphone = array(
    'name' => 'cphone',
    'id' => 'cphone',
    'class' => 'small-8 columns right'
);
$schd = array(
    'name' => 'schd',
    'id' => 'schd',
    'class' => 'small-8 columns right'
);
$haslist = array(
    'name' => 'list',
    'id' => 'list',
    'value' => 'Yes'
);
$nolist = array(
    'name' => 'list',
    'id' => 'list',
    'value' => 'No'
);
$note = array(
    'name' => 'note',
    'id' => 'note',
    'rows' => '3',
    'style' => 'resize: vertical',
);

?>
<div class="container">

    <div class="row">
        <?php echo form_open('addCust', "id = 'add_cust'");
        echo form_fieldset('Enter details for new delivery');
        echo form_input(array('name' => 'clat', 'type' => 'hidden', 'id' => 'clat', 'value' => '0.0'));
        echo form_input(array('name' => 'clong', 'type' => 'hidden', 'id' => 'clong', 'value' => '0.0'));
        ?>

        <div class="row">
            <div class="small-4 column">
                <span class="prefix">
                    Customer Name
                </span>
                <?php echo form_input($cname); ?>
            </div>
            <div class="small-4 column">
                <span class="prefix">
                    Customer Phone
                </span>
                <?php echo form_input($cphone); ?>
            </div>
            <div class="small-4 column">
            <span class="prefix">
                     Delivery Date
                </span>
                <input type="date" id="schd">
            </div>
        </div>

        <div class="row">
            <div class="small-4 column">
            <span class="prefix">
                     Customer Address
            </span>
                <?php echo form_input($address); ?>
            </div>
            <div class="small-4 column">
                <span class="prefix">
                   City
                </span>
                <?php echo form_input($city) ?>
            </div>
            <div class="small-2 column">
                <span class="prefix">
                    State
                </span>
                <?php echo form_input($state) ?>
            </div>
            <div class="small-2 column">
                <span class="prefix">
                    Zip
                </span>
                <?php echo form_input($zip) ?>
            </div>
        </div>
        <div class="row">
            <div class="small-4 column">
            <span class="prefix">
                    Does delivery need a checklist?
                </span>

                <div class="small-2 columns right">
                    <?php
                    echo form_label("No", 'n');
                    echo form_radio($nolist);
                    ?>
                </div>
                <div class="small-2 columns right">
                    <?php
                    echo form_label("Yes", 'y');
                    echo form_radio($haslist);
                    ?>
                </div>
            </div>
            <div class="small-8 column">
                <span class="prefix">
                    Notes (optional):
                </span>
                <?php echo form_textarea($note); ?>
            </div>
        </div>


        <?php
        echo form_submit('', 'Continue', "id= 'submit_cust' class = 'small button'");
        echo form_close();
        ?>
    </div>
    <div class="row">
        <div class="small-12 small-centered columns add_items">

        </div>
    </div>
</div>


<script type="text/javascript">
    $('#submit_cust').click(function () {
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
        var address = $("#address").val();
        var caddress = address + ', ' + city + ', ' + state + ' ' + zip;
        var form_data = {
            cname: $('#cname').val(),
            caddress: caddress,
            cphone: $('#cphone').val()
        };
        var delivery_data = {
            schd: $('#schd').val(),
            note: $('#note').val()
        };


        $.ajax({
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
                    $("#submit_cust").prop('disabled', true);
                }
            }
        });
        return false;
    });

</script>
