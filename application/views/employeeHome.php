<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/14/14
 * Time: 2:15 PM
 */

$pass = array(
    'name' => 'pass',
    'id' => 'pass'
);
?>
<?php if($user->pass == $business->dpass):
?>
<div id="password" class="row">
    <div class="small-centered">
        <?php
              echo form_open('changePass', 'id = "changePass"');
              echo form_password($pass);
              echo form_submit('', 'Continue', 'id="submit_pass" class="button tiny"');
              echo form_close();
        ?>
    </div>
</div>
<div class="employee hide">
    <?php endif;
    if (sizeof($deliverer->routes['route']) < 1){
        ?><div class="small-4 small-centered">
            <h2>You dont have any routes assigned for today.</h2>
        </div><?
    }
    else{
    ?>
    <script>
        var myLatlng = new google.maps.LatLng(<?php echo $business->blat; ?>,<? echo $business->blong; ?>);
        var mapProp = {
            center: myLatlng,
            zoom:13
        };
        function initialize(){

            var directionsService = new google.maps.DirectionsService();
            var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
            <?
            $i = 0;
            foreach ($deliverer->routes['route'] as $row){?>
            var pcolor<?echo $row->rid?> = new google.maps.Polyline({
                strokeColor: '<?php printf( "#%06X", mt_rand( 0, 0xFFFFFF )); ?>'
            });
            var directionsDisplay<?echo $row->rid?> = new google.maps.DirectionsRenderer({polylineOptions: pcolor<?echo $row->rid?>});

            directionsDisplay<?echo $row->rid?>.setMap(map);
            var request<?echo $row->rid?> = {
                origin: myLatlng,
                destination: myLatlng,
                waypoints: [<?echo $deliverer->routes['waypoints'][$i]?>],
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request<?echo $row->rid?>, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay<?echo $row->rid?>.setDirections(response);
                }
                directionsDisplay<?echo $row->rid?>.setDirections(response);
            });

            <?
            $i++;
            //end loop for each route
        }?>
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <div class="row">
        <div class="small-offset-4 small-centered title-area">
            <p class="title"><?php echo $user->uname ?></p>
        </div>
    </div>
    <div class="row">
        <div class="small-offset-4 small-centered">
            <p> Today's Route Assignment</p>
        </div>
        <div class=" small-8 medium-10 small-centered columns">
            <div class="row">
                <div id="googleMap" style="width:600px;height:460px;"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-offset-4 small-centered">
            <b>Route Summary</b>
        </div>
        <div class="small-8 small-text-center">
            Number of Routes: <?echo $deliverer->rcount?><br><br>
            Number of Deliveries: <?echo $deliverer->dcount?><br><br>
            Number of Items: <?echo $deliverer->icount?><br><br>
            Total Distance: <?echo round($deliverer->dist,2)?> Miles
        </div>
    </div>
    <?}?>
</div>
