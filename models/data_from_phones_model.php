<?php
namespace controllers;
    require_once __DIR__."/../config/database_connection.php";

    class DataFromPhonesModel extends DatabaseConnection{
        /**
        * CREATE OPERATION
        * Defines the INSERT querry to put the data from the android devices in the database.
        * @param accelerometer_datafile - data from android devices
        **/
        protected function insertDataFileFromPhone($accelerometer_datafile){
            $results = mysqli_query($this -> connect(),
            "INSERT INTO `datafromphones`(`accelerometer_file`) 
             VALUES ('$accelerometer_datafile')"
           );
           return $results;
       }

        /**
        * GET OPERATION
        * Defines the GET querry to fetch data from the android devices stored in the database.
        * @param accelerometer_datafile - data from android devices
        **/
        protected function getDataFileFromDatabase($accelerometer_datafile){
            $results = mysqli_query($this -> connect(),
            "SELECT * FROM `datafromphones`"
           );
           return $results;
       }

    }
?>