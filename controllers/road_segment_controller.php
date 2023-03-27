<?php
namespace controllers;
    require __DIR__."/../models/data_from_phones_model.php";

    class RoadSegmentController extends RoadSegmentModel{
        
        /**
        * Function that interracts with the model to insert data from the android devices.
        * @param accelerometer_datafile
        **/
        public function addRoadSegment ($accelerometer_datafile){
            $results = $this -> insertRoadSegment($accelerometer_datafile);
            return $results;
        }
    }
?>