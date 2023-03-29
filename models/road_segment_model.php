<?php
namespace controllers;
    require __DIR__."/../config/database_connection.php";

    class RoadSegmentModel extends DatabaseConnection{
        /**
        * CREATE OPERATION
        * Defines the INSERT querry to put the data from the android devices in the database.
        * @param accelerometer_datafile - data from android devices
          "INSERT INTO `datafromphones`(`accelerometer_file`) 
          VALUES ('$accelerometer_datafile')"
        **/
        protected function insertRoadSegment($latitiude, $longitude){
            $results = mysqli_query($this -> connect(),
            "INSERT INTO circles (id, circle) 
            VALUES (ST_Buffer(POINT('$latitude','$longitude'), 5))"
           );
           return $results;
       }

        /**
        * GET OPERATION
        * Defines the GET querry to fetch data from the android devices stored in the database.
        * @param accelerometer_datafile - data from android devices
        **/
        protected function getRoadSegments($accelerometer_datafile){
            $results = mysqli_query($this -> connect(),
            "SELECT * FROM `datafromphones`"
           );
           return $results;
       }

    }
?>

/*
* -- phone accelerometer and GPS data
CREATE TABLE phone_accelerometer_data (
  data_id PRIMARY KEY AUTO_INCREMENT,
  acceleration_zmean FLOAT,
  acceleration_zstd FLOAT,
  acceleration_zvariance FLOAT,
  acceleration_zpeak FLOAT,
  acceleration_zlow FLOAT,
  latitude FLOAT,
  longitude FLOAT,
  time_recorded TIMESTAMP
);

-- create circular road segments
CREATE TABLE road_segments (
  road_segment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
  road_segment_circle GEOMETERY,
  segment_roughness_index INTEGER,
);
 
-- road datapoints that make up a segment
CREATE TABLE road_datapoints(
  road_datapoint_id INTEGER PRIMARY KEY,
  road_datapoint GEOMETERY,
  roughness_index INTEGER,
  road_segment_id INTEGER,
  time_recorded TIMESTAMP,
  FOREIGN KEY (road_segment_id) REFERENCES road_segments(road_segment_id)
);
*
*/