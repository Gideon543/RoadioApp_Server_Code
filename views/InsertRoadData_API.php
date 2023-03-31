<?php
namespace controllers;
    require_once __DIR__."/../controllers/road_aggregation_controller.php";
    require_once __DIR__."/../controllers/machine_learning_controller.php";

    /**
    * Function to validate the availability of all required parameters.
    *@param $params
    **/
    function areParametersAvailable($params){

        $available = true;
        $missingparams = "";

        // Checking if all parameters are available.
         foreach($params as $param){
            if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
                $available = false; 
                $missingparams = $missingparams . ", " . $param;
            } 
        }

        // If the required parameters are missing, display an error message.
        if(!$available){
            $response = array();
            $response['error'] = true;
            $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) .' missing';

            // Display error.
            echo json_encode($response);

            // Stop further execution
            die();
        }
    }

    // Initialize an array that will be used to display response to client.
    $response = array();

    // If it is an api call, that means a get parameter named api call is set in the URL 
    // and with this parameter we are concluding that it is an api call
    if(isset($_GET['apicall'])){

        if ($_GET['apicall'] == "addRoadData"){

            // Check if the parameters required for this request are available or not
            areParametersAvailable((array('Z_Mean', 'Z_Variance', 'Z_Deviation', 'Z_Peak', 'Z_Low', 'latitude', 'longitude')));

            // Get GPS data - longitude and latitude
            $latitude =  $_POST['latitude'];
            $longitude =  $_POST['longitude'];

            // Initialize the ML model to be used
            $model = new MachineLearningModels();

            // Get the Z-Values from the POST request an pass them through the ML model -in this case Logistic Regression
            $prediction = $model ->logisticRegressionModel($_POST['Z_Mean'], $_POST['Z_Variance'], $_POST['Z_Deviation'], $_POST['Z_Peak'], $_POST['Z_Low']);

            // Creating a new record in the database
            $messageFromOperation = aggregateRoadDatapoints($latitude, $longitude, $prediction);

            // If the record is created, add a success message to response
            if($messageFromOperation == "Success"){
                
                // There was no error while creating the record
                $response['error'] = false;

                // Add success message to the response
                $response['message'] = 'Road datapoint added successfully!';

            } else{

                 //If record is not added that means there is an error 
                $response['error'] = true; 
 
                //and we have the error message
                $response['message'] = 'Some error occurred please try again';
            }
        }
    }

    // Displaying the response in json structure 
    echo json_encode($response);
?>