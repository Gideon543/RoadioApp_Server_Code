<?php
	namespace controllers;
    require __DIR__."/../controllers/road_datapoint_controller.php";

    $road_datapoint = new RoadDatapointController();

    /**
	* Testing the method that inserts a road datapoint and its associated road segment in a table.
	* If GPS point is within any road segment, print the segment to the screen.
    **/ 
    $query_results_3 = $road_datapoint->addRoadDatapoint(4.3, 5.2, 0, 1);
    if($query_results_3){
    	echo "Road datapoint successfully inserted!";
    } else{
    	echo "Unsucessful.";
    }
?>