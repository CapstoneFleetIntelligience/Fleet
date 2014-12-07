<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 9/26/14
 * Time: 8:50 PM
 */
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
                }
                else{
                    return [false];
                }
            },
            onSelect: function(dateText) {
                window.location = '<?php echo site_url('routeE')?>/' + dateText;
            }
        });
    });

    $('#delDate').datepicker();

    </script>

<script>
function initialize()
{
    var myLatlng = new google.maps.LatLng(<?php echo $business->blat; ?>,<? echo $business->blong; ?>);

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
	title: '<? echo $business->name; ?>'
    });

    var marker2 = new google.maps.Marker({
	position: myLatlng,
	map: map2,
	title: '<? echo $business->name; ?>'
    });
    <?
    if (sizeof($coordinates) > 0){
        $cnt = 1;
        foreach ($coordinates as $coor){
        ?>
            var myLatlng<?echo $cnt?> = new google.maps.LatLng(<?echo $coor->clat?>,<?echo $coor->clong?>);
            var marker1<?echo $cnt?> = new google.maps.Marker({
            position: myLatlng<?echo $cnt?>,
            map: map1,
            title: 'Delivery #<?echo $cnt?>',
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
            });

            var marker2<?echo $cnt?> = new google.maps.Marker({
            position: myLatlng<?echo $cnt?>,
            map: map2,
            title: 'Delivery #<?echo $cnt?>',
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
            });
        <?
        }
    }
 ?>

}


    google.maps.event.addDomListener(window, 'load', initialize);
    

</script>
<!--medium and small screens off canvas menu-->
<div class="off-canvas-wrap show-for-small-up hide-for-large-up" data-offcanvas>
    <?php $role = $this->session->userdata('role'); ?>
    <div class="inner-wrap">
		<nav class="tab-bar">
			<!--left menu section-->
			<section class="left-small">
			    <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
			</section>
			
			<!--menu title-->
			<section class="middle tab-bar-section">
			    <!--script that determines menu title-->
			    <?php
				if($role == 'A'): ?>
				    <h1 class="title">Administration Menu</h1>
				<?php elseif ($role == 'M'): ?>
				    <h1 class="title">Managers Menu</h1>
				<?php else: ?>
				    <h1 class="title">Employee Menu</h1>
			    <?php endif; ?>
			</section>
			
			<!--right menu section-->
			<section class="right-small">
			    <a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
			</section>
		</nav>
		
		<!--left menu section-->
		<aside class="left-off-canvas-menu">
			<ul class="off-canvas-list">
			    <!--script that determines menu functions-->
			    <?php
				if($role == 'A'): ?>
					<li><?php echo anchor('adminH', 'Home'); ?></li>
					<li><?php echo anchor('overview', 'Routes Overview'); ?></li>
					<li><?php echo anchor('route_controller/routeN', 'Create Routes'); ?></li>
					<li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
					<li class="has-submenu"><a href="#">Delivery Tools</a>
						<ul class="left-submenu">
							<li class="back"><a href="#">Back</a></li>
							<li><a href="#" data-reveal-id="editDeliveryModal">Deliveries</a></li>
							<li><a href="#" data-reveal-id="routeModal">Route Manager</a></li>
						</ul>
					</li>
				<?php elseif ($role == 'M'): ?>
					<li><?php echo anchor('adminH', 'Home'); ?></li>
					<li><?php echo anchor('overview', 'Routes Overview'); ?></li>
					<li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
					<li class="has-submenu"><a href="#">Delivery Tools</a>
						<ul class="left-submenu">
							<li class="back"><a href="#">Back</a></li>
							<li><a href="#" data-reveal-id="editDeliveryModal">Deliveries</a></li>
							<li><a href="#" data-reveal-id="routeModal">Route Manager</a></li>
						</ul>
					</li>
					<li><?php echo anchor('contact', 'Contact') ?></li>
				<?php else: ?>
					<li><?php echo anchor('adminH', 'Home'); ?></li>
					<li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
					<li><?php echo anchor('contact', 'Contact') ?></li>
				<?php endif; ?>
			</ul>
		</aside>
		
		<!--right menu section-->
		<aside class="right-off-canvas-menu">
		    <ul class="off-canvas-list">
			<!--script that determines menu functions-->
			<?php
			if($role == 'A'): ?>
				<li class="has-submenu"><a href="#">Business Tools</a>
					<ul class="right-submenu">
						<li class="back"><a href="#">Back</a></li>
						<li class="has-submenu"><a href="#">Employee(s)</a>
							<ul class="right-submenu">
								<li class="back"><a href="#">Back</a></li>
								<li><a href="#" data-reveal-id="addEmployeeModal">Add</a></li>
								<li><a href="#" data-reveal-id="editEmployeeModal">Edit</a></li>
							</ul>
						</li>
						<li><a href="#" data-reveal-id="addItemModal">Add New Checklist Item</a></li>
						<li><a href="#" data-reveal-id="customerModal">New Customer</a></li>
						<li><a href="#" data-reveal-id="deliveryModal">New Delivery</a></li>
						<li><?php echo anchor('analytics', 'Analytics') ?></li>
						<li><?php echo anchor('route_controller/routeN', 'Create Routes') ?></li>
						<li><a href="#" data-reveal-id="editPassModal">Business Password</a></li>
					</ul>
				</li>
				<li><a href="#" data-reveal-id="profileModal">Profile</a></li>
				<li><?php echo anchor('logout', 'Log Out') ?></li>
			<?php elseif($role == 'M'): ?>
				<li class="has-submenu"><a href="#">Business Tools</a>
					<ul class="right-submenu">
						<li class="back"><a href="#">Back</a></li>
						<li class="has-submenu"><a href="#">Employee(s)</a>
							<ul class="right-submenu">
								<li class="back"><a href="#">Back</a></li>
								<li><a href="#" data-reveal-id="addEmployeeModal">Add</a></li>
								<li><a href="#" data-reveal-id="editEmployeeModal">Edit</a></li>
							</ul>
						</li>
						<li><a href="#" data-reveal-id="customerModal">New Customer</a></li>
						<li><a href="#" data-reveal-id="deliveryModal">New Delivery</a></li>
						<li><?php echo anchor('analytics', 'Analytics') ?></li>
						<li><?php echo anchor('route_controller/routeN', 'Create Routes') ?></li>
					</ul>
				</li>
				<li><a href="#" data-reveal-id="profileModal">Profile</a></li>
				<li><?php echo anchor('logout', 'Log Out') ?></li>
			<?php else: ?>
				<li><a href="#" data-reveal-id="profileModal">Profile</a></li>
				<li><?php echo anchor('logout', 'Log Out') ?></li>
			<?php endif; ?>
				
		</aside>
		
		<section class="main-section">
		    <!--page content goes here-->
		    <div class="container">
			<div class="row">
			    <div class="small-12 columns">
				<h2 style="text-align: center;"><?php echo $this->session->userdata('bname') ?></h2>
				<h3 style="text-align: center;"><?php echo $this->session->userdata('uname') ?></h3>
			    </div>
			</div>
			<div class="row">
 
			    <br/>
		
			    <div class="row">
				<div class="small-12 columns">
				    <div class="small-12 columns">
					<div class="panel">
					    <h2 style="text-align: center;">Today's Scheduled Deliveries</h2>
					</div>
				    </div>
				    <div class=" medium-10 show-for-medium-only columns">
					<div class="row">
					    <div id="googleMap1" style="width:800px;height:500px;"></div>
					</div>
				    </div>
				    <div class="small-10 columns show-for-small-only">
					<div class="row">
					    <div id="googleMap1" style="width:300px;height:300px;"></div>
					</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>
		</section>
		
		<a class="exit-off-canvas"></a>
		
    </div>
