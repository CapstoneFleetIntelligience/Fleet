<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/11/14
 * Time: 8:00 PM
 */
class route_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //open view for route preparation to gather date of delivery and selection of user to perform deliveries
    public function routeN()
    {
        $data = array(
            'title' => 'Setup Routes'
        );

        $this->load->template('routeN', $data);
    }

    //open view for route management to delete routes or change the users assigned to those routes
    public function routeM($schd, $success = false)
    {
        $data = array(
            'title' => 'Manage Routes',
            'schd' => $schd,
            'success' => $success
        );

        $this->load->template('routeM', $data);
    }

    //create routes, assign routes to deliveries, optimize order of deliveries in routes
    public function routePrep()
    {
        $pdata = $this->input->post(NULL, TRUE);

        //call the rarray function to create routes in DB and return array of route information
        $myarray = $this->route->rarray($pdata);

        //exit if there are no deliveries
        if ($myarray == FALSE ) redirect("/routeN/baddate");

        //call setRoute function
        $this->route->setRoute($pdata, $myarray);

        //call optimizeR function
        $this->route->optimizeR($pdata, $myarray);

        //navigate to route management
        $this->routeM($pdata['schd'], true);
    }

    //function to update routes with newly assigned users
    public function edit_rts()
    {
        $pdata = $this->input->post(NULL, TRUE);

        //call updateRoute model function
        $this->route->updateRoute($pdata);

        //navigate to route management
        $this->routeM($pdata['schd']);
    }

    //open route manger from Edit page
    public function routeE()
    {
        //get date from url
        $schd = $this->uri->segment(2);
        //open route manager using function with date
        $this->routeM($schd);
    }

    public function deleteR()
    {
        //get post data
        $pdata = $this->input->post(NULL, TRUE);

        //run delete function
        $this->route->destNclnR($pdata['schd']);

        //return to edit page
        redirect(site_url("adminE"));
    }
}