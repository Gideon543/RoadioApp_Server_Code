<?php
namespace controllers;
    require_once __DIR__."/../controllers/road_segment_controller.php";

    // Initialize an array that will be used to display response to client.
    $response = array();

    // If it is an api call, that means a get parameter named api call is set in the URL 
    // and with this parameter we are concluding that it is an api call
    if(isset($_GET['apicall'])){

        if ($_GET['apicall'] == "getRoadData"){

            // Initialize the controller needed to retrieve the data
            $roadSegmentController = new RoadSegmentController();

            // Getting all road datapoints from the database
            $resultsFromOperation = $roadSegmentController ->getRoadSegments();

            // If the records are returned successfully, add a success message to response
            if($resultsFromOperation){
                
                // There was no error while creating the record
                $response['error'] = false;

                // Add success message to the response
                $response['message'] = 'Road segments retreived successfully!';

                // Put the data retreived from the database in the response
                $response['road_segments'] = $resultsFromOperation;

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