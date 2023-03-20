<?php
namespace controllers;
    require __DIR__."/../controllers/data_from_phones_controller.php";

    /**
	* Validating the availability of all parameters
	*@param $params
 	**/

    function areParametersAvailable($params){

    	$available = true;
    	$missingparams = "";

    	// Checking if all parameters are available
    	 foreach($params as $param){
 			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
 				$available = false; 
 				$missingparams = $missingparams . ", " . $param;
 			} 
 		}

 		// If parameters are missing
 		if(!$available){
 			$response = array();
 			$response['error'] = true;
 			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) .' missing';

 			// Displaying error
 			echo json_encode($response);

 			// Stopping further execution
 			die();
 		}
    }

    // Initialize an array to display response
    $response = array();

    // if it is an api call 
 	// that means a get parameter named api call is set in the URL 
 	// and with this parameter we are concluding that it is an api call
    if(isset($_GET['apicall'])){

    	if ($_GET['apicall'] == "createDatafile"){

    		// Check if the parameters required for this request are available or not
    		areParametersAvailable((array('accelerometer_datafile')));

    		// Creating a new record in the database
    		$dataFromPhonesObj = new DataFromPhonesController();
    		$result = $dataFromPhonesObj->addDataFileFromPhone($_GET['accelerometer_datafile']);

    		// If the record is created, add a success message to response
    		if($result){
    			// There was no error while creating the record
    			$response['error'] = false;

    			// Add success message to the response
    			$response['message'] = 'File added successfully';
    		} else{
    			 //if record is not added that means there is an error 
 				$response['error'] = true; 
 
 				//and we have the error message
 				$response['message'] = 'Some error occurred please try again';
    		}
    	}
    }

    // Displaying the response in json structure 
 	echo json_encode($response);


?>