<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/9/14
 * Time: 5:05 PM
 */

/*
 * P) pull business information and all deliveries from DB
 *
 * 1) calculate the number and size of routes while creating the routes in the DB and assign deliverers to the routes
 *      -create array with the size of each route
 *
 * 2) loop 360 times creating a new polygon each time representing the next angle after the previous starting at 0 degrees ending at 360
 *      -each loop has an inner loop, looping through all deliveries checking if its in the current polygon then add it to a route. when a route is full move on to the next route continuing to loop through
 *
 * 3) loop, pull deliveries by route from DB
 *      -loop to place DB results in array
 *      -optimize order using google route optimization
 *      -loop to update deliveries with optimized position in the route
 *
 * 4)
*/