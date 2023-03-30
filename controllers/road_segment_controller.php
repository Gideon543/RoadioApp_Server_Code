<?php
namespace controllers;
    require __DIR__."/../models/road_segment_model.php";

    class RoadSegmentController extends RoadSegmentModel{
        
        /**
        * Provides a service that interracts with the model file to create a road segment.
        * @param GPS Point (latitiude, longitude), roughness index of GPS Point, radius of road segment
        **/
        public function addRoadSegment ($latitude, $longitude, $roughness_index, $radius){
            $results = $this -> insertRoadSegment($latitude, $longitude, $roughness_index, $radius);
            return $results;
        }

        /**
        * Provides a service that checks if a GPS point is within a road segment
        * @param GPS point(latitude, longitude)
        **/
        public function hasRoadSegment ($latitiude, $longitude){
            $results = $this -> isWithinRoadSegment($latitiude, $longitude);
            return mysqli_fetch_all($results, MYSQLI_ASSOC);
        }

        /**
        * Provides a service that gets all the road datapoints within a road segment
        * @param The id of the road segment
        **/
        public function getPointsWithinSegment($road_segment_id){
            $results = $this -> getRoadDatapointsForSegment($road_segment_id);
            return mysqli_fetch_all($results, MYSQLI_ASSOC);
        }

        /**
        * IProvides services that get the most occuring roughness index of all the points within a segment.
        * @param The ID of the road segment
        **/
        public function getMostOccuringRoughnessIndex($road_segment_id){
            $results = $this -> getFrequentRoughnessIndexForSegment($road_segment_id);
            return mysqli_fetch_all($results, MYSQLI_ASSOC);
        }

        /**
        * IProvides services that get the most occuring roughness index of all the points within a segment.
        * @param The ID of the road segment
        **/
        public function changeRoughnessIndexOfSegment($road_segment_id, $new_roughness_index){
            $results = $this -> updateRoughnessIndexForSegment($road_segment_id, $new_roughness_index);
            return $results;
        }

    }
?>