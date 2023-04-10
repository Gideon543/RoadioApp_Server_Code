<?php
  namespace controllers;
    require_once __DIR__."/../config/database_connection.php";

    class RoadSegmentModel extends DatabaseConnection{
        /**
        * CREATE OPERATION
        * Interacts with database to create a road segment
        * @param GPS Point (latitiude, longitude), roughness index of GPS Point, radius of road segment
        **/
        protected function insertRoadSegment($latitude, $longitude, $roughness_index, $radius){
          $results = mysqli_query($this -> connect(),
          "INSERT INTO `road_segments` (`road_segment_circle`, `segment_surface_quality`) 
           VALUES (ST_Buffer(POINT($latitude, $longitude), $radius), $roughness_index)"
          );
          return $results;
       }

        /**
        * GET OPERATION
        * Interracts with database to fetch all road segments.
        **/
        protected function getAllRoadSegments(){
            $results = mysqli_query($this -> connect(),
            "SELECT ST_AsText(`road_segment_circle`) as `road_segment_circle`, `segment_surface_quality` FROM `road_segments`"
           );
           return $results;
       }

        /**
        * GET OPERATION
        * Interracts with database get the most occuring roughness index of all the points within a segment.
        * @param The ID of the road segment
        **/
        protected function getFrequentRoughnessIndexForSegment($road_segment_id){
            $results = mysqli_query($this->connect(),
                "SELECT `surface_quality`, COUNT(*) as `count` FROM `road_datapoints`
                JOIN `road_segments` 
                ON ST_Contains(road_segments.road_segment_circle, road_datapoints.road_datapoint)
                WHERE `road_segments`.`road_segment_id` = $road_segment_id
                GROUP BY `surface_quality`
                ORDER BY `count` DESC
                LIMIT 1"
            );
            return $results;
        }

        /**
        * UPDATE OPERATION
        * Interracts with database to update the roughness index of a road segment
        * @param The ID of the road segment, new roughness index value.
        **/
        protected function updateRoughnessIndexForSegment($road_segment_id, $new_roughness_index){
          $results = mysqli_query($this -> connect(),
            "UPDATE `road_segments` SET `segment_surface_quality` = $new_roughness_index 
             WHERE `road_segment_id` = $road_segment_id"
          );
          return $results;
        }

        /**
        * SPATIAL JOIN OPERATION
        * Interracts with database to fetch all road datapoints associated with a road segment.
        *@param The ID of the road segement
        **/
        protected function getRoadDatapointsForSegment($road_segment_id){
            $results = mysqli_query($this->connect(),
                "SELECT * FROM `road_datapoints`
                JOIN `road_segments` 
                ON ST_Contains(road_segments.road_segment_circle, road_datapoints.road_datapoint)
                WHERE `road_segments`.`road_segment_id` = $road_segment_id"
            );
            return $results;
        }
        
        /**
        * CHECK OPERATION
        * Checks if a road datapoint is within the circular polygon defined for a road segment
        * @param GPS point (latitude, longitude)
        **/
        protected function isWithinRoadSegment($latitiude, $longitude){
            $results = mysqli_query($this -> connect(),
            "SELECT * FROM `road_segments` 
             WHERE ST_Contains(road_segment_circle, ST_GeomFromText('POINT($latitiude $longitude)'))"
           );
           return $results;
       }

    }
?>