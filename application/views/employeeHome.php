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
//set user variables
//$schd = date(c);
$schd = '2014-11-11';
$bname = $this->session->userdata('bname');

//query to get route data
$sql1 = "SELECT * FROM capsql.route WHERE bname = ? AND schd = ? AND uname = ?";
$result1 = $this->db->query($sql1,array($bname,$schd,$user->uname));
//get total distance
$dist = 0;
foreach ($result1->result() as $row){
    $dist += $row->dist;
}
//get count of total routes
$rcount = $result1->num_rows();

//query to get delivery data
$sql2 =  "SELECT * FROM capsql.delivery AS d, capsql.customer AS c, capsql.route AS r WHERE r.schd = d.schd AND c.cid = d.cid AND c.bname = r.bname AND d.schd = ? AND c.bname = ? AND r.uname = ?";
$result2 = $this->db->query($sql2, array($schd,$bname,$user->uname));
//get count of all deliveries
$dcount = $result2->num_rows();

//query to get delivery item data
$sql3 = "SELECT i.qty FROM capsql.delivery AS d, capsql.customer AS c, capsql.route AS r, capsql.del_item AS i WHERE r.schd = d.schd AND c.cid = d.cid AND c.bname = r.bname AND i.cid = c.cid AND d.schd = ? AND c.bname = ? AND r.uname = ?";
$result3 = $this->db->query($sql3,array($schd,$bname,$user->uname));
//get total delivery items
$icount = 0;
foreach ($result3->result() as $row){
    $icount += $row->qty;
}
?>
<?php if($user->pass == $business->dpass): ?>
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
    <?php endif; ?>
    <div class="row">
        <div class="small-offset-4 small-centered title-area">
            <p class="title"><?php echo $user->uname ?></p>
        </div>
    </div>
    <div class="row">
        <div class="small-offset-4 small-centered">
            <p> Today's Route Assignment</p>
        </div>
    </div>

    <div class="row">
        <div class="small-centered">
            <b><p>Route Summary</p></b>
        </div>
    </div>
</div>
