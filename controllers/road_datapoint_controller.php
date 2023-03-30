<?php
namespace controllers;
    require_once __DIR__."/../models/road_datapoint_model.php";

    class RoadDatapointController extends RoadDatapointModel{
        
        /**
        * Provides a service that interracts with the model file to create a road data for an associated segment.
        * @param GPS Point (latitiude, longitude), roughness index of GPS Point
        **/
        public function addRoadDatapoint ($latitude, $longitude, $roughness_index, $road_segment_id){
            $results = $this -> insertRoadDatapoint($latitude, $longitude, $roughness_index, $road_segment_id);
            return $results;
        }

    }
?>