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

    //open view for route preperation gater date of delivery and selection of user to perform deliveries
    public function routeN()
    {
        $data = array(
            'title' => 'Setup Route'
        );

        $this->load->template('routeN', $data);
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


    }


}