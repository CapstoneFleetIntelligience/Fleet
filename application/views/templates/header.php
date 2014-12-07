<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY">
    </script>

    <?php echo link_tag('assets/css/foundation.css'); ?>
    <?php echo link_tag('assets/css/normalize.css'); ?>
    <?php echo link_tag('assets/css/main.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.structure.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.theme.css'); ?>
    <?php echo script_tag('assets/js/vendor/modernizr.js'); ?>
    <?php echo script_tag('assets/js/vendor/fastclick.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery-ui.js'); ?>
    <?php echo script_tag('assets/js/vendor/jquery.cookie.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.offcanvas.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.interchange.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.tab.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.abide.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.reveal.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.topbar.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.alert.js'); ?>
    <?php echo script_tag('assets/js/foundation/foundation.accordion.js'); ?>
    <?php echo script_tag('assets/js/utility.js'); ?>
    <title><?php echo $title ?></title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <?php
    $set = $this->session->userdata('bname');
    if ($set) {
        $sql = "select schd from route where bname = ? and schd >= current_date group by schd";
        $dquery = $this->db->query($sql, $this->session->userdata('bname'));

        if ($dquery->num_rows() > 0) {
            foreach ($dquery->result() as $row) {
                $ddate[] = "'" . $row->schd . "'";
            }
            $ddates = implode(",", $ddate);
        } else {
            $ddates = '';
        }

        ?>
        <script>

            $(function () {
                $("#scd").datepicker();
            });
            $(function () {
                var arrayD = [<? echo $ddates ?>];
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                    beforeShowDay: function (date) {
                        var f = $.datepicker.formatDate('yy-mm-dd', date);
                        if ($.inArray(f, arrayD) > -1) {
                            return [true];
                        } else {
                            return [false];
                        }
                    },
                    onSelect: function (dateText) {
                        window.location = '<?php echo site_url('routeE')?>/' + dateText;
                    }
                });
            });
            $('#delDate').datepicker();
        </script>
    <? } ?>
</head>

<body>
<div class="row header">
    <!--large header-->
    <div class="row">
	<div class="small-12 columns">	
	    <!--Login/Registration Bar-->
	    <?php $role = $this->session->userdata('role'); ?>
	    <?php if (!($role)): ?>
		<div class="small-12 medium-12 large-12 columns">
		    <?php
		    echo '<div id="loginModal" class="small reveal-modal" data-reveal>';
		    $this->load->view('login');
		    echo '</div>';
		    echo '<div id="registrationModal" class="reveal-modal" data-reveal>';
		    $this->load->view('registration');
		    echo '</div>';
		    ?>
		</div>
		<!--login/registration buttons-->
		<div class="right medium-3 large-3 columns show-for-medium-up">
		    <ul class="button-group">
			<li><a href="#" data-reveal-id="loginModal" class="button tiny alert">Login</a></li>
			<li><a href="#" data-reveal-id="registrationModal" class="button tiny alert">Register</a></li>
		    </ul>
		</div>
		<!--medium and large header-->
		<div class="medium-4 large-4 show-for-medium-up columns hide-for-portrait hide-for-small">
		    <h1>Fleet Intelligence</h1>
		</div>	
		<!--small login/reg buttons-->
		<div class="row show-for-small-only">
		    <div class="right small-7 columns">
			<ul class="button-group">
			    <li><a href="#" data-reveal-id="loginModal" class="button tiny alert">Login</a></li>
			    <li><a href="#" data-reveal-id="registrationModal" class="button tiny alert">Register</a></li>
			</ul>
		    </div>
		</div>
	    <?php else: ?>
	</div>
    </div>
</div>

