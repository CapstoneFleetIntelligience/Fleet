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
$dquery = $this->db->query("select schd from route where bname = '".$this->session->userdata('bname')."' and schd >= current_date group by schd");
if ($dquery->num_rows() > 0){
    foreach ($dquery->result() as $row)
    {
        $ddate[] = "'".$row->schd."'";
    }
    $ddates = implode(",",$ddate);
}else{
    $ddates = '';
}
?>
<script>
    $(function() {
        var arrayD = [<? echo $ddates ?>];
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date){
                var f = $.datepicker.formatDate('yy-mm-dd', date)
                if ($.inArray(f, arrayD) > -1) {
                    return [true];
                }else{
                    return [false];
                }
            },
            onSelect: function(dateText) {
                window.location = '<?php echo site_url('routeE')?>/' + dateText;
            }
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="small-6 small-centered">
            <span>Employee(s)</span>
            <?php echo anchor('', 'Edit', array('class' => 'button radius small right',
                                                     'data-reveal-id'=>'employeeModal'));?>
            <div id="employeeModal" class="reveal-modal medium" data-reveal>
                <?php $this->load->view('editEmployee', array('employees' => $employees)); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-6 small-centered">
            <span>Deliveries</span>
            <?php echo anchor(
                '', 'Edit',array('class' => 'button radius small right',
                                 'data-reveal-id'=>'deliveryModal')
            ) ?>
            <div id="deliveryModal" class="reveal-modal large" data-reveal>
                <?php $this->load->view('editDelivery', array('deliveries' => $deliveries)); ?>
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
    <div class="row">
        <div class="small-6 small-center">
            <span>Route Manager</span>
            <a href="#" data-reveal-id="routeModal" class="right small button radius">Open</a>

        </div>
        <div id="routeModal" class="reveal-modal tiny text-center" data-reveal>
            <h4>Select the date of routes to be edited.</h4>
            <div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>
            <a class="close-reveal-modal">&#215;</a>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.employee_table').on("click", ".update", function(){
        $(this).unbind('click');
        var id = $(this).attr('id');
        var data = $('#updateUser-'+id+' :input').serialize();
        editEmployee('update', data);
    });

    $('.employee_table').on("click", ".delete", function(){
        $(this).unbind('click');
        var id = $(this).attr('id');
        var data = $('#updateUser-'+id+' :input').serialize();
        editEmployee('delete', data);
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
</script>

