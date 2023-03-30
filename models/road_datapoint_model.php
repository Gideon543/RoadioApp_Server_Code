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
          "INSERT INTO `road_datapoints` (`road_datapoint`, `roughness_index`, `road_segment_id`) 
           VALUES (POINT($latitude, $longitude), $roughness_index, $road_segment_id)"
          );
          return $results;
       }
        
    }
?>
