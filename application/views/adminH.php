<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 9/26/14
 * Time: 8:50 PM
 */


$results=$this->db->get_where('capsql.business',array('name'=> $this->session->userdata('bname')));
    foreach ($results->result() as $biz)
?>

<?php
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

$('#delDate').datepicker();
function initialize()
{
    var myLatlng = new google.maps.LatLng(<?php echo $biz->blat; ?>,<? echo $biz->blong; ?>);

    var mapProp = {
	center: myLatlng,
	zoom:13

    };
    var map1=new google.maps.Map(document.getElementById("googleMap1")
	,mapProp);

    var map2=new google.maps.Map(document.getElementById("googleMap2")
	,mapProp);

    var marker1 = new google.maps.Marker({
	position: myLatlng,
	map: map1,
	title: '<? echo $biz->name; ?>'
    });

    var marker2 = new google.maps.Marker({
	position: myLatlng,
	map: map2,
	title: '<? echo $biz->name; ?>'
    });

}


    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div class="container">
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <h2 style="text-align: center;"><?php echo $this->session->userdata('bname') ?></h2>
            <h3 style="text-align: center;"><?php echo $this->session->userdata('uname') ?></h3>
        </div>
    </div>
    <div class="row">
 
		<br/>
		
        
		<div class="row">
			<div class="small-10 medium-12 large-12 columns">
				<div class="large-12 medium-12 small-12 columns">
					<div class="panel">
						<h2 style="text-align: center;">Active Delivery Drivers</h2>
					</div>
				</div>
				<div class=" medium-10 show-for-medium-only columns">
					<div class="row">
						<div id="googleMap1" style="width:800px;height:500px;"></div>
					</div>
				</div>
				<div class=" large-12 columns show-for-small">
					<div class="row">
						<div id="googleMap1" style="width:1000px;height:700px;"></div>
					</div>
				</div>
				<div class="large-12 show-for-large-up columns">
					<div class="row">
						<div id="googleMap2" style="width:1000px;height:500px;"></div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>


<div id="deliveryModal" class="reveal-modal" data-reveal>
    <?php $this->load->view('newDelivery', array('customers' => $customers, 'items' => $items)); ?>
</div>
<div id="addItemModal" class="reveal-modal" data-reveal>
    <?php $this->load->view('templates/item_table'); ?>
</div>
<div id="customerModal" class="reveal-modal" data-reveal>
    <?php $this->load->view('custN'); ?>
</div>
<div id="addEmployeeModal" class="reveal-modal small" data-reveal>
    <?php $this->load->view('addEmployee') ?>
</div>


<div class="row">
    <div class="large-12 columns"> 
 
    <br />
    
      <div class="row">
        <div class="large-12 columns">
          <div class="row">
            <div class="large-4 small-6 columns">
 
		<h4>System Tools</h4><hr>
		<div class="row">
		    <div class="large-12 small-3 columns">
			<a href="#" data-reveal-id="editEmployeeModal" class="button expand">Employee(s)</a>
			<a href="#" data-reveal-id="editDeliveryModal" class="button expand">Deliveries</a>
			<a href="#" data-reveal-id="editItemModal" class="button expand">Checklist Items</a>
			<a href="#" data-reveal-id="editPassModal" class="button expand">Business Password</a>
			<a href="#" data-reveal-id="editRadiusModal" class="button expand">Delivery Range</a>
			<a href="#" data-reveal-id="routeModal" class="button expand">Route Manager</a>
		    </div>
		</div>
	    </div>
             
            <div class="large-4 small-6 columns">
		<br />
		<br />
		<img src="http://placehold.it/300x430&text=Image">
            </div>
 
             
	    <div class="large-4 small-6 columns">
 
		<h4>Admin Tools</h4><hr>
     
		<div class="row">
		    <div class="large-12 small-3 columns">
			<a href="#" class="button expand" data-reveal-id="deliveryModal">New Delivery</a>
			<a href="#" class="button expand" data-reveal-id="addItemModal">Add New Item(s)</a>
			<a href="#" class="button expand" data-reveal-id="addEmployeeModal">Add Employee(s)</a>
			<a href="route_controller/routeN" class="button expand">Create Routes</a>
		    </div>
		</div>
	    </div>
 
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <script>
  document.write('<script src=js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  </script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
 
    

<div id="editEmployeeModal" class="reveal-modal medium" data-reveal>
    <?php $this->load->view('editEmployee', array('employees' => $employees)); ?>
</div>
<div id="editDeliveryModal" class="reveal-modal large" data-reveal>
    <?php $this->load->view('editDelivery', array('deliveries' => $deliveries)); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>
<div id="editItemModal" class="reveal-modal medium" data-reveal>
    <?php $this->load->view('templates/item_table'); ?>
</div>
<div class="reveal-modal tiny" id="editPassModal" data-reveal>
    <?php echo form_open('changePass');?>
    <span>New Business Password</span>
    <?php
    $bpass = array(
        'name' => 'bpass',
        'id' => 'bpass',
        'class' => 'small-6 small-centered'
    );
    ?>
    <?php echo form_hidden('business', $business->name, 'id= "bname"');
    echo form_password($bpass);
    echo form_submit('submit', 'Submit', "class='tiny button' id='updateBusinessPass'");
    echo form_close();
    ?>
    <a class="close-reveal-modal">&#215;</a>
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
    );?>
    <span>New Delivery Range</span>
    <?php echo form_hidden('business', $business->name, 'id = "bname"');
    echo form_input($radius);
    echo form_submit('update', 'update', 'id = "updateRange"  class="tiny button radius"');
    echo form_close();
    ?>
    <a class="close-reveal-modal">&#215;</a>
</div>
<div id="routeModal" class="reveal-modal tiny text-center" data-reveal>
    <h4>Select the date of routes to be edited.</h4>
    <div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>
    <a class="close-reveal-modal">&#215;</a>
</div>

<script type="text/javascript">
    $('.delivery_table').on("click", ".delete", function () {
        $(this).unbind('click');
        var id= $(this).attr('id');
        var td = $(this).parent();
        var schd = $(td[0]).find("input").val();

        var data = {
            cid: id,
            schd: schd
        };

        $.ajax({
            url: "admin_controller/removeDelivery",
            type: 'POST',
            data: data,
            success: function(data){
                $('.delivery_table').html(data);
            }
        })
    });

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
    
</script>