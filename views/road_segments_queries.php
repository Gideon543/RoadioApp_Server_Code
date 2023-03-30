<?php
	namespace controllers;
    require __DIR__."/../controllers/road_segment_controller.php";
    
    $road_segment = new RoadSegmentController();

    /**
	* Testing the insert query for the road segment table
	* Prints "Success" if record is inserted successfull. 
    **/    
    // $query_results = $road_segment->addRoadSegment (3.567, 4.678, 0, 2);
    // if ($query_results){
    // 	echo "Success"."<br>"; 
    // }

    /**
	* Testing the method that checks if a point is within a road segment
	* If GPS point is within any road segment, print the segment to the screen.
    **/ 
    // $query_results_2 = $road_segment->hasRoadSegment (4,5);
    // if ($query_results_2){
    // 	foreach($query_results_2 as $value){
    // 		echo $value['road_segment_id']."<br>";
    // 	}
    // } else{
    // 	echo "There was no match!"."<br>";
    // }


    /**
	* Testing the method that gets all datapoints within a road segment
	* Prints datapoints to the screen if successful.
    **/ 
    // $query_results_3 = $road_segment->getPointsWithinSegment(1);

    // foreach($query_results_3 as $value){
    //     echo $value['roughness_index']. "<br>";
    // }

	// // Check if there are any rows returned
	// if (mysqli_num_rows($query_results_4) > 0) {
	//     // Loop through each row
	//     while ($row = mysqli_fetch_assoc($query_results_4)) {
	//         // Print the value of the road_datapoint_id column
	//         echo $row['roughness_index'] . "<br>";
	//     }
	// } else {
	//     // If there are no rows, print a message
	//     echo "No results found.";
	// }

    $query_results_4 = $road_segment->getMostOccuringRoughnessIndex(1);
    echo $query_results_4[0]['roughness_index'];


    // $result = reset($query_results_4);
    // echo $result['roughness_index'];
    foreach($query_results_4 as $value){
        echo $value['roughness_index']. "<br>";
    }
// ?>