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
			<a href="#" data-reveal-id="routeModal" class="button expand">Route Manager</a>
		    </div>
		</div>
	    </div>
             
		<div class="large-4 small-6 columns">
			<h4>Today's Preview</h4><hr>
				<p class="text-justify"><b>Total Deliveries Made Today: </b></p>
				<br />
				<a href="analytics" class="button expand">Details</a>
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

