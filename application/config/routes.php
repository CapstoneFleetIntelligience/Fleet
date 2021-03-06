<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site_controller";
$route[''] = "site_controller/index";
$route['404_override'] = '';
$route['managerOverview'] = "employee_controller/managerOverview";
$route['registration'] = "site_controller/registration";
$route['register'] = "site_controller/register";
$route['login'] = "site_controller/login";
$route['logout'] = "site_controller/logout";
$route['overview'] = "employee_controller/index";
$route['adminE'] = "site_controller/adminE";
$route['analytics'] = "site_controller/analytics";
$route['authenticate'] = "site_controller/authenticate";
$route['employN'] = "employee_controller/addNew";
$route['contact'] = "employee_controller/contact";
$route['assignments'] = "employee_controller/assignment";
$route['adminH'] = "site_controller/adminH";
$route['itemN'] = "site_controller/itemN";
$route['custN'] = "site_controller/custN";
$route['addCust'] = "admin_controller/addCust";
$route['addItem'] = "admin_controller/addItem";
$route['bChkList'] = "admin_controller/bChkList";
$route['addList'] = "admin_controller/addList";
$route['addNew'] = "business_controller/addNew";
$route['routeN'] = "route_controller/routeN";
$route['routeN/baddate'] = "route_controller/routeN";
$route['routePrep'] = "route_controller/routePrep";
$route['editEmploy'] = "settings_controller/editEmploy";
$route['editEmploy'] = "settings_controller/editDelivery";
$route['editEmploy'] = "settings_controller/editChklist";
$route['editEmploy'] = "settings_controller/editPass";
$route['editEmploy'] = "settings_controller/editRange";
$route['getStarted'] = "site_controller/getStarted";
$route['routeM'] = "route_controller/routeM";
$route['edit_rts'] = "route_controller/edit_rts";
$route['routeE/:any'] = "route_controller/routeE";
$route['deleteR'] = "route_controller/deleteR";
$route['deliveries'] = "employee_controller/deliveries";
$route['changeR'] = "employee_controller/changeR";
$route['checkit'] = "employee_controller/checkit";
$route['dcheck'] = "employee_controller/dcheck";
$route['startR'] = "employee_controller/startR";
$route['cmpltR'] = "employee_controller/cmpltR";
$route['uncmpltR'] = "employee_controller/uncmpltR";


/* End of file routes.php */