<!--sticky top bar for large screens (omitted show for large only)-->
<div class="sticky show-for-large-up">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        <ul class="title-area">
            <li class="toggle-topbar"></li>
        </ul>
        <section class="top-bar-section">
            <!-- Left Nav Section -->
            <ul class="left">
                <?php
                if ($role == 'A'): ?>
                    <li><?php echo anchor('adminH', 'Home'); ?></li>
                    <li><?php echo anchor('overview', 'Routes Overview'); ?></li>
                    <li><?php echo anchor('route_controller/routeN', 'Create Routes'); ?></li>
                    <li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
                    <li class="has-dropdown">
                        <a href="#">Delivery Tools</a>
                        <ul class="dropdown">
                            <li><a href="#" data-reveal-id="editDeliveryModal">Deliveries</a></li>
                            <li><a href="#" data-reveal-id="routeModal">Route Manager</a></li>
                        </ul>
                    </li>
                <?php elseif ($role == 'M'): ?>
                    <li><?php echo anchor('managerOverview', 'Home'); ?></li>
                    <li><?php echo anchor('overview', 'Routes Overview'); ?></li>
                    <li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
                    <li class="has-dropdown">
                        <a href="#">Delivery Tools</a>
                        <ul class="dropdown">
                            <li><a href="#" data-reveal-id="editDeliveryModal">Deliveries</a></li>
                            <li><a href="#" data-reveal-id="routeModal">Route Manager</a></li>
                        </ul>
                    </li>
                    <li><?php echo anchor('contact', 'Contact') ?></li>
                <?php
                else: ?>
                    <li><?php echo anchor('overview', 'Home'); ?></li>
                    <li><?php echo anchor('deliveries', 'Run Deliveries'); ?></li>
                    <li><?php echo anchor('contact', 'Contact') ?></li>
                <?php endif; ?>
            </ul>
            <!-- Right Nav Section -->
            <ul class="right">
                <?php if ($role == 'A'): ?>
                    <li class="has-dropdown">
                        <a href="#">Business Tools</a>
                        <ul class="dropdown">
                            <li class="has-dropdown"><a href="#">Employee(s)</a>
                                <ul class="dropdown">
                                    <li><a href="#" data-reveal-id="addEmployeeModal">Add</a></li>
                                    <li><a href="#" data-reveal-id="editEmployeeModal">Edit</a></li>
                                </ul>
                            </li>
                            <li><a href="#" data-reveal-id="addItemModal">Add New Checklist Item</a></li>
			    <li><a href="#" data-reveal-id="customerModal">New Customer</a></li>
			    <li><a href="#" data-reveal-id="deliveryModal">New Delivery</a></li>
                            <li><?php echo anchor('analytics', 'Analytics') ?></li>
                            <li><a href="#" data-reveal-id="editPassModal">Business Password</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-reveal-id="profileModal">Profile</a></li>
                    <li><?php echo anchor('logout', 'Log Out') ?></li>
                <?php elseif ($role == 'M'): ?>
                    <li class="has-dropdown">
                        <a href="#">Business Tools</a>
                        <ul class="dropdown">
                            <li class="has-dropdown"><a href="#">Employee(s)</a>
                                <ul class="dropdown">
                                    <li><a href="#" data-reveal-id="addEmployeeModal">Add</a></li>
                                    <li><a href="#" data-reveal-id="editEmployeeModal">Edit</a></li>
                                </ul>
                            <li>
                            <li><a href="#" data-reveal-id="customerModal">New Customer</a></li>
                            <li><a href="#" data-reveal-id="deliveryModal">New Delivery</a></li>
                            <li><?php echo anchor('analytics', 'Analytics') ?></li>
                            <li><?php echo anchor('route_controller/routeN', 'Create Routes') ?></li>
                        </ul>
                    </li>
                    <li><a href="#" data-reveal-id="profileModal">Profile</a></li>
                    <li><?php echo anchor('logout', 'Log Out') ?></li>
                <?php
                else: ?>
                    <li><a href="#" data-reveal-id="profileModal">Profile</a></li>
                    <li><?php echo anchor('logout', 'Log Out') ?></li>
                <?php endif; ?>
            </ul>
        </section>
    </nav>
</div>


<?php
switch ($role) {
    case 'A':
        echo '<div id="deliveryModal" class="reveal-modal" data-reveal>';
        $this->load->view('newDelivery', array('customers' => $customers, 'items' => $items));
	    echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="addItemModal" class="reveal-modal" data-reveal>';
        echo '<div class="item_table">';
        $this->load->view('templates/item_table');
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div></div>';
        echo '<div id="customerModal" class="reveal-modal" data-reveal>';
        $this->load->view('custN');
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="addEmployeeModal" class="reveal-modal small" data-reveal>';
        $this->load->view('addEmployee');
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="editEmployeeModal" class="reveal-modal xlarge" data-reveal>';
        $this->load->view('editEmployee', array('employees' => $employees));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="editDeliveryModal" class="reveal-modal xlarge" data-reveal>';
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div class="reveal-modal tiny" id="editPassModal" data-reveal>';
        echo form_open('changePass', array('id' => 'editBusinessPass'), array('name' => $business->name));
        echo '<span>New Business Password</span>';
        $bpass = array(
            'name' => 'bpass',
            'id' => 'bpass',
            'class' => 'small-6 small-centered'
        );
        echo form_password($bpass);
        echo form_submit('submit', 'Submit', "class='tiny button' id='updateBusinessPass'");
        echo form_close();
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="routeModal" class="reveal-modal tiny text-center" data-reveal>';
        echo '<h4>Select the date of routes to be edited.</h4>';
        echo '<div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>';
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        break;
    case 'M':
        echo '<div id="deliveryModal" class="reveal-modal" data-reveal>';
        $this->load->view('newDelivery', array('customers' => $customers, 'items' => $items));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="customerModal" class="reveal-modal" data-reveal>';
        $this->load->view('custN');
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="addEmployeeModal" class="reveal-modal small" data-reveal>';
        $this->load->view('addEmployee');
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="editEmployeeModal" class="reveal-modal xlarge" data-reveal>';
        $this->load->view('editEmployee', array('employees' => $employees));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="editDeliveryModal" class="reveal-modal large" data-reveal>';
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="routeModal" class="reveal-modal tiny text-center" data-reveal>';
        echo '<h4>Select the date of routes to be edited.</h4>';
        echo '<div id="datepicker" style="font-size: 12px; text-align: center; display: inline-block"></div>';
        echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        break;
    case 'E':
        echo '<div id="profileModal" class="reveal-modal small" data-reveal>';
        $this->load->view('profile', array('user' => $user));
	echo '<a class="close-reveal-modal">&#215;</a>';
        echo '</div>';
        break;
    default:
        break;
}
?>
<?php endif; ?>



</body>
</html>
