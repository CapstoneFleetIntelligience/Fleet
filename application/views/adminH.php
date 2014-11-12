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
 
		<br />
		<br />
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
						<div id="googleMap1" style="width:500px;height:380px;"></div>
					</div>
				</div>
				<div class="large-12 show-for-large-up columns">
					<div class="row">
						<div id="googleMap2" style="width:945px;height:700px;"></div>
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
