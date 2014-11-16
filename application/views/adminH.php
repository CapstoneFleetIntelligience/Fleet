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