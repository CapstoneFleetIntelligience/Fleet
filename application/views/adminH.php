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
	<br/ >
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

	<div id="addItemModal" class="reveal-modal" data-reveal>
    <?php $this->load->view('templates/item_table'); ?>
</div>
<div id="deliveryModal" class="reveal-modal" data-reveal>
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
			<a href="#" class="button expand">Employee(s)</a>
			<a href="#" class="button expand">Deliveries</a>
			<a href="#" class="button expand">Checklist Items</a>
			<a href="#" class="button expand">Business Password</a>
			<a href="#" class="button expand">Delivery Range</a>
			<a href="#" class="button expand">Route Manager</a>
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
 
    