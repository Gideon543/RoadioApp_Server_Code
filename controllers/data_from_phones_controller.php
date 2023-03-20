<?php
namespace controllers;
    require __DIR__."/../models/data_from_phones_model.php";

    class DataFromPhonesController extends DataFromPhonesModel{
        
        /**
        * Function that interracts with the model to insert data from the android devices.
        * @param accelerometer_datafile
        **/
        public function addDataFileFromPhone ($accelerometer_datafile){
            $results = $this -> insertDataFileFromPhone($accelerometer_datafile);
            return $results;
        }
    }
?>