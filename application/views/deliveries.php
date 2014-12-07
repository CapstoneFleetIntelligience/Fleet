<!--mini navigation tab for this page only-->
<nav class="top-bar hide-for-large-up" data-top-bar role="navigation" data-options="is_hover: false">
	<ul class="title-area">
		<li class="name">
			<h1><?php echo anchor('adminH', 'Home'); ?></h1>
	</ul>
</nav>
<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 11/14/14
 * Time: 8:19 PM
 */
if ($deliverer == false){
    ?>
<div class="container">
    <div class="row">
        <div class="small-12">
            <h3>You have no routes assigned for today.</h3>
        </div>
    </div>
</div>
<?
}
else{
$options = array();
foreach ($deliverer->routes['route'] as $row)
{
    $options[$row->rid] = "Route #". ($row->rid + 1) ."";
}
    $id = 0;
    foreach ($deliverer->routes['route'] as $r){
        if ($r->rid == $route->rid)break;
        $id++;
    }
?>
<script>
    var myLatlng = new google.maps.LatLng(<?php echo $business->blat; ?>,<? echo $business->blong; ?>);
    var mapProp = {
        center: myLatlng,
        zoom:13
    };
    function initialize(){

        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
        directionsDisplay.setMap(map);
        var request = {
            origin: myLatlng,
            destination: myLatlng,
            waypoints: [<?echo $deliverer->routes['waypoints'][$id]?>],
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
            directionsDisplay.setDirections(response);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div class="container">
    <div class="row">
    <div class="small-8 small-centered columns">
        <div id="googleMap" style="width:500px;height:380px;border: 10px solid #ffffff"></div>
    </div>
        <div class="small-12">
            <?
            echo form_open('changeR',"id='changeR'");
            echo form_fieldset("Select a route to begin");
            echo form_dropdown('rid',$options,$route->rid,"onchange=\"this.form.submit()\"");
            echo form_fieldset_close();
            echo form_close();
            ?>
        </div>
        <div class="small-12 small-text-center">
            <? if ($route->start == NULL && $route->cmplt == NULL){
            ?>
            <a id="timer" href="#" class="button round success" data-state="start">Start Timer</a>
                <a id="cmplt" href="#" class="button round secondary">Route Complete</a><a href="<?echo $route->gmapsite ?>" target="_blank"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="96" height="96"></a><br>
            <?}elseif($route->cmplt == NULL){?>
            <a id="timer" href="#" class="button round alert" data-state="stop">Stop Timer</a>
                <a id="cmplt" href="#" class="button round secondary">Route Complete</a><a href="<?echo $route->gmapsite ?>" target="_blank"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="96" height="96"></a><br>
            <?}else{?>
                <h4>This Route was Compleated at <?echo date('jS \of F Y h:i:s A', strtotime($route->cmplt))?></h4>
                <a id="uncmplt" href="#" class="button round expand">Reopen Route</a><br>
            <?}?>
            <span class="label">Total Distance:</span><span class="secondary label"><?echo round($route->dist,2)?> Miles</span>    <span class="label">Total deliveries:</span><span class="secondary label"><?echo $route->dcount?></span>    <span class="label">Total Items:</span><span class="secondary label"><?echo $route->icount?></span><br><br>
        </div>
        <?if ($route->cmplt == NULL){?>
        <div class="small-12">
            <dl class="accordion" data-accordion>
                <?
                $count = 1;
                foreach ($route->deliveries['deliveries'] as $leg){
                    $url = '<a href="https://www.google.com/maps/dir/Current+Location/'.str_replace(' ','+',$leg->caddress).'" target="_blank"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="48" height="48"></a>';
                    if($this->agent->is_mobile())
                    {
                        $platform = $this->agent->platform();
                        if($platform=='Linux') $url =  '<a href="geo://0,0?q='.$leg->caddress.'"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="48" height="48"></a>';
                        elseif($platform=='Mac OS X')  $url =  '<a href="https://maps.apple.com/maps?q='.str_replace(' ','+',$leg->caddress).'"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="48" height="48"></a>';
                        elseif($platform=='Unknown Windows OS') $url = '<a href="bingmaps:?where='.$leg->caddress.'"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="48" height="48"></a>';
                        else $url = '<a href="maps:'.$leg->caddress.'"><img src="assets\images\Google-Maps-icon.png" alt="GMaps" width="48" height="48"></a>';
                    }
                    ?>
                    <dd class="accordion-navigation">
                        <a href="#panel<?echo $count?>"><?echo $leg->cname." at ".$leg->caddress?></a>
                        <div id="panel<?echo $count?>" class="content">
                            <?echo $url?>
                        <?
                        echo "<h4>";
                        if ($leg->isdlv == 't')echo "<input class=\"dcheck\" type=\"image\" src=\"assets\\images\\checkbox_checked.png\" alt=\"Delivered\" width=\"48\" height=\"48\" data-cid=\"".$leg->cid."\" data-check='true'>";
                        else echo "<input class=\"dcheck\" type=\"image\" src=\"assets\\images\\checkbox_empty.png\" alt=\"Delivered\" width=\"48\" height=\"48\" data-cid=\"".$leg->cid."\" data-check='false'>";
                        echo "  Delivery Complete</h4>";
                        echo "Note: ".$leg->note;
                        echo br(2);

                        foreach ($route->deliveries['checklist'][$count - 1] as $item){
                            if ($item->ischk == 't') {
                                echo "<input class=\"checkit\" type=\"image\" src=\"assets\\images\\checkbox_checked.png\" alt=\"checked\" width=\"24\" height=\"24\" data-cid=\"".$item->cid."\" data-iid=\"".$item->iid."\" data-check='true'>";

                            }else{
                                echo "<input class=\"checkit\" type=\"image\" src=\"assets\\images\\checkbox_empty.png\" alt=\"checked\" width=\"24\" height=\"24\" data-cid=\"".$item->cid."\" data-iid=\"".$item->iid."\" data-check='false'>";
                            }
                            echo "   Item: ".$item->iname."     Quantity: ".$item->qty;
                            echo br();
                        }
                       
                        ?>
                        </div>
                    </dd>
                <?
                    $count++;
                }
                ?>

            </dl>
        </div>
        <?}?>
    </div>
</div>
    <script>
        $('.dcheck').click(function(){
            if ($(this).data('check') == 'true'){
                $(this).attr('src','assets/images/checkbox_empty.png');
                $(this).data('check','false');
            }else{
                $(this).attr('src','assets/images/checkbox_checked.png');
                $(this).data('check','true');
            }
            var data = {
                cid: $(this).data('cid'),
                check: $(this).data('check')
            };

            $.ajax({
                url: "<? echo site_url('dcheck')?>",
                type: 'POST',
                data: data,
                success: function (){
                    console.log(msg);
                }
            });
            return false;
        });

        $('.checkit').click(function(){
            if ($(this).data('check') == 'true'){
                $(this).attr('src','assets/images/checkbox_empty.png');
                $(this).data('check','false');
            }else{
                $(this).attr('src','assets/images/checkbox_checked.png');
                $(this).data('check','true');
            }
            var data = {
                cid: $(this).data('cid'),
                iid: $(this).data('iid'),
                check: $(this).data('check')
            };

            $.ajax({
                url: "<? echo site_url('checkit')?>",
                type: 'POST',
                data: data,
                success: function (){
                    console.log(msg);
                }
            });
            return false;
        });

        $('#timer').click(function(){
            var data = {
                rid: <?echo $route->rid?>,
                state: $(this).data('state')
            };
            if($(this).data('state') == "start"){
                $(this).attr('class','button round alert');
                $(this).data('state',"stop");
                $(this).text("Stop Timer");
            }
            else{
                $(this).attr('class','button round success');
                $(this).data('state',"start");
                $(this).text("Start Timer");
            }

            $.ajax({
                url: "<? echo site_url('startR')?>",
                type: 'POST',
                data: data
            });
            return false;
        });

        $('#cmplt').click(function(){
            var data = {
                rid: <?echo $route->rid?>
            };

            $.ajax({
                url: "<? echo site_url('cmpltR')?>",
                type: 'POST',
                data: data
            });
            location.reload();
        });

        $('#uncmplt').click(function(){
            var data = {
                rid: <?echo $route->rid?>
            };

            $.ajax({
                url: "<? echo site_url('uncmpltR')?>",
                type: 'POST',
                data: data
            });
            location.reload();
        });
    </script>
<?
}