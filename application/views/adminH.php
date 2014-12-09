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
        var arrayD = [<?php echo $ddates ?>];
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
    if (isset($coordinates)){
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
		    <div class="container row">
			    <div class="small-12 columns">
				<h2 style="text-align: center;"><?php echo $this->session->userdata('bname') ?></h2>
			    </div>

			    <br/>

				    <div class="small-12 columns">
					<div class="panel">
					    <h2 style="text-align: center;">Today's Scheduled Deliveries</h2>
					</div>
				    </div>
				    <div class="medium-offset-1 medium-8 show-for-medium-only columns">
					    <div id="googleMap1" style="width:800px;height:500px;"></div>
				    </div>
				    <div class="small-12 columns show-for-small-only">
					    <div id="googleMap1" style="width:300px;height:300px;"></div>
				    </div>
			</div>
		</section>
		
		<a class="exit-off-canvas"></a>
		
    </div>
</div>

<!--large screen page content-->
<div class="container row show-for-large-up">
    <div class="row">
	<div class="large-12 medium-12 columns">
	    <h2 style="text-align: center;"><?php echo $this->session->userdata('bname') ?></h2>
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
			<div id="googleMap2" style="width:1000px;height:500px;"></div>

		</div>
	    </div>
	</div>
    </div>
</div>


