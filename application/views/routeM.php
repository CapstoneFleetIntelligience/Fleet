<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/17/14
 * Time: 6:28 PM
 */
$results=$this->db->get_where('capsql.business',array('name'=> $this->session->userdata('bname')));
foreach ($results->result() as $biz)

$rary = array(
    'bname' => $this->session->userdata('bname'),
    'schd' => $schd
);
$rquery = $this->db->get_where('capsql.route', $rary );

$uary = array(
    'bname' => $this->session->userdata('bname')
);
$uquery = $this->db->get_where('capsql.user', $uary );
foreach ($uquery->result() as $row)
{
    switch ($row->role){
        case 'A':
            $role = 'Admin: ';
            break;
        case 'M':
            $role = 'Manager: ';
            break;
        default:
            $role = 'Employee: ';
    }
    $options[$row->uname] = $role.$row->uname;
}

if ($success == true)
{
    $smsg = "All deliveries for ".date('l \t\h\e jS \of F Y', strtotime($schd))." have been processed into routes. The following are the routes that have just been populated.";
    ?><script type="text/javascript">
    $( document ).ready(function() {
        $("#topdiv").removeClass("alert-box info radius").addClass("alert-box success radius");
        $( "#topmsg" ).text( "<? echo $smsg ?>" );
    });

    </script><?php
}

?>
<script>
    var myLatlng = new google.maps.LatLng(<?php echo $biz->blat; ?>,<? echo $biz->blong; ?>);
    var mapProp = {
        center: myLatlng,
        zoom:13
    };



</script>
<div class="container">
    <div class="row">
        <div class="small-12">
            <div id="topdiv" data-alert class="alert-box info radius">
                <h4 id="topmsg">The following are the routes for <? echo date('l \t\h\e jS \of F Y', strtotime($schd)) ?>.</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12" style="text-align: center">

            <a href="#" data-reveal-id="confirmModal" class="button alert large radius">Delete all routes for this Date</a>
            <div id="confirmModal" class="reveal-modal" style="text-align: center" data-reveal>
                <h4>Are you sure you want to delete all routes for <? echo date('l \t\h\e jS \of F Y', strtotime($schd)) ?>? Create routes will have to be ran again for this date.</h4>
                <?
                echo form_open('deleteR',"id = 'deleteR'");
                echo form_hidden('schd',$schd);
                echo form_submit('','Yes, I want to delete these routes',"class='button alert small radius'");
                echo form_close();
                ?>
                <h6>After routes are deleted you will be taken back to the Edit page.</h6>
                <a class="close-reveal-modal">&#215;</a>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        echo form_open('edit_rts', "id = 'edit_rts'");
        echo form_fieldset('Change the deliverer for any route');
        echo form_input(array('name' => 'schd', 'type'=>'hidden', 'id' =>'schd', 'value' => $schd));
        //loop through individual routes and display their maps and info
        foreach ($rquery->result() as $row){
            $sql = "select * from delivery as d, customer as c where d.cid = c.cid and d.schd = ? and c
            .bname = ? and d.rid = ? order by d.position";
            $dquery = $this->db->query($sql ,array($schd,$biz->name,$row->rid));
            if ($dquery->num_rows() != 0){
                foreach ($dquery->result() as $drow)
                {
                    $address = str_replace('%2C',',',$drow->caddress);
                    $waypoint[] = "{location:\"".$address."\"}";
                }
                $waypoints = implode(",",$waypoint);
            }
            else $waypoints = "";
        ?>
            <script>
                function initialize<?echo $row->rid?>(){

                    var directionsService<?echo $row->rid?> = new google.maps.DirectionsService();
                    var directionsDisplay<?echo $row->rid?> = new google.maps.DirectionsRenderer();
                    var map<?echo $row->rid?> = new google.maps.Map(document.getElementById('googleMap<?echo $row->rid?>'), mapProp);
                    directionsDisplay<?echo $row->rid?>.setMap(map<?echo $row->rid?>);
                    var request<?echo $row->rid?> = {
                        origin: myLatlng,
                        destination: myLatlng,
                        waypoints: [<?echo $waypoints?>],
                        travelMode: google.maps.TravelMode.DRIVING
                    };
                    directionsService<?echo $row->rid?>.route(request<?echo $row->rid?>, function(response, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay<?echo $row->rid?>.setDirections(response);
                        }
                        directionsDisplay<?echo $row->rid?>.setDirections(response);
                    });
                }

                google.maps.event.addDomListener(window, 'load', initialize<?echo $row->rid?>);

            </script>
            <div class="row">
                <div class="small-8 small-centered columns">
                    <fieldset>
                        <legend>Route #<? echo $row->rid + 1?></legend>
                        <?
                        if ($row->cmplt)echo "<span class=\"success label\">Route Complete</span>";
                        elseif($row->start)echo "<span class=\"warning label\">Route In Progress</span>";
                        ?>
                        <center>
                        <div id="googleMap<?echo $row->rid?>" style="width:500px;height:380px;border: 10px solid #ffffff"></div>
                        <?php if($row->cmplt) echo "Completed by ".$row->uname;
                            elseif ($row->start){
                                echo "Current Driver is ".$row->uname.br();
                                echo "Hand Off Route to: ".form_dropdown('rid'.$row->rid,$options,$row->uname);
                            }
                            else echo form_dropdown('rid'.$row->rid,$options,$row->uname); ?>
                        </center>
                    </fieldset>
                </div>
            </div>
        <?php
        unset($waypoint);
            //end loop for each route
        }
        echo form_submit('', 'Set Changes', "id= 'submit_rts' class = 'small button'");
        echo form_close();
        ?>

    </div>
</div>