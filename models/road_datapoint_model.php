<?php
namespace controllers;
    require_once __DIR__."/../config/database_connection.php";

    class RoadDatapointModel extends DatabaseConnection{
        /**
        * CREATE OPERATION
        * Creates a road datapoint to be inserted into the database
        * @param $latitiude, $longitude, $roughness_index, $radius
        **/
        protected function insertRoadDatapoint($latitude, $longitude, $roughness_index, $road_segment_id){
          $results = mysqli_query($this -> connect(),
          "INSERT INTO `road_datapoints` (`road_datapoint`, `surface_quality`, `road_segment_id`) 
           VALUES (POINT($latitude, $longitude), $roughness_index, $road_segment_id)"
          );
          return $results;
       }

        /**
        * GET OPERATION
        * Gets all road datapoints to from the database
        * @param None
        **/
        protected function fetchRoadDatapoint(){
            $results = mysqli_query($this -> connect(),
            "SELECT ST_AsText(`road_datapoint`), `surface_quality` FROM `road_datapoints`"
           );
           return $results;
       }
        
    }
?>
