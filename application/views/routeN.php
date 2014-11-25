<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/11/14
 * Time: 7:59 PM
 */
$schd = array(
    'name' => 'schd',
    'id' => 'schd',
    'class' => 'small-8 columns right'
);
$business = $this->session->userdata('bname');
$query = $this->db->get_where('capsql.user', array('bname' => $business));

$SQL = "select schd from delivery as d , customer as c where c.cid = d.cid and c.bname = ? and d.schd >= current_date group by schd";

$dquery = $this->db->query($SQL,$this->session->userdata('bname'));

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
        $( "#datepicker2" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date)
            {

                var f = $.datepicker.formatDate('yy-mm-dd', date)
                if ($.inArray(f, arrayD) > -1) {
                    return [true];
                }else{
                    return [false];
                }
            },
            onSelect: function(dateText) {
                $('#dateoutput').attr('value', dateText);
            }
        });
    });

    $('#delDate').datepicker();
</script>

<div class="container">
    <?php
    if ($this->uri->segment(2) == "baddate"){?>
        <div class="row">
            <div class="small-12">
                <div data-alert class="alert-box alert round">
                    <h4>There are no deliveries scheduled for that date! Please choose another date.</h4>
                    <a href="#" class="close">&times;</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <?php
        echo form_open('routePrep', "id='route_prep'");
        echo form_fieldset('Select a Delivery date and the Deliverers to execute the routes.');
        ?>
        <div class="row">
            <div class="small-8 small-centered columns">
                    <span class="prefix">
                        Delivery Date
                    </span>
                <div id="datepicker2"></div> <input type="text" name="schd" id="dateoutput" disabled>
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Select</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($query->result() as $row)
            {
                switch ($row->role){
                    case 'A':
                        $role = 'Admin';
                        break;
                    case 'M':
                        $role = 'Manager';
                        break;
                    case 'E':
                        $role = 'Employee';
                        break;
                    default:
                        $role = 'Error bad Data';
                }
            ?>
                <tr>
                    <td><?php echo $row->uname; ?></td>
                    <td><?php echo $role; ?></td>
                    <td><?php echo form_checkbox('users[]', $row->uname); ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
        echo form_submit('','Create Route', "id = 'submit_route' class = 'button small'");
        echo form_close();
        ?>
    </div>
</div>