</div>

<!--large screen page content-->
<div class="container show-for-large-up">
    <div class="row">
	<div class="large-12 medium-12 columns">
	    <h2 style="text-align: center;"><?php echo $this->session->userdata('bname') ?></h2>
	    <h3 style="text-align: center;"><?php echo $this->session->userdata('uname') ?></h3>
	</div>
    </div>
    <div class="row">

	<br/>

	<div class="row">
	    <div class="medium-12 large-12 columns">
		<div class="large-12 medium-12 columns">
		    <div class="panel">
			<h2 style="text-align: center;">Today's Scheduled Deliveries</h2>
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

<?php
switch ($role) {
    case 'A':
        echo '<div id="deliveryModal" class="reveal-modal" data-reveal>';
        $this->load->view('newDelivery', array('customers' => $customers, 'items' => $items));
        echo '</div>';
        echo '<div id="addItemModal" class="reveal-modal" data-reveal>';
        echo '<div class="item_table">';
        $this->load->view('templates/item_table');
        echo '</div></div>';
        echo '<div id="customerModal" class="reveal-modal" data-reveal>';
        $this->load->view('custN');
        echo '</div>';
        echo '<div id="addEmployeeModal" class="reveal-modal small" data-reveal>';
        $this->load->view('addEmployee');
        echo '</div>';
        echo '<div id="editEmployeeModal" class="reveal-modal large" data-reveal>';
        $this->load->view('editEmployee', array('employees' => $employees));
        echo '</div>';
        echo '<div id="editDeliveryModal" class="reveal-modal xlarge" data-reveal>';
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div class="reveal-modal tiny" id="editPassModal" data-reveal>';
        echo form_open('changePass', array('id' => 'editBusinessPass'), array('name' => $business->name));
        echo '<span>New Business Password</span>';
        $bpass = array(
            'name' => 'bpass',
            'id' => 'bpass',
            'class' => 'small-6 small-centered'
        );
        echo form_password($bpass);
        echo form_submit('submit', 'Submit', "class='tiny button' id='updateBusinessPass'");
        echo form_close();
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="routeModal" class="reveal-modal tiny text-center" data-reveal>';
        echo '<h4>Select the date of routes to be edited.</h4>';
        echo '<div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>';
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
        echo '</div>';
        break;
    case 'M':
        echo '<div id="deliveryModal" class="reveal-modal" data-reveal>';
        $this->load->view('newDelivery', array('customers' => $customers, 'items' => $items));
        echo '</div>';
        echo '<div id="customerModal" class="reveal-modal" data-reveal>';
        $this->load->view('custN');
        echo '</div>';
        echo '<div id="addEmployeeModal" class="reveal-modal small" data-reveal>';
        $this->load->view('addEmployee');
        echo '</div>';
        echo '<div id="editEmployeeModal" class="reveal-modal large" data-reveal>';
        $this->load->view('editEmployee', array('employees' => $employees));
        echo '</div>';
        echo '<div id="editDeliveryModal" class="reveal-modal large" data-reveal>';
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="routeModal" class="reveal-modal tiny text-center" data-reveal>';
        echo '<h4>Select the date of routes to be edited.</h4>';
        echo '<div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>';
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
        echo '</div>';
        break;
    case 'E':
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
        echo '</div>';
        break;
    default:
        break;
}
?>

