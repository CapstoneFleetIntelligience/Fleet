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
						<h2 style="text-align: center;">Today's Scheduled Deliveries</h2>
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
