<?php
	namespace controllers;
	require_once __DIR__."/road_datapoint_controller.php";
	require_once __DIR__."/road_segment_controller.php";

	/**
	* Aggregates the roughness index from different road datapoints within a segment
	*@param GPS location (latitude, longitude), Roughness index at that GPS location
	*/
	function aggregateRoadDatapoints($latitude, $longitude, $roughness_index){

		$message = "Success";

		// Initialize the services necessary for the aggregation task
		$road_segment = new RoadSegmentController();
		$road_datapoint = new RoadDatapointController();

		//Check if the GPS location is within the boundary of any road segment
		$segments = $road_segment -> hasRoadSegment($latitude, $longitude);
		if($segments){
			$first_segment = reset($segments);
			
			// Get segment id of the first road segment the point falls within
			$road_segment_id = $first_segment['road_segment_id']; 

			// Insert the GPS location as road datapoint linked to a road segment
			$road_datapoint->addRoadDatapoint($latitude, $longitude, $roughness_index, $road_segment_id);

			// Get the most occuring roughness index of points within the segment
			$frequent_roughness_index = $road_segment ->getMostOccuringRoughnessIndex($road_segment_id);

			// Update the roughness index of the road segment with the most occuring index
			$road_segment ->changeRoughnessIndexOfSegment($road_segment_id, $frequent_roughness_index[0]['roughness_index']);

		// If the point is not within any segment, then this GPS location should be a a new road segment
		} else{
			// Create a new road segment for the GPS point
			$road_segment ->addRoadSegment ($latitude, $longitude, $roughness_index, 2);
		}

		return $message;
	}
?>